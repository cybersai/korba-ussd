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
            Param::SESSION_ID,
            Param::PHONE_NUMBER,
            Param::NETWORK,
            Param::OPTION,
            Param::TARGET,
            Param::HISTORY,
            Param::PAYLOAD,
            Param::ACCOUNT_NUMBER,
            Param::AMOUNT,
            Param::PURPOSE,
            Param::AUTHORIZATION,
            Param::TYPE,
            Param::TRANSACTION_ID
        ];
    }

    /**
     * @param \stdClass $table
     */
    public static function createTableDefaultParameters(&$table) {
        $table->string(Param::SESSION_ID)->unique();
        $table->string(Param::PHONE_NUMBER);
        $table->string(Param::NETWORK);
        $table->integer(Param::TARGET)->unsigned()->default(1);
        $table->string(Param::OPTION);
        $table->text(Param::HISTORY)->nullable();
        $table->text(Param::PAYLOAD)->nullable();
        $table->string(Param::ACCOUNT_NUMBER)->nullable();
        $table->string(Param::AMOUNT)->nullable();
        $table->string(Param::PURPOSE)->nullable();
        $table->string(Param::AUTHORIZATION)->nullable();
        $table->string(Param::TRANSACTION_ID)->unique();
        $table->string(Param::TYPE)->nullable();
    }
}
