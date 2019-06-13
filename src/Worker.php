<?php


namespace Korba;


abstract class Worker
{
    /** @var View[] */
    private $views;
    /** @var View */
    private $view;

    public function __construct($views)
    {
        $this->views = $views;
    }

    /**
     * @return View
     */
    public function getSelectedView()
    {
        return $this->view;
    }


    /**
     * @param int $pos
     * @return View
     */
    protected function getView($pos)
    {
        return $this->views[$pos - 1];
    }

    /**
     * @param View $view
     */
    protected function setView($view)
    {
        $this->view = $view;
    }

    /**
     * @param View[] $views
     */
    public function setViews($views)
    {
        $this->views = $views;
    }


    /**
     * @return View
     */
    abstract public function process(&$tracker, $input);
}