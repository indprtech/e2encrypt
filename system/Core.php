<?php
include(__DIR__ . "/Config.php");
include(__DIR__ . "/Request.php");
include(__DIR__ . "/Controller.php");
class Core {

    /* Config Loading (Important for Most Libraries) */
    public function loadConfig(){
        require_once(__DIR__ . "/Config.php");
        $config = new Config();
        return $config;
    }

    public function library($library,$parse0 = [],$parse1 = []){
        if($library == "db"){
            if($this->isNull($parse0) == false){
                if($this->isNull($parse1) == false){
                    require_once(__DIR__ . "/Database.php");
                    if($parse0 !== []){
                        $Database = new Database($parse0);
                    }else if($parse1 !== []){
                        $Database = new Database(true , $parse1);
                    }else{
                        if($parse0 !== []){
                            if($parse1 !== []){
                                $Database = new Database($parse0,$parse1);
                            }else{
                                $Database = new Database($parse0);
                            }
                        }else{
                            $Database = new Database();
                        }
                    }
                    
                    return $Database;
                }else{
                    $this->showError("Null Value Parsed on Core->library on [parse1]");
                }
            }else if($this->isNull($parse0) == false){
                if($this->isNull($parse1) == false){
                    require_once(__DIR__ . "/Request.php");
                    if($parse0 !== []){
                        $Request = new Request($parse0);
                    }else if($parse1 !== []){
                        $Request = new Request(true , $parse1);
                    }else{
                        if($parse0 !== []){
                            if($parse1 !== []){
                                $Request = new Request($parse0,$parse1);
                            }else{
                                $Request = new Request($parse0);
                            }
                        }else{
                            $Request = new Request();
                        }
                    }
                    
                    return $Database;
                }else{
                    $this->showError("Null Value Parsed on Core->library on [parse1]");
                }
            }else{
                $this->showError("Null Value Parsed on Core->library [parse0]");
            }
        }
    }

    // Null-Safety (Currently Disabled)
    public function isNull($value){
        // if($value == null){
        //     return true;
        // }else if($value == "null"){
        //     return true;
        // }else if($value == "undefined"){
        //     return true;
        // }else if($value == NAN){
        //     return true;
        // }else if($value == "NaN"){
        //     return true;
        // }else{
        //     return false;
        // }
        return false;
    }

    public function securityChecks(){
        $config = $this->loadConfig();
        if($config->same_domain == FALSE){
            if($config->domain !== $_SERVER['HTTP_HOST']){
                // Checks NOT OK!
                $this->showError("<h4>Security Issues</h4> <br/> The Domain is Mismatched");
            }else{
                if($config->requireSSL == TRUE){
                    if(empty($_SERVER['HTTPS'])) {
                        $this->showError("<h4>Security Issues</h4> <br/> SSL Error");
                        header("Location: https://" . $config->domain);
                    }
                }
            }
        }
    }

    public function initApp(){
        $request = $_SERVER['REQUEST_URI'];
        $request = strtok($request, '?');
        $request = str_replace('index.php', '', $request);
        $request = preg_replace('#/+#', '/', $request);
        $path_segments = explode('/', trim($request, '/'));
        //$request = "/";

        require_once __DIR__ . "/../src/Routes.php";
        
        foreach($path_segments as $row){
            //$request = "$request$row";
        }

        $Routes = new Routes();
        $isDone = FALSE;

        foreach($Routes->routes as $id => $r){
            if($id == $request){
                $isDone = TRUE;
                require_once __DIR__ . "/../src/Controllers/".$r['controller']."Controller.php";
                $kControl = $r['controller'];
                $kRoute = $r['route'];
                $appController = new $kControl();
                $appController->$kRoute();
            }
        }

        if($isDone == FALSE){
            $this->showError("<h4 align='center'>404</h4> <br/> $request - Does not Exists or is not mapped in Routes");
        }
    }

    public function showError($message){
        echo "<style>body{background: black ;color:white;} div{ padding:25px; margin:25px; border-radius:20px; border:2px solid red; }</style>";
        echo "<div>$message</div>";
        exit(-4);
    }
}