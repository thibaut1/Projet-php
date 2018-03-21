<?php

class Database {

    private $_host;
    private $_username;
    private $_password;
    private $_database;
    private $_connexionDb;

    public function __construct($host, $user, $pwd, $database) {

        $this->_host = $host;
        $this->_username = $user;
        $this->_password = $pwd;
        $this->_database = $database;

        try {
            $this->_connexionDb = new PDO('mysql:host=' . $this->_host . ';dbname=' . $this->_database . ';charset=utf8', $this->_username, $this->_password, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8',
                PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
        } catch (PDOException $ex) {
            die('<h1>Imposible de se connecter a la Base de donnees<h1>');
        }
    }

    public function requeteSelect($sql) {
        try {
            $req = $this->_connexionDb->prepare($sql);
            $req->execute();
            return $req->fetchALL(PDO::FETCH_ASSOC);
            //pour voir le résultat d'une requete, l'afficher dans un var_dump()
        } catch (PDOException $ex) {
            die("Erreur SQL");
        }
    }

    public function requeteInsert($sql) {
        try {
            $req = $this->_connexionDb->prepare($sql);
            $req->execute();
        } catch (PDOException $ex) {
            die("Erreur SQL");
        }
    }

}
