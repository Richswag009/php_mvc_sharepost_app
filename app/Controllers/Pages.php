<?php
class Pages extends Controller{

    public function __construct()
    {
    
    }

    public function about(){
        $data= ['title'=>'About Us',
     'description'=>'An app to share your feelings and thought with others'];
        $this->views('Pages/About', $data);
          
    }

    public function index(){
       
          if(isLoggedIn()){
            redirect('Posts');
        }
        $data= ['title'=>'SharePosts','description'=>'Simple Social Network Built on the Mvc php framework'
   ];     
        $this->views('Pages/Home',$data);
    }
}