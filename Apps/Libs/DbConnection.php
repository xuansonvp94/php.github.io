<?php

/**
 * Class Apps_Libs_DbConnection: connect to database
 */
class Apps_Libs_DbConnection {
    protected $username ='root';
    protected $password ='123456';
    protected $host ='localhost';
    protected $database ='practice';

    protected $tableName;
    protected static $connectionInstance =null;

    public function __construct() {
        $this->connect();
    }


    /**
     * function connect(): create connection to database
     * @return PDO|null
     */
    public function connect () {
        if (self::$connectionInstance === null) {
            try {
                self::$connectionInstance = new PDO("mysql:host=".$this->host.";dbname=".$this->database, $this->username, $this->password);
                self::$connectionInstance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            } catch (Exception $e) {
                echo "Connection Failed ".$e->getMessage();
                die();
            }
        }
        return self::$connectionInstance;
    }

    public function query($sql, $params = []) {
        $q = self::$connectionInstance->prepare($sql);
        if (is_array($params) && $params) {
            $q->execute($params);
        } else {
            $q->execute();
        }
        return $q;
    }
}
