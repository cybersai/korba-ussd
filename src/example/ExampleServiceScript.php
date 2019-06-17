<?php


namespace Korba;


class ExampleServiceScript
{
    private function __construct() { }

    public static function copyMe(&$tracker, $input, $target, $option, $has_accounts = true, $available = [false, true, true, true, true]) {
        switch ($option) {
            case "KORBA_MENU":
                $tracker->authorization = 'non-registered';
                return new Menu(...$available);

            case "KORBA_MENU_R":
                $tracker->authorization = 'registered';
                return new Menu(...$available);

            case "KORBA_SUB_MENU":
                $view_group = new SubMenu(...$available);
                return intval($input) >= 1 && intval($input) <= 5 ? $view_group->getView($input) : new Error();

            case "KORBA_AIRTIME_NET_NUM":
                $tracker->type = $input == '1' ? 'own' : 'other';
                $view_group = new AirtimeNetNum();
                return $input == '1' || $input == '2' ? $view_group->getView($input) : new Error();

            case "KORBA_AIRTIME_NUM":
                $network = AirtimeNetwork::$network[intval($input) - 1];
                $tracker->payload = json_encode(['network' => $network]);
                return new AccountNumber('korba_airtime_num_confirm', 'recipient');

            case "KORBA_AIRTIME_NUM_CONFIRM":
                $payload = json_decode($tracker->payload, true);
                $tracker->payload = json_encode([
                    'network' => $payload['network'],
                    'number' => Util::numberGHFormat($input)
                ]);
                return new Confirm('korba_airtime_amount',Util::numberGHFormat($input), 'recipient');

            case "KORBA_AIRTIME_AMOUNT":
                return $input == '1' ? new Amount('korba_airtime_confirmation') : new Error();

            case "KORBA_AIRTIME_CONFIRMATION":
                $payload = json_decode($tracker->payload, true);
                $net  = $tracker->type == 'other' ? $payload['network'] : $tracker->network;
                $network = AirtimeNetwork::$human_network[$net];
                $number = $tracker->type == 'other' ? $payload['number'] : Util::numberGHFormat($tracker->phone_number);
                if ($tracker->authorization != 'registered') {
                    $next = $tracker->network == 'VOD' ? 'korba_airtime_vod' : 'korba_airtime_auth';
                } else {
                    $next = $has_accounts ? 'korba_airtime_pay' : 'korba_airtime_auth';
                }
                $tracker->amount = $input;
                return Util::verifyAmount($input) ? new ConfirmationPage($next, 'Airtime', $number, $input) : new Error('Invalid Amount Entered');

            case "KORBA_AIRTIME_PAY":
                return $input == '1' ? new PayFrom('korba_airtime_acc_momo') : new Error();

            case "KORBA_AIRTIME_ACC_MOMO":
                // TODO redirect when option 2 is selected using the redirect function
                /*
                 * Replace Accounts with your own functions to produce
                 * Accounts
                 * hints: it can be NameOfAppAccounts()
                 */
                $acc = ['code' => 200, 'message' => [['acc_no' => 'First'], ['acc_no' => 'Second']]];
                if ($acc['code'] == 200) {
                    return new Accounts('korba_airtime_pin', $target, $acc['message'], ['acc_no', 'acc_no']);
                } else {
                    return new Error('Could not retrieve accounts list');
                }

            case "KORBA_AIRTIME_PIN":
                /*
                 * Save the account number
                 * Replace with your own function
                 */
//                $tracker->account_number
                $acc = ['code' => 200, 'message' => [['acc_no' => 'First'], ['acc_no' => 'Second']]];
                if ($acc['code'] == 200) {
                    $tracker->account_number = json_encode($acc['message'][intval($input) - 1]);
                    return new Pin('korba_airtime_auth');
                } else {
                    return new Error('Could not retrieve accounts list');
                }

            case "KORBA_AIRTIME_VOD":
                return new Voucher('korba_airtime_auth');

            case "KORBA_AIRTIME_AUTH":
                /*
                 * Write your payment functions here
                 */
                $payload = json_decode($tracker->payload, true);
                $acc = json_decode($tracker->account_number,true);
                $recepient_number = $tracker->type == 'own' ? Util::numberGHFormat($tracker->phonenumber) : $payload['number'];
                $network = $tracker->type == 'own' ? $tracker->network : $payload['network'];
                if ($tracker->authorization == 'registered' && $has_accounts && $input != 'redirected') {
                    $pay = ['code' => 200, 'message' => 'Transaction Successful'];
                    if ($pay['code'] == 200) {
                        return new Thanks('DONE', true);
                    } else {
                        return new Error('Error during payment, try again');
                    }
                } else {
                    $pay = ['code' => 200, 'message' => 'Transaction Successful'];
                    return new Thanks($tracker->network);
                }

            default:
                return new Error();
        }
    }

    public static function redirect($tracker, &$input, &$option) {
        $suffix = $tracker->type == 'VOD' ? 'VOD' : 'AUTH';
        Util::redirect('2', $input, 'redirected', $option, 'KORBA_AIRTIME_ACC_MOMO', "KORBA_AIRTIME_{$suffix}");
    }
}
