<?php
class Database{

    // specify your own database credentials
    private $host = "localhost";
    private $db_name = "apuesta2_SGE";
    private $username = "apuesta2_SGE";
    private $password = "SGEInnova2018";
    public $conn;

    //usuarioBD: proco389_admin
    //Clave BD: +,g&gE5eQtZM

    //Base de datos: apuesta2_SGE
    //Usuario: apuesta2_SGE
    //clave: SGEInnova2018

    // get the database connection
    public function getConnection(){

        $this->conn = null;

        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
?>
