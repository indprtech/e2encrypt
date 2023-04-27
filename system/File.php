<?php
class File extends Core{
    public $fileName;
    public $uploadPath;
    public $allowedFileTypes = [
        "jpg",
        "png",
        "jpeg",
        "gif"
    ];
    public $maxSize = 0;
    public $field = "file";

    public function setFileName(string $fileName){
        $this->fileName = $fileName;
    }

    public function setUploadPath(string $uploadPath){
        $this->uploadPath = $uploadPath;
    }

    public function setAllowedFileTypes(array $allowedFileTypes){
        $this->allowedFileTypes = $allowedFileTypes;
    }

    public function setMaxSize(int $maxSize){
        $this->maxSize = $maxSize;
    }

    public function setField(string $field){
        $this->field = $field;
    }

    public function upload(){
        $error = FALSE;
        $message = "";

        if($this->fileName == ""){
            $error = TRUE;
            $message = "fileName is not set!";
        }

        if($this->uploadPath == ""){
            $error = TRUE;
            $message = "uploadPath is not set!";
        }

        if($this->maxSize == 0){
            $error = TRUE;
            $message = "maxSize is not set!";
        }

        if($error == FALSE){
            $pathNew = $this->uploadPath;
            $target_dir = __DIR__ . "/../$pathNew/";
            $target_file = $target_dir . basename($_FILES[$this->field]["name"]);
            $new_file = $target_dir . basename($this->fileName);
            $FileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            if ($_FILES[$this->field]["size"] > $this->maxSize) {
                $error = TRUE;
                $message = "Max Upload Size Exceeded";
            }

            $error = TRUE;
            $message = "$type is not allowed!";
            foreach($this->allowedFileTypes as $type){
                if($FileType == $type){
                    $error = FALSE;
                    $message = "";
                }
            }

            if($error == FALSE){
                if (move_uploaded_file($_FILES[$this->field]["tmp_name"], $new_file)) {
                    return [
                        'STATUS' => TRUE,
                        'FILE_NAME' => $this->fileName,
                        'FILE_PATH' => $new_file
                    ];
                } else {
                    $error = FALSE;
                    $message = "Cannot upload file";
                }
            }else{
                return [
                    'STATUS' => FALSE,
                    'ERROR' => $error
                ];
            }

        }else if($error == TRUE){
            return [
                'STATUS' => FALSE,
                'ERROR' => $error
            ];
        }
    }

    public function debugFileInfo(){
        return [
            'fileName' => $this->fileName,
            'uploadPath' => $this->uploadPath,
            'allowedFileTypes' => $this->allowedFileTypes,
            'maxSize' => $this->maxSize,
            '__DIRNAME' => __DIR__
        ];
    }
}