<?php
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class Request extends Core{
    public $isEncryptionEnabled = false;
    function __construct(){
        $this->isEncryptionEnabled = $this->loadConfig()->encryption;
    }

    public function get($query = ""){
        if($this->isEncryptionEnabled == TRUE){
            if(isset($_GET[md5($query)])){
                return $_GET[md5($query)];
            }else{
                return null;
            }
        }else{
            if(isset($_GET[$query])){
                return $_GET[$query];
            }else{
                return null;
            }
        }
    }

    public function post($query = ""){
        if($this->isEncryptionEnabled == TRUE){
            if(isset($_POST[md5($query)])){
                return $_POST[md5($query)];
            }else{
                return null;
            }
        }else{
            if(isset($_POST[$query])){
                return $_POST[$query];
            }else{
                return null;
            }
        }
    }

    public function Response($type , $data){
        if($type == "json" || $type == "JSON"){
            header("Content-type: application/json");
            if($this->isEncryptionEnabled == FALSE){
                return json_encode($data);
            }else{
                $jwt = JWT::encode($data, $this->loadConfig()->secret_key, 'HS256');
                return $jwt;
            }
        }
    }
}