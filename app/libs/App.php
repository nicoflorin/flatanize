<?php

class App {

    //Default Werte
    protected $controller = 'home';
    protected $method = 'index';
    protected $params = [];

    function __construct() {
        
    }

    public function init() {
        // Trennt Url zwischen / und erstellt Array
        $url = $this->parseUrl();

        // Prüfe ob Controller existiert
        $file = '../app/controllers/' . $url[0] . '.php';
        if (file_exists($file)) {
            $this->controller = $url[0];
            unset($url[0]);
        }

        //lade Controller (falls er nicht existiert, lade home)
        $file = ROOT. '/app/controllers/' . $this->controller . '.php';
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

    /**
     * Liest url String aus und trennt diesen nach "/". Erstellt Array mit
     * @return string
     */
    public function parseUrl() {
        if (isset($_GET['url'])) {
            return $url = explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
    }

}
