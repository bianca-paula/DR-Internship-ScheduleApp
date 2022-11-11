<?php
class DbConfig
{
    protected $server_name;
    protected $user_name;
    protected $password;
    protected $database_name;
    protected $connection;

    function __construct()
    {
        $this->server_name = $_ENV['DB_SERVER_NAME'];
        $this->user_name = $_ENV['USER_NAME'];
        $this->password = $_ENV['PASSWORD'];
        $this->database_name = $_ENV['DATABASE_NAME'];
        try {
            $conString = "mysql:host=$this->server_name";
            $this->connection = $this->createConnection($conString, $this->user_name, $this->password);
            if (!$this->connection) {
                //sql statement to create DATABASE_NAME
                $sql = "CREATE DATABASE $this->database_name";
                $this->execute($sql);
                //sql statement for connection using execute() method
                $this->connection = $this->createConnection("$conString.database=$this->database_name", $this->user_name, $this->password);
            }
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Connection successfully established";
        } catch (PDOException $exception) {
            echo "Connection failed: " . $exception->getMessage();
        }
    }

    function createConnection($connection_string, $user_name, $password)
    {
        return new PDO($connection_string, $user_name, $password);
    }

    //return true if successfull 
    //and as response the query response for SELECT statement
    //return false if unsuccsessfull
    function execute($query)
    {
        $output = [];
        try {
            //exec(): PDO built in method for executing SQL queries
            $sql = $this->connection->exec($query, $output);
            if (!$sql) {
                return false;
            }
            return $sql;
        } catch (InvalidArgumentException $exception) {
            error_log("Parameter was not passed. " . $exception->getMessage(), 0);
            return false;
        }
    }
}
