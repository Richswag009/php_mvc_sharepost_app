<?php
// require_once("Config/Config.php");

class Database{


    private $host = DB_HOST;
    private $user=  DB_USER;
    private $dbpwd= DB_PWD;
    private $dbname =DB_NAME;


    private $connection;
    private $errors;
    private $stmt;
    private $dbconnected = false;

    public function __construct()
    {
        // set PDO CONNECTION
        $dsn='mysql:host=' .$this->host . ';dbname='.$this->dbname;

        $options = array(
            PDO::ATTR_PERSISTENT=>true,
            PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION
        );

        //  create Pdo instance
        try{
           $this->connection = new PDO($dsn,$this->user, $this->dbpwd,$options);
           $this->dbconnected=true;
        }
        catch(PDOException $e){
            $this->errors = $e->getMessage().  "<br>";
            $this->dbconnected=false;
            echo $this->error;


            }
    }

    public function getError(){
        return $this->errors;
    }


    public function isConnected(){
        return $this->dbconnected;
    }

    // prepare statement with query
    public function query($query){
        $this->stmt= $this->connection->prepare($query);
    }
    //   execute the prepared statement
    public function execute(){
        return $this->stmt->execute();
    }

    // get resultset as Array of object
    public function resultSet(){
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    } 

    // get Record Row Count
    public function rowCount(){
        return $this->stmt->rowCount();
    }


    public function singleCount(){
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }
      
    // bind values
    public function bind($param, $value, $type=null){
        if (is_null($type)){
            switch(true){
                case is_int($value):
                    $type =PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type =PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type =PDO::PARAM_NULL;                                   
                    break;
                    
                    default;
                    $type =PDO::PARAM_STR;                                   
                   
            
            }
        }

        $this->stmt->bindValue($param,$value,$type);
    }
}

