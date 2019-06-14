<?php


namespace Korba;


abstract class Worker
{
    /** @var View[]|ViewGroup[] */
    private $views;
    /** @var View|ViewGroup */
    private $view;

    public function __construct($views)
    {
        $this->views = $views;
//        $this->setView($views[0]);
    }


    /**
     * @param $pos
     * @return View
     */
    public function getSelectedView($pos)
    {
        return $this->view instanceof View ? $this->view : $this->view->getView($pos);
    }


    /**
     * @param int $pos
     * @return View|ViewGroup
     */
    protected function getView($pos)
    {
        return $this->views[$pos - 1];
    }

    /**
     * @param View|ViewGroup $view
     */
    protected function setView($view)
    {
        $this->view = $view;
    }

    /**
     * @param View[]|ViewGroup[] $views
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