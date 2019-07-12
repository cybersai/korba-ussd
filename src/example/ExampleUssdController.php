<?php


namespace App\Http\Controllers;

use App\Tracker;
use GaRuralBank\ComingSoon;
use GaRuralBank\CustomerMenu;
use GaRuralBank\CustomerService;
use GaRuralBank\DepositAmount;
use GaRuralBank\DepositConfirmation;
use GaRuralBank\DepositRef;
use GaRuralBank\EnquireBalance;
use GaRuralBank\EnquireStatement;
use GaRuralBank\EnquiryAccounts;
use GaRuralBank\EnquiryPin;
use GaRuralBank\ErrorMessage;
use GaRuralBank\FeeAccountAmount;
use GaRuralBank\FeeAmount;
use GaRuralBank\FeeInstitution;
use GaRuralBank\FeePin;
use GaRuralBank\FeeSource;
use GaRuralBank\FeeSummary;
use GaRuralBank\FundsAccount;
use GaRuralBank\FundsAccountAmount;
use GaRuralBank\FundsAccountConfirmation;
use GaRuralBank\FundsAccountNoConfirm;
use GaRuralBank\FundsAccountPin;
use GaRuralBank\FundsAccountRef;
use GaRuralBank\FundsOtherDestination;
use GaRuralBank\FundsOwnDestination;
use GaRuralBank\PinCurrent;
use GaRuralBank\PinCurrentFirst;
use GaRuralBank\PinMenuFirst;
use GaRuralBank\PinNew;
use GaRuralBank\PinNewFirst;
use GaRuralBank\School;
use GaRuralBank\ServiceScript;
use GaRuralBank\SubMenu;
use GaRuralBank\VisitorMenu;
use GaRuralBank\VisitorService;
use GaRuralBank\Voucher;
use GaRuralBank\Welcome;
use GaRuralBank\WithdrawalAmount;
use GaRuralBank\WithdrawalConfirmation;
use GaRuralBank\WithdrawalPin;
use GaRuralBank\WithdrawalRef;
use Illuminate\Http\Request;
use Korba\Amount;
use Korba\Confirm;
use Korba\Util;
use Korba\View;
use Korba\Thanks;

class UssdController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function app(Request $request) {
        $code = Util::CONTINUE_CODE;
        if (Util::isInitialRequest($request)) {
            // Initial Request here
            $response = new View();
            $option = 'next_place';
            Tracker::create(Util::requestToHashedMapArray($request, $response, $option));
        } else {
            $tracker = Tracker::where('session_id', Util::getRequestSessionId($request))->first();
            $history = Util::parseHistoryToArray($tracker->history);
            $target = $tracker->target;
            $option = $tracker->option;
            $input = $request->ussdString;

            View::setProcessNext("00");
            View::setProcessBack("#");
            View::setProcessPrevious("*");

            Util::processReset(["*", "00", "#"], $input, $target);
            Util::processNext("00", $input, $target, $history, $option);
            Util::processPrevious("*", $input, $target, $history, $option);
            Util::processBack("#", $input, $history, $option);
            Util::processBeginning('0', $input, $history, $option);

            // Redirect when using Korba Service
            Util::redirect('3', $input, '1',$option, 'VISITOR_SERVICE', 'KORBA_MENU');
            Util::redirect('6', $input, '1',$option, 'CUSTOMER_SERVICE', 'KORBA_MENU_R');

            // Switch Views Here
            switch ($option) {
                case "MAIN_MENU": // Not in use now
                    $response = new Welcome();
                    break;

                /**
                 * Pick Up and plugin Korba services to Institution
                 */

                case (preg_match('/^KORBA_*/', $option) ? true : false):
//                    $service = new Services(new AirtimePayment(), new AccountsList(), [false, true, true, true, true]);
//                    $service->canProcess($tracker, $input, $option);
//                    $response = $service->getCurrentView($option, $input);
                    ServiceScript::redirect($tracker,$input, $option);
                    $response = ServiceScript::copyMe($tracker, $input, $target, $option);
                    break;

                default:
                    $response = new ErrorMessage('Default Page');
            }

            if ($response->getNext() == 'END') {
                $code = Util::TERMINATION_CODE;
            }

            $tracker->option = $response->getNext();
            Util::appendHistory($history, $input, $option);
            $tracker->history = json_encode($history);
            $tracker->target = $target;
            $tracker->save();
        }
        return response()->json(Util::parseResponseToArray($response, $code));
    }
}
