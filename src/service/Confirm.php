<?php


namespace Korba;


class Confirm extends View
{
    public function __construct($next, $slug = "account")
    {
        $content = "Confirm {$slug} Number\n";
        parent::__construct($content, $next, 1, null, null,null,"1.Ok\n#.Back");
    }

    public function setAll($number) {
        $this->setContent($this->getContent().Util::numberGHFormat($number));
    }
}