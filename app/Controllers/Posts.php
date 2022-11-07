<?php
class Posts extends Controller {

    public function __construct()
    {
        if(!isLoggedIn()){
            redirect('Users/Login');
        }

        $this->postModel = $this->model('Post');
        $this->userModel = $this->model('User');
    }

    Public function index(){
        // get posts
      
        $posts = $this->postModel->getPosts();
        $data=[
            'Posts'=>$posts
        ];
        $this->views('Posts/Index', $data);
    }

    public function add(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            
            // process form 
         
            $data=[
                'title'=>trim($_POST['title']),
                'body'=>trim($_POST['body']),
                'user_id'=>$_SESSION['user_id'],
                'title_err'=>'',
                'body_err'=>''
                
            ]; 

            // validation 
            if(empty($data['title'])){
                $data['title_err']='please enter a title';
            }
            // validating body 
            if(empty($data['body'])){
                $data['body_err']='please enter a body';
            }

            // make sure error fields are empty
            if(empty($data['title_err']) && empty($data['body_err'])){
               if($this->postModel->addPost($data)){
                flash('post_dded', 'post added');
                redirect('Posts');
               }else{
                die('something went wrong');
               }
            }else{
                // load views with errors
                 $this->views('Posts/Add',$data);


            }
        }else{
              $data=[
                'title'=>'',
                'body'=>'',
                'title_err'=>'',
                'body_err'=>''
               
                
            ]; 

            $this->views('Posts/Add', $data);
        }
    }

    public function show($id){
        $post = $this->postModel->getPostById($id);
        $user = $this->userModel->getUserById($post->user_id);

        $data =[
            'post'=>$post,
            'user'=>$user
        ];
        $this->views('Posts/Show', $data);
    }

    // edit post
    
    public function edit($id){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            
            // process form 
         
            $data=[
                'id'=> $id,
                'title'=>trim($_POST['title']),
                'body'=>trim($_POST['body']),
                'user_id'=>$_SESSION['user_id'],
                'title_err'=>'',
                'body_err'=>''
                
            ]; 

            // validation 
            if(empty($data['title'])){
                $data['title_err']='please enter a title';
            }
            // validating body 
            if(empty($data['body'])){
                $data['body_err']='please enter a body';
            }

            // make sure error fields are empty
            if(empty($data['title_err']) && empty($data['body_err'])){
               if($this->postModel->updatePost($data)){
                flash('post_message', 'post updated');
                redirect('Posts');
               }else{
                die('something went wrong');
               }
            }else{
                // load views with errors
                 $this->views('Posts/Edit',$data);


            }
        }else{

            // get existingpost from model

            $post= $this->postModel->getPostById($id);
            // check for owner
            if($post->user_id != $_SESSION['user_id']){
                 redirect('Posts');
            }
            
              $data=[
                'id'=>$id,
                'title'=>$post->title,
                'body'=>$post->body,
                'body_err'=>''
               
                
            ]; 

            $this->views('Posts/Edit', $data);
        }
    }

    public function delete($id){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            

            $post= $this->postModel->getPostById($id);
            // check for owner
            if($post->user_id != $_SESSION['user_id']){
                 redirect('Posts');
            }
            

           if($this->postModel->deletePost($id)){
            flash('post_message', 'post removed');
            redirect('Posts');
           }else{
            die('something went wrong');
           }
        }else{
            redirect('Posts');
        }
    }

} 