<?php

class App {

    //Default Werte
    protected $controller = 'home';
    protected $method = 'index';
    protected $params = [];

    function __construct() {

        /*
          $url = array_key_exists('url', $_GET) ? $_GET['url'] : 'index';
          $url = rtrim($url, '/');
          $url = explode('/', $url);
          print_r($url);

          $file = 'controllers/' . $url[0] . 'Controller.php';
          if (file_exists($file)) {
          require $file;
          } else {
          require 'controllers/errorController.php';
          $controller = new Error();
          return false;
          }

          $controller = new $url[0];

          if (isset($url[2])) {
          $controller->{$url[1]}($url[2]);
          } else {
          if (isset($url[1])) {
          $controller->{$url[1]}();
          }
          }
         */


        // Trennt Url zwischen / und erstellt Array
        $url = $this->parseUrl();
        
        // Prüfe ob Controller existiert
        $file = '../app/controllers/' . $url[0] . '.php';
        if (file_exists($file)) {
            $this->controller = $url[0];
            unset($url[0]);
        }
        
        //lade Controller (falls er nicht existiert, lade home)
        $file = '../app/controllers/' . $this->controller . '.php';
        require_once $file;
        
        //erstelle neues controller objekt
        $this->controller = new $this->controller;
        
        //Prüfe ob Methode existiert
        if (isset($url[1])) {
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }
        
        //Prüfe ob weitere Parameter vorhanden. sonst leeres Array schreiben
        $this->params = $url ? array_values($url) : [];
        
        //Rufe Methode auf
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    public function parseUrl() {
        if (isset($_GET['url'])) {
            return $url = explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL)); 
        }
    }

}
