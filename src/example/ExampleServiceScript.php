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

                /*
                 * Airtime Transactions
                 */

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
                return Util::verifyPhoneNumber(Util::numberGHFormat($input)) ? new Confirm('korba_airtime_amount',Util::numberGHFormat($input), 'recipient') : new Error('Invalid Phone Number');

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
                $recepient_number = $tracker->type == 'own' ? Util::numberGHFormat($tracker->phone_number) : $payload['number'];
                $network = $tracker->type == 'own' ? $tracker->network : $payload['network'];
                if ($tracker->authorization == 'registered' && $has_accounts && $input != 'redirected') {
                    $pay = ['code' => 200, 'message' => 'Transaction Successful'];
                    if ($pay['code'] == 200) {
                        return new Thanks('DONE', true);
                    } else {
                        return new Error('Error during payment, try again');
                    }
                } else {
                    // Make null for non-vodafone
                    $input = $tracker->network == 'VOD' ? $input : null;
                    $pay = ['code' => 200, 'message' => 'Transaction Successful'];
                    return new Thanks($tracker->network);
                }

            case "KORBA_DATA_NUM":
                if (intval($input) >= 1 && intval($input <= 6)) {
                    $tracker->type = DataMenu::$data[intval($input) - 1];
                    return new AccountNumber('korba_data_confirm');
                } else {
                    return new Error();
                }

            case "KORBA_DATA_CONFIRM":
                if ($tracker->type == 'busy') {
                    $is_valid = Util::verifyNumberLength($input, 6);
                    $tracker->payload = json_encode(['number' => $input]);
                } else if ($tracker->type == 'surfline') {
                    $is_valid = Util::verifyNumberLength($input);
                    $tracker->payload = json_encode(['number' => $input]);
                } else {
                    $is_valid = Util::verifyPhoneNumber(Util::numberGHFormat($input));
                    $tracker->payload = json_encode(['number' => Util::numberGHFormat($input)]);
                }
                $next = $tracker->type == 'glo' || $tracker->type == 'mtn' ? 'korba_data_type' : 'korba_data_list';
                return $is_valid ? new Confirm($next, $input) : new Error('Invalid Account Number');

            case "KORBA_DATA_TYPE":
                if ($tracker->type == 'glo') {
                    $xchange = new XChangeV1('fd2f9df0d6876e88c6e81f7a4748c90c207ebb497bd4822ef689628b0045743b', '457b43b4e30a0be7c94fb0544ba3e10d3b900fff', '9');
                    $data_types = $xchange->glo_types();
                    return $data_types['success'] ? new DataType($tracker->type, $data_types['results'], ['id', 'name']) : new Error('Could not retrieve glo data type list');
                }
                return new DataType($tracker->type);

            case "KORBA_DATA_LIST":
                $payload = json_decode($tracker->payload, true);
                $xchange = new XChangeV1('fd2f9df0d6876e88c6e81f7a4748c90c207ebb497bd4822ef689628b0045743b', '457b43b4e30a0be7c94fb0544ba3e10d3b900fff', '9');
                if ($tracker->type == 'airteltigo') {
                    $data_list = $xchange->airteltigo_bundles();
                } else if ($tracker->type == 'busy') {
                    $data_list = $xchange->busy_bundles($payload['number']);
                } else if ($tracker->type == 'glo') {
                    $type = $xchange->glo_types();
                    if ($type['success']) {
                        $data_list = $xchange->glo_bundles($type['results'][intval($input) - 1]['id']);
                    }
                } else if ($tracker->type == 'mtn') {
                    $data_list = $xchange->mtn_bundles(DataType::$type_mtn[intval($input) - 1]);
                } else if ($tracker->type == 'mtn_fibre') {
                    $data_list = $xchange->mtn_fibre_bundles();
                } else {
                    $data_list = $xchange->surfline_bundles($payload['number']);
                }
                $tracker->payload = json_encode([
                    'number' => $payload['number'],
                    'input' => $input
                ]);
                if ($data_list['success']) {
                    return new DataList('korba_data_confirmation', $tracker->type, $target, $data_list['bundles'], ['id', 'description']);
                } else {
                    return new Error('Could not retrieve data list');
                }

            case "KORBA_DATA_CONFIRMATION":
                $payload = json_decode($tracker->payload, true);
                $xchange = new XChangeV1('fd2f9df0d6876e88c6e81f7a4748c90c207ebb497bd4822ef689628b0045743b', '457b43b4e30a0be7c94fb0544ba3e10d3b900fff', '9');
                if ($tracker->type == 'airteltigo') {
                    $data_list = $xchange->airteltigo_bundles();
                } else if ($tracker->type == 'busy') {
                    $data_list = $xchange->busy_bundles($payload['number']);
                } else if ($tracker->type == 'glo') {
                    $type = $xchange->glo_types();
                    if ($type['success']) {
                        $data_list = $xchange->glo_bundles($type['results'][intval($payload['input']) - 1]['id']);
                    }
                } else if ($tracker->type == 'mtn') {
                    $data_list = $xchange->mtn_bundles(DataType::$type_mtn[intval($payload['input']) - 1]);
                } else if ($tracker->type == 'mtn_fibre') {
                    $data_list = $xchange->mtn_fibre_bundles();
                } else {
                    $data_list = $xchange->surfline_bundles($payload['number']);
                }
                if (!$data_list['success']) {
                    return new Error('Could not retrieve bundle list');
                }
                if ($tracker->authorization != 'registered') {
                    $next = $tracker->network == 'VOD' ? 'korba_data_vod' : 'korba_data_auth';
                } else {
                    $next = $has_accounts ? 'korba_data_pay' : 'korba_data_auth';
                }
                $number = $payload['number'];
                if (Util::verifyWholeNumber($input)) {
                    $bundle = $data_list['bundles'][intval($input) - 1];
                    $tracker->amount = $bundle['price'];
                    $tracker->payload = json_encode([
                        'number' => $payload['number'],
                        'input' => $payload['input'],
                        'bundle' => $bundle
                    ]);
                    return new ConfirmationPage($next, ucfirst($tracker->type), $number, $bundle['price']);
                }
                return new Error('Invalid Amount Entered');

            case "KORBA_DATA_PAY":
                return $input == '1' ? new PayFrom('korba_data_acc_momo') : new Error();

            case "KORBA_DATA_ACC_MOMO":
                // TODO redirect when option 2 is selected using the redirect function
                /*
                 * Replace Accounts with your own functions to produce
                 * Accounts
                 * hints: it can be NameOfAppAccounts()
                 */
                $acc = ['code' => 200, 'message' => [['acc_no' => 'First'], ['acc_no' => 'Second']]];
                if ($acc['code'] == 200) {
                    return new Accounts('korba_data_pin', $target, $acc['message'], ['acc_no', 'acc_no']);
                } else {
                    return new Error('Could not retrieve accounts list');
                }

            case "KORBA_DATA_PIN":
                /*
                 * Save the account number
                 * Replace with your own function
                 */
//                $tracker->account_number
                $acc = ['code' => 200, 'message' => [['acc_no' => 'First'], ['acc_no' => 'Second']]];
                if ($acc['code'] == 200) {
                    $tracker->account_number = json_encode($acc['message'][intval($input) - 1]);
                    return new Pin('korba_data_auth');
                } else {
                    return new Error('Could not retrieve accounts list');
                }

            case "KORBA_DATA_VOD":
                return new Voucher('korba_data_auth');

            case "KORBA_DATA_AUTH":
                /*
                 * Write your payment functions here
                 */
                $payload = json_decode($tracker->payload, true);
                $acc = json_decode($tracker->account_number,true);
                $recepient_number = $payload['number'];
                if ($tracker->authorization == 'registered' && $has_accounts && $input != 'redirected') {
                    $pay = ['code' => 200, 'message' => 'Transaction Successful'];
                    if ($pay['code'] == 200) {
                        return new Thanks('DONE', true);
                    } else {
                        return new Error('Error during payment, try again');
                    }
                } else {
                    // Make null for non-vodafone
                    $input = $tracker->network == 'VOD' ? $input : null;
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
        Util::redirect('2', $input, 'redirected', $option, 'KORBA_DATA_ACC_MOMO', "KORBA_DATA_{$suffix}");
    }
}