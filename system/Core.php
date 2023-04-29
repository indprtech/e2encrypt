<?php
include(__DIR__ . "/User/Config.php");
include(__DIR__ . "/Libraries/Request.php");
include(__DIR__ . "/Libraries/Controller.php");
class Core {

    /* Config Loading (Important for Most Libraries) */
    public function loadConfig(){
        require_once(__DIR__ . "/User/Config.php");
        $config = new Config();
        return $config;
    }

    public function library($library,$parse0 = [],$parse1 = []){
        if($library == "db"){
            if($this->isNull($parse0) == false){
                if($this->isNull($parse1) == false){
                    require_once(__DIR__ . "/Libraries/Database.php");
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
            }else{
                $this->showError("Null Value Parsed on Core->library [parse0]");
            }
        }

        if($library == "file"){
            if($this->isNull($parse0) == false){
                if($this->isNull($parse1) == false){
                    require_once(__DIR__ . "/Libraries/File.php");
                    if($parse0 !== []){
                        $File = new File($parse0);
                    }else if($parse1 !== []){
                        $File = new File(true , $parse1);
                    }else{
                        if($parse0 !== []){
                            if($parse1 !== []){
                                $File = new File($parse0,$parse1);
                            }else{
                                $File = new File($parse0);
                            }
                        }else{
                            $File = new File();
                        }
                    }
                    
                    return $File;
                }else{
                    $this->showError("Null Value Parsed on Core->library on [parse1]");
                }
            }else{
                $this->showError("Null Value Parsed on Core->library [parse0]");
            }
        }

        if($library == "sqlite3"){
            if($this->isNull($parse0) == false){
                if($this->isNull($parse1) == false){
                    require_once(__DIR__ . "/Libraries/Sqlite3.php");
                    if($parse0 !== []){
                        $Database = new Sqlite3Database($parse0);
                    }else if($parse1 !== []){
                        $Database = new Sqlite3Database(true , $parse1);
                    }else{
                        if($parse0 !== []){
                            if($parse1 !== []){
                                $Database = new Sqlite3Database($parse0,$parse1);
                            }else{
                                $Database = new Sqlite3Database($parse0);
                            }
                        }else{
                            $Database = new Sqlite3Database();
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