<?php


namespace Korba;


class ViewGroup
{
    /** @var View */
    private $views;

    /**
     * ViewGroup constructor.
     * @param View[] $views
     */
    public function __construct($views)
    {
        $this->views = $views;
    }


    /**
     * @param int $page
     * @return View
     */
    public function getView($page)
    {
        return $this->views[$page - 1];
    }
}