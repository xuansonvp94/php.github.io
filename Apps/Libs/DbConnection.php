<?php

/**
 * Class Apps_Libs_DbConnection: connect to database
 */
class Apps_Libs_DbConnection {
    protected $username ='root';
    protected $password ='123456';
    protected $host ='localhost';
    protected $database ='practice';
    protected $queryParams = [];

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

    /**
     * function query: thuc thi cau truy van execute()
     *
     */
    public function query($sql, $params = []) {
        $q = self::$connectionInstance->prepare($sql);
        if (is_array($params) && $params) {
            $q->execute($params);
        } else {
            $q->execute();
        }
        return $q;
    }

    /**
     * gop cac params truyen vao trong $queryParams, toi uu cach lam
     * @return $this
     */
    public function buildQueryParams($params) {
        $default = [
            "select" => "",
            "where" => "",
            "other" => "",
            "params" => ""
        ];
        $this->queryParams = array_merge($default, $params);
        return $this;

    }

    /*
     * function buildCondition: xu ly dieu kien where, neu params truyen vao co where thi trong cau sql moi them "where"
     * trim(): cat khoang trang o dau cuoi
     */
    public function buildCondition($condition) {
        if (trim($condition)) {
            return "where ".$condition;
        }
        return "";
    }

    public function select() {
        $sql = "select ".$this->queryParams["select"]." from ".$this->tableName." ".
            $this->buildCondition($this->queryParams["where"])." ".$this->queryParams["other"];
        $query = $this->query($sql,$this->queryParams["params"]);
        return $query->setFetchMode(PDO::FETCH_ASSOC);
    }

    public function selectOne () {

    }

    public function insert () {

    }

    public function update() {

    }

    public function delete () {

    }
}
