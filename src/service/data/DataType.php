<?php


namespace Korba;


class DataType extends View
{
    public static $type_mtn = [
        'daily',
        'weekly',
        'monthly',
        'midnight',
        'lifestyle',
        'youtube'
    ];

    public function __construct($type, $type_list = null, $type_iter = null)
    {
        $content = DataMenu::$data_human[$type]." Data";
        if ($type_list) {
            parent::__construct($content, 'korba_data_list', 1, 4, $type_list, $type_iter);
        } else {
            $list = array_map('ucfirst', DataType::$type_mtn);
            parent::__construct($content, 'korba_data_list', 1, 6, $list);
        }
    }
}
