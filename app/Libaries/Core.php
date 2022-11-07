<?php
/* 
App Core Class
creates url and load core controller
URL format -/Controller/method/params
*/
class Core{
   protected $currentController ='Pages';
   protected $currentMethod='index';
   protected $params = [];

   public function __construct()
   {
    // print_r($this->getUrl());
    $url = $this->getUrl();
    if(file_exists('../app/Controllers/' . ucwords($url[0]). '.php')){
        // if exists set as controller
       $this->currentController =ucwords($url[0]);
       // unset index 2
       unset($url[0]);
    }
    require_once('../app/Controllers/'. $this->currentController . '.php');
    // instatiating controller class 
    $this->currentController = new $this->currentController;

    // check to see if method exists in controller
    if(isset($url[1])){
        if(method_exists($this->currentController, $url[1])){
            $this->currentMethod = $url[1];

            // unset index 1
            unset($url[1]);
        }
    }
    // echo $this->currentMethod;
    // get Params 
    $this->params = $url ? array_values($url):[];

    // call a callback with arrays of params
    call_user_func_array([$this->currentController, $this->currentMethod], $this->params);

   }


   public function getUrl(){
       if(isset($_GET['url'])){
        $url = rtrim($_GET['url'],'/');
        $url = filter_var($url,FILTER_SANITIZE_URL);
        $url = explode('/', $url);
        return $url;
       }
   }
}