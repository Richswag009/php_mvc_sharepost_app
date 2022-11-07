<?php
class User{
    private $db;

    public function __construct()
    {
       $this->db = new Database; 
    }
    

    // find user by email
    public function findUserByEmail($email){
        $this->db->query('SELECT * FROM users WHERE email = :email');
        $this->db->bind('email', $email);
        $row = $this->db->singleCount();
        
        // check row
        if($this->db->rowCount() > 0){
            return true;
        }else{
            return false;
        }
    }

    # function to register a new user
    public function register($data){
        $this->db->query('INSERT INTO users(name, email, password) VALUES(:name, :email, :password )');
        $this->db->bind(':name', $data['name']); 
        $this->db->bind(':email', $data['email']); 
        $this->db->bind(':password', $data['password']); 
        
        if($this->db->execute()){
            return true;
        }else{
            return false;
        };
    }
    // login user
    public function login($email, $password){
        $this->db->query('SELECT * FROM users WHERE email =:email ');
        $this->db->bind(':email', $email);
        $row = $this->db->singleCount();

        $hashed_password = $row->password;
        if(password_verify($password, $hashed_password)){
          return $row;   
        }else{
            return false;
        }
    }
        
    // get user by id
       public function getUserById($id){
        $this->db->query('SELECT * FROM users WHERE id = :id');
        $this->db->bind(':id', $id);
        $row = $this->db->singleCount();
        
        // check row
       return $row;
    }
}
