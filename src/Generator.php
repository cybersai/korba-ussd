<?php

namespace Korba;

class Generator
{
    private function __construct() { }

    /**
     * @return array
     */
    public static function getModelDefaultParameters() {
        return [
            'session_id',
            'phone_number',
            'network',
            'option',
            'target',
            'history',
            'payload',
            'account_number',
            'amount',
            'purpose',
            'authorization',
            'type',
            'transaction_id'
        ];
    }

    /**
     * @param $table
     */
    public static function createTableDefaultParameters(&$table) {
        $table->string('session_id');
        $table->string('phone_number');
        $table->string('network');
        $table->integer('target')->unsigned()->default(1);
        $table->string('option');
        $table->text('history')->nullable();
        $table->text('payload')->nullable();
        $table->string('account_number')->nullable();
        $table->string('amount')->nullable();
        $table->string('purpose')->nullable();
        $table->string('authorization')->nullable();
        $table->string('transaction_id')->unique();
        $table->string('type');
    }
}
