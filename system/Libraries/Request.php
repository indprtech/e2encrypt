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
        }else if($type == "xml" || $type == "XML"){
            header("Content-type: text/xml");
            $this->xml_encode($data); 
        }
    }

    public function xml_encode($mixed, $domElement=null, $DOMDocument=null) {
        if (is_null($DOMDocument)) {
            $DOMDocument =new DOMDocument;
            $DOMDocument->formatOutput = true;
            $this->xml_encode($mixed, $DOMDocument, $DOMDocument);
            echo $DOMDocument->saveXML();
        }
        else {
            // To cope with embedded objects 
            if (is_object($mixed)) {
              $mixed = get_object_vars($mixed);
            }
            if (is_array($mixed)) {
                foreach ($mixed as $index => $mixedElement) {
                    if (is_int($index)) {
                        if ($index === 0) {
                            $node = $domElement;
                        }
                        else {
                            $node = $DOMDocument->createElement($domElement->tagName);
                            $domElement->parentNode->appendChild($node);
                        }
                    }
                    else {
                        $plural = $DOMDocument->createElement($index);
                        $domElement->appendChild($plural);
                        $node = $plural;
                        if ($index) {
                            $singular = $DOMDocument->createElement("value");
                            $plural->appendChild($singular);
                            $node = $singular;
                        }
                    }
    
                    $this->xml_encode($mixedElement, $node, $DOMDocument);
                }
            }
            else {
                $mixed = is_bool($mixed) ? ($mixed ? 'true' : 'false') : $mixed;
                $domElement->appendChild($DOMDocument->createTextNode($mixed));
            }
        }
    }
}