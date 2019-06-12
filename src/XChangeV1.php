<?php


namespace Korba;


final class XChangeV1 extends API
{

    private $secret_key;
    private $client_key;
    private $client_id;
    private static $url = 'https://xchange.korbaweb.com/api/v1.0';

    public function __construct($secret_key, $client_key, $client_id, $proxy = null)
    {
        $headers = array(
            'Cache-Control: no-cache',
            'Content-Type: application/json'
        );
        parent::__construct(XChangeV1::$url, $headers, $proxy);
        $this->secret_key = $secret_key;
        $this->client_key = $client_key;
        $this->client_id = $client_id;
    }

    private function getHMACHeader($data) {
        $data = (gettype($data) == 'string') ? json_decode($data, true) : $data;
        $data = array_merge($data, ['client_id' => $this->client_id]);
        $message = '';
        $i = 0;
        ksort($data);
        foreach ($data as $key => $value) {
            $message .= ($i == 0) ? "{$key}={$value}" : "&{$key}={$value}";
            $i++;
        }
        $hmac_signature = hash_hmac('sha256', $message, $this->secret_key);
        return ["Authorization: HMAC {$this->client_key}:{$hmac_signature}"];
    }

    protected function call($endpoint, $data, $extra_headers = null)
    {
        $data = array_merge($data, ['client_id' => $this->client_id]);
        $extra_headers = ($extra_headers) ? array_merge($extra_headers, $this->getHMACHeader($data)) : $this->getHMACHeader($data);
        return parent::call($endpoint, $data, $extra_headers);
    }

    protected function add_optional_data(&$data, $optional_data) {
        foreach ($optional_data as $key => $value) {
            if ($optional_data[$key]) {
                $data[$key] = $value;
            }
        }
    }

    public function collect(
        $customer_number, $amount, $transaction_id, $network_code, $callback_url,
        $vodafone_voucher_code = null, $description = null, $payer_name = null, $extra_info = null) {
        $data = [
            'customer_number' => Util::numberGHFormat($customer_number),
            'amount' => $amount,
            'transaction_id' => $transaction_id,
            'network_code' => $network_code,
            'callback_url' => $callback_url
        ];
        $opt_data = [
            'vodafone_voucher_code' => $vodafone_voucher_code,
            'description' => $description,
            'payer_name' => $payer_name,
            'extra_info' => $extra_info
        ];
        $this->add_optional_data($data, $opt_data);
        return $this->call('collect/', $data);
    }

    public function disburse(
        $customer_number, $amount, $transaction_id, $network_code, $callback_url,
        $description = null, $extra_info = null, $bank_account_number = null,
        $bank_name = null, $bank_branch_name = null, $payer_name = null, $payer_mobile = null) {
        $data = [
            'customer_number' => $customer_number,
            'amount' => $amount,
            'transaction_id' => $transaction_id,
            'network_code' => $network_code,
            'callback_url' => $callback_url
        ];
        $opt_data = [
            'description' => $description,
            'extra_info' => $extra_info,
            'bank_account_number' => $bank_account_number,
            'bank_name' => $bank_name,
            'bank_branch_name' => $bank_branch_name,
            'payer_name' => $payer_name,
            'payer_mobile' => $payer_mobile
        ];
        $this->add_optional_data($data, $opt_data);
        return $this->call('disburse/', $data);
    }

    public function top_up(
        $customer_number, $amount, $transaction_id, $network_code, $callback_url,
        $description = null, $payer_name = null, $extra_info = null) {
        $data = [
            'customer_number' => $customer_number,
            'amount' => $amount,
            'transaction_id' => $transaction_id,
            'network_code' => $network_code,
            'callback_url' => $callback_url
        ];
        $opt_data = [
            'description' => $description,
            'payer_name' => $payer_name,
            'extra_info' => $extra_info
        ];
        $this->add_optional_data($data, $opt_data);
        return $this->call('topup/', $data);
    }

    private function internet_bundle_data(
        $customer_number, $transaction_id, $bundle_id, $amount, $callback_url,
        $description = null, $payer_name = null, $extra_info = null) {
        $data = [
            'customer_number' => $customer_number,
            'transaction_id' => $transaction_id,
            'bundle_id' => $bundle_id,
            'amount' => $amount,
            'callback_url' => $callback_url
        ];
        $opt_data = [
            'description' => $description,
            'payer_name' => $payer_name,
            'extra_info' => $extra_info
        ];
        $this->add_optional_data($data, $opt_data);
        return $data;
    }

    public function surfline_purchase(
        $customer_number, $transaction_id, $bundle_id, $amount, $callback_url,
        $description = null, $payer_name = null, $extra_info = null) {
        $data = $this->internet_bundle_data(
            $customer_number, $transaction_id, $bundle_id, $amount, $callback_url,
            $description, $payer_name, $extra_info);
        return $this->call('purchase_surfline_bundle/', $data);
    }

    public function surfline_bundles($customer_number) {
        $data = [
            'customer_number' => $customer_number
        ];
        return $this->call('get_surfline_bundles/', $data);
    }

    public function busy_purchase(
        $customer_number, $transaction_id, $bundle_id, $amount, $callback_url,
        $description = null, $payer_name = null, $extra_info = null) {
        $data = $this->internet_bundle_data(
            $customer_number, $transaction_id, $bundle_id, $amount, $callback_url,
            $description, $payer_name, $extra_info);
        return $this->call('purchase_busy_bundle/', $data);
    }

    public function busy_bundles($customer_number) {
        $data = [
            'customer_number' => $customer_number
        ];
        return $this->call('get_busy_bundles/', $data);
    }

    public function telesol_purchase(
        $customer_number, $transaction_id, $bundle_id, $amount, $callback_url,
        $description = null, $payer_name = null, $extra_info = null) {
        $data = $this->internet_bundle_data(
            $customer_number, $transaction_id, $bundle_id, $amount, $callback_url,
            $description, $payer_name, $extra_info);
        return $this->call('purchase_telesol_bundle/', $data);
    }

    public function telesol_bundles() {
        return $this->call('get_telesol_bundles/', []);
    }

    public function ecg_pay(
        $customer_number, $transaction_id, $amount, $callback_url,
        $description = null, $payer_name = null, $extra_info = null) {
        $data = [
            'customer_number' => $customer_number,
            'transaction_id' => $transaction_id,
            'amount' => $amount,
            'callback_url' => $callback_url
        ];
        $opt_data = [
            'description' => $description,
            'payer_name' => $payer_name,
            'extra_info' => $extra_info
        ];
        $this->add_optional_data($data, $opt_data);
        return $this->call('ecg_pay_bill/', $data);
    }

    public function gwcl_lookup($customer_number, $account_number, $transaction_id) {
        $data = [
            'customer_number' => Util::number233Format($customer_number),
            'account_number' => $account_number,
            'transaction_id' => $transaction_id
        ];
        return $this->call('gwcl_customer_lookup/', $data);
    }

    public function gwcl_pay($gwcl_transaction_id, $amount, $callback_url, $description = null) {
        $data = [
            'transaction_id' => $gwcl_transaction_id,
            'amount' => $amount,
            'callback_url' => $callback_url,
            'description' => $description
        ];
        return $this->call('gwcl_pay_bill/', $data);
    }

    private function internet_product_data(
        $customer_number, $transaction_id, $product_id, $amount, $callback_url,
        $description = null, $payer_name = null, $extra_info = null) {
        $data = [
            'customer_number' => $customer_number,
            'transaction_id' => $transaction_id,
            'product_id' => $product_id,
            'amount' => $amount,
            'callback_url' => $callback_url
        ];
        $opt_data = [
            'description' => $description,
            'payer_name' => $payer_name,
            'extra_info' => $extra_info
        ];
        $this->add_optional_data($data, $opt_data);
        return $data;
    }

    public function mtn_purchase(
        $customer_number, $transaction_id, $product_id, $amount, $callback_url,
        $description = null, $payer_name = null, $extra_info = null) {
        $data = $this->internet_product_data(
            $customer_number, $transaction_id, $product_id, $amount, $callback_url,
            $description, $payer_name, $extra_info);
        return $this->call('mtn_data_topup/', $data);
    }

    public function mtn_bundles() {
        return $this->call('get_mtndata_product_id/', []);
    }

    public function mtn_fibre_purchase(
        $customer_number, $transaction_id, $product_id, $amount, $callback_url,
        $description = null, $payer_name = null, $extra_info = null) {
        $data = $this->internet_product_data(
            $customer_number, $transaction_id, $product_id, $amount, $callback_url,
            $description, $payer_name, $extra_info);
        return $this->call('mtn_fibre_topup/', $data);
    }

    public function mtn_fibre_bundles() {
        return $this->call('get_mtnfibre_product_id/', []);
    }

    public function airteltigo_purchase(
        $customer_number, $transaction_id, $product_id, $amount, $callback_url,
        $description = null, $payer_name = null, $extra_info = null) {
        $data = $this->internet_product_data(
            $customer_number, $transaction_id, $product_id, $amount, $callback_url,
            $description, $payer_name, $extra_info);
        return $this->call('airteltigo_data_topup/', $data);
    }

    public function airteltigo_bundles() {
        return $this->call('get_airteltigodata_product_id/', []);
    }

    public function etransact_validate($customer_number, $bill_type, $transaction_id) {
        $data = [
            'customer_number' => $customer_number,
            'bill_type' => $bill_type,
            'transaction_id' => $transaction_id
        ];
        return $this->call('etransact_validate_user/', $data);
    }

    public function etransact_pay(
        $customer_number, $bill_type, $transaction_id, $sender_name, $address, $amount, $callback_url,
        $description = null, $payer_name = null, $extra_info = null) {
        $data = [
            'customer_number' => $customer_number,
            'bill_type' => $bill_type,
            'transaction_id' => $transaction_id,
            'sender_name' => $sender_name,
            'address' => $address,
            'amount' => $amount,
            'callback_url' => $callback_url
        ];
        $opt_data = [
            'description' => $description,
            'payer_name' => $payer_name,
            'extra_info' => $extra_info
        ];
        $this->add_optional_data($data, $opt_data);
        return $this->call('etransact_pay_bill/', $data);
    }

    public function transaction_status($transaction_id) {
        $data = [
            'transaction_id' => $transaction_id
        ];
        return $this->call('transaction_status/', $data);
    }

    public function mtn_recurring_create_mandate(
        $customer_number, $transaction_id, $amount, $mandate_creation_callback_url, $debit_customer_callback_url,
        $debit_day, $frequency_type, $frequency = 1, $start_date = 'today', $end_date = 'infinite',
        $description = null, $payer_name = null, $extra_info = null) {
        $data = [
            'customer_number' => Util::number233Format($customer_number),
            'transaction_id' => $transaction_id,
            'amount' => $amount,
            'frequency_type' => $frequency_type,
            'frequency' => $frequency,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'mandate_creation_call_back_url' => $mandate_creation_callback_url,
            'debit_customer_call_back_url' => $debit_customer_callback_url,
            'debit_day' => $debit_day
        ];
        $opt_data = [
            'description' => $description,
            'payer_name' => $payer_name,
            'extra_info' => $extra_info
        ];
        $this->add_optional_data($data, $opt_data);
        return $this->call('mtn_recurring_create_mandate/', $data);
    }

    public function mtn_recurring_update_mandate(
        $customer_number, $transaction_id, $amount, $mandate_id,
        $debit_day, $frequency_type, $frequency = 1, $start_date = 'today', $end_date = 'infinite',
        $description = null, $payer_name = null, $extra_info = null) {
        $data = [
            'customer_number' => Util::number233Format($customer_number),
            'transaction_id' => $transaction_id,
            'amount' => $amount,
            'frequency_type' => $frequency_type,
            'frequency' => $frequency,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'mandate_id' => $mandate_id,
            'debit_day' => $debit_day
        ];
        $opt_data = [
            'description' => $description,
            'payer_name' => $payer_name,
            'extra_info' => $extra_info
        ];
        $this->add_optional_data($data, $opt_data);
        return $this->call('mtn_recurring_update_mandate/', $data);
    }

    public function mtn_recurring_cancel_mandate($customer_number, $transaction_id, $mandate_id, $description = null) {
        $data = [
            'customer_number' => Util::number233Format($customer_number),
            'transaction_id' => $transaction_id,
            'mandate_id' => $mandate_id
        ];
        $opt_data = [
            'description' => $description
        ];
        $this->add_optional_data($data, $opt_data);
        return $this->call('mtn_recurring_cancel_mandate/', $data);
    }

    public function mtn_recurring_cancel_pre_approval($customer_number) {
        $data = [
            'customer_number' => Util::number233Format($customer_number)
        ];
        return $this->call('mtn_recurring_cancel_pre_approval/', $data);
    }

    public function mtn_recurring_check_mandate_status($transaction_id) {
        $data = [
            'transaction_id' => $transaction_id
        ];
        return $this->call('mtn_recurring_check_mandate_status/', $data);
    }
}
