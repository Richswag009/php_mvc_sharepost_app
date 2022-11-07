<?php
/* Base Controller
loads the models and view
*/

class Controller{

    // load model
    public function model($model){
         
        // require model file 
        require_once('../app/Models/'. $model .'.php');

        // instatite models
        return new $model();
    }

    // load views
    public function views($views, $data=[]){

        // require view file
        if(file_exists('../app/Views/'.$views .'.php')){
             require_once('../app/Views/'. $views .'.php');
        }else{
            // if file does not exist
            die('Views does not exist');
        }
    }
}