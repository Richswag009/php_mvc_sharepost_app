<?php
class Users extends Controller {
    public function __construct()
    {
     $this->userModel = $this->model('User') ;
    }


    public function register(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
        
            // process form 
            // $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            
           $data=[
            'name'=> trim($_POST['name']),
            'email'=>trim($_POST['email']),
            'password'=>trim($_POST['password']),
            'confirm_password'=>trim($_POST['confirm_password']),
            'name_err'=>'',
            'email_err'=>'',
            'password_err'=>'',
            'confirm_password_err'=>'' 
           ]; 
        //    validating datas

            // validating Email
            if(empty($data['email'])){
                $data['email_err']='please enter a valid email';
            }else{
                if($this->userModel->findUserByEmail($data['email'])){
                $data['email_err']='Email is already taken ';                 
                }
            }

            // validating name
            if(empty($data['name'])){
                $data['name_err']='please enter a valid name';
            }
            // validating password
            if(empty($data['password'])){
                $data['password_err']='please enter a valid password';
            }elseif(strlen($data['password']<6)){
                $data['password_err']='password must be greater than 6';
                
            }
            // validating confirm password
            if(empty($data['confirm_password'])){
                $data['confirm_password_err']='please enter a valid password';
            }else{
                if($data['password'] != $data['confirm_password']){
                $data['confirm_password_err']='  incorrect password';

                }
            }

            // make sure errors field are empty
            if(empty($data['name_err']) && empty($data['email_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])){
         
                // hash password
                $data['password']= password_hash($data['password'], PASSWORD_DEFAULT);

                // Register user
                if($this->userModel->register($data)){
                    flash('register_success', 'you are registered, you can login', 'alert alert-success');
                    redirect('Users/Login');
                }else{
                    die('something went wrong');
                }

            }else{
                // load view
                $this->views('Users/Register',$data);
            }

        }

        // init data&&
        else{

            $data=[
            'name'=>'',
            'email'=>'',
            'password'=>'',
            'confirm_password'=>'',
            'name_err'=>'',
            'email_err'=>'',
            'password_err'=>'',
            'confirm_password_err'=>'' 
           ]; 
       

        //    load view

        $this->views('Users/Register',$data);
        }
    }



    public function login(){

           if($_SERVER['REQUEST_METHOD'] === 'POST'){
        
            // process form 
            $data=[
                'email'=>trim($_POST['email']),
                'password'=>trim($_POST['password']),
                'email_err'=>'',
                'password_err'=>'',
            ];  

            // validating Email
            if(empty($data['email'])){
                $data['email_err']='please enter a valid email';
            }
            // validating Password
            if(empty($data['password'])){
                $data['password_err']='please enter a valid password';
            }

            // check for email
            if($this->userModel->findUserByEmail($data['email'])){

            }else{
                // user not found
                $data['email_err']= 'no user with this email';
            }
               // make sure errors field are empty
            if(empty($data['name_err']) && empty($data['password_err']) ){
                // validated
                
                // check and set logged in user
                $loggedInUser= $this->userModel->login($data['email'], $data['password']);
                if($loggedInUser){
                    // create session
                    $this->createUserSession($loggedInUser);
                }else{
                    $data['password_err']='password incorrect';
                    $this->views('Users/Login', $data);
                }
            }else{
                // load view
                $this->views('Users/Login',$data);
            }

        }
        // init data
        else{
           $data=[
          
            'email'=>'',
            'password'=>'',           
            'email_err'=>'',
            'password_err'=>'',
           ]; 
        $this->views('Users/Login',$data);

    }

}
    public function  createUserSession($user){
      $_SESSION['user_id']= $user->id;
      $_SESSION['user_email']= $user->email;
      $_SESSION['user_name']= $user->name;
      redirect('Posts');
    }
    public function logout(){
        unset($_SESSION['user_id']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_name']);
        session_destroy();
        redirect('Users/Login');
    }
    
    public function isLoggedIn(){
        if(isset($_SESSION['user_id'])){
            return true;
        }else{
            return false;
        }
    }

}