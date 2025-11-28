<?php

class App
{
    protected $controller = 'dashboard';
    protected $method = 'index';
    protected $params = [];

    public function __construct()
    {

        $url = $this->parse();

        if (file_exists('app/controllers/' . $url[0] . '.php')) {
            $this->controller = $url[0];
            unset($url[0]);
        }

        // panggil file
        if (isset($_SESSION['ID_LOGIN'])) {
            require_once 'app/controllers/' . $this->controller . '.php';
            $this->controller = new $this->controller;
        } else {
            $this->controller = 'login';
            require_once 'app/controllers/' . $this->controller . '.php';
            $this->controller = new $this->controller;
        }

        // cek file
        if (isset($url[1])) {
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        if (empty($url['url'])) {
            $this->params = array_values($url);
        }

        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    public function parse()
    {
        if (isset($_GET['url'])) {
            $url = $_GET['url'];
        } else {
            $url = 'login';
        }

        $url = rtrim($url, '/');
        $url = filter_var($url, FILTER_SANITIZE_URL);
        $url = explode('/', $url);

        return $url;
    }

}