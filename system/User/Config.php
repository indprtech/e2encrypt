<?php
class Config {
    //Domain
    public $domain = "localhost:8001";
    public $base_url = "http://localhost:8000";
    public $requireSSL = FALSE;
    public $same_domain = FALSE;

    //Database
    public $database = array(
        'host' => 'localhost',
        'user' => 'root',
        'pass' => '168068125602980032440886.28572',
        'dbase' => 'test'
    );

    public $sqlite_db = __DIR__ . "/../../file_tests/data.db";

    //Encryption
    public $encryption = true;
    // TODO: Change the Secret Key for Producional USE!
    public $secret_key = "1234@1345";
    //Secure Admin Access
    public $secure_admin_enabled = FALSE;
}