<?php


namespace Korba;


class ExampleServiceScript
{
    private function __construct() { }

    public static function copyMe(&$tracker, $input, $target, $option, $has_accounts = true, $available = [false, true, true, true, true]) {
        switch ($option) {
            case "KORBA_MENU":
                $tracker->type = 'non-registered';
                return new Menu(...$available);
                break;

            case "KORBA_MENU_R":
                $tracker->type = 'registered';
                return new Menu(...$available);
                break;

            case "KORBA_SUB_MENU":
                $view_group = new SubMenu(...$available);
                return intval($input) >= 1 && intval($input) <= 5 ? $view_group->getView($input) : new Error();
                break;

            case "KORBA_AIRTIME_NET_NUM":
                $tracker->type = $input == '1' ? 'other' : 'own';
                $view_group = new AirtimeNetNum();
                return $input == '1' || $input == '2' ? $view_group->getView($input) : new Error();
                break;

            case "KORBA_AIRTIME_NUM":
                $network = AirtimeNetwork::$network[intval($input) - 1];
                $tracker->payload = json_encode(['network' => $network]);
                return new AccountNumber('korba_airtime_num_confirm', 'recipient');
                break;

            case "KORBA_AIRTIME_NUM_CONFIRM":
                $payload = json_decode($tracker->payload, true);
                $tracker->payload = json_encode([
                    'network' => $payload['network'],
                    'number' => Util::numberGHFormat($input)
                ]);
                return new Confirm('korba_airtime_amount',Util::numberGHFormat($input), 'recipient');
                break;

            case "KORBA_AIRTIME_AMOUNT":
                return $input == '1' ? new Amount('korba_airtime_confirmation') : new Error();
                break;

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
                break;

            case "KORBA_AIRTIME_PAY":
                return $input == '1' ? new PayFrom('korba_airtime_acc_momo') : new Error();
                break;

            case "KORBA_AIRTIME_ACC_MOMO":
                // TODO redirect when option 2 is selected
                /*
                 * Replace Accounts with your own functions to produce
                 * Accounts
                 * hints: it can be NameOfAppAccounts()
                 */
                return 1;
                break;

            case "KORBA_AIRTIME_PIN":
                /*
                 * Save the account number
                 */
//                $tracker->account_number
                return new Pin('korba_airtime_auth');
                break;

            case "KORBA_AIRTIME_VOD":
                return new Voucher('korba_airtime_auth');
                break;

            case "KORBA_AIRTIME_AUTH":
                /*
                 * Write your payment functions here
                 */
                return 1;


                default:
                    return new Error();
        }
    }

    public static function redirect($tracker, &$input, &$option) {
        $suffix = $tracker->type == 'VOD' ? 'VOD' : 'AUTH';
        Util::redirect('2', $input, '2', $option, 'KORBA_AIRTIME_ACC_MOMO', "KORBA_AIRTIME_{$suffix}");
    }
}
