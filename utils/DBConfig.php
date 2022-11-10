<?php

class DBConfig
{
    protected $server_name;
    protected $user_name;
    protected $password;
    protected $database_name;
    protected $connection;
    protected $charset;

    function __construct()
    {
        $this->type = $_ENV['DATABASE_TYPE'];
        $this->server_name = $_ENV['DB_SERVER_NAME'];
        $this->user_name = $_ENV['USER_NAME'];
        $this->password = $_ENV['PASSWORD'];
        $this->database_name = $_ENV['DATABASE_NAME'];
        $this->port = $_ENV['CONNECTION_PORT'];
        $this->charset = 'utf8mb4';


        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false
        ];

        try {
            $conString = "$this->type:host=$this->server_name;
            port=$this->port;$this->charset;
            charset=$this->charset";

            //sql statement to create DATABASE_NAME
            $sql = "CREATE DATABASE $this->database_name";

            $sql_check_db_exists = "SELECT SCHEMA_NAME
            FROM INFORMATION_SCHEMA.SCHEMATA
            WHERE SCHEMA_NAME ='$this->database_name';";

            //Create connection
            // var_dump($conString);
            // die();
            $this->connection = $this->createConnection($conString, $this->user_name, $this->password, $options);
            $check_db_existence = $this->connection->query($sql_check_db_exists);

            //if database name isn't given back by fetch create the database
            if (!isset($check_db_existence->fetch()['SCHEMA_NAME'])) {
                $this->getConnection()->query($sql);
            }
            //sql syntax to use the specified database
            $this->execute("use $this->database_name");

            // echo "Connection successfully established";
        } catch (PDOException $e) {
            //on failure print message
            echo "Connection failed: " . $e->getMessage();
        }
    }

    function createConnection($connection_string, $user_name, $password, $options)
    {
        return new PDO($connection_string, $user_name, $password, $options);
    }

    public function getConnection()
    {
        return $this->connection;
    }

    //return true if successfull 
    //and as response the query response for SELECT statement
    //return false if unsuccsessfull
    function execute($query)
    {
        try {
            //exec(): PDO built in method for executing SQL queries
            $sql = $this->connection->exec($query);
            if (!$sql) {
                return false;
            }
            return $sql;
        } catch (InvalidArgumentException $e) {
            error_log("Parameter was not passed. " . $e->getMessage(), 0);
            return false;
        }
    }
}
