<?php
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
class Biscuit extends Core{
    public function set($name,$value){
        $jwt = JWT::encode([
            'value' => $value,
            'ipa' => $this->get_client_ip()
        ], $this->loadConfig()->secret_key, 'HS256');
        setcookie(
            $name,
            $jwt,
            time() + (10 * 365 * 24 * 60 * 60)
        );
        return TRUE;
    }

    public function get($name){
        try{
            if(isset($_COOKIE[$name])){
                $decoded = (array)JWT::decode($_COOKIE[$name], new Key($this->loadConfig()->secret_key, 'HS256'));
                if($decoded['ipa'] == $this->get_client_ip()){
                    return $decoded['value'];
                }else{
                    $this->del($name);
                    return "NULL";
                }
            }else{
                return "NULL";
            }
        }catch(Exception $e){
            $this->del($name);
            return "NULL";
        }
    }

    public function del($name){
        setcookie($name, "", time() - (10 * 365 * 24 * 60 * 60));
    }
}