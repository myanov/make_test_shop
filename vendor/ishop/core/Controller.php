<?php


namespace ishop;


abstract class Controller
{

    public $route;
    public $controller;
    public $view;
    public $model;
    public $layout;
    public $prefix;
    public $data = [];
    public $meta = [];

    public function __construct($route)
    {
        $this->route = $route;
        $this->controller = $route["controller"];
        $this->view = $route["action"];
        $this->model = $route["controller"];
        $this->prefix = $route["prefix"];
    }

    public function getView()
    {
        $viewObj = new View($this->route, $this->layout, $this->view, $this->meta);
        $viewObj->render($this->data);
    }

    public function set($data)
    {
        $this->data = $data;
    }

    public function setMeta($title = '', $keywords = '', $description = '')
    {
        $this->meta["title"] = $title;
        $this->meta["keywords"] = $keywords;
        $this->meta["description"] = $description;
    }
}