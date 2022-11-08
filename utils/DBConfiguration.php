<?php
include_once "DBTables.php";
include_once "DBData.php";
class DbConfiguration
{
    protected $type;
    protected $server_name;
    protected $user_name;
    protected $password;
    protected $database_name;
    public $connection; 
    protected $port;
    protected $charset;

    function __construct()
    {
        $this->type = 'mysql';
        $this->server_name = 'localhost';
        $this->user_name = 'root';
        $this->password = '';
        $this->database_name = 'schedule_app';
        $this->port = '3306'; // XAMPP MySql port
        $this->charset = 'utf8mb4'; // UTF-8 encoding using 4 bytes of data per character
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false
        ];
        
        try {
            // we don't add the database_name to DSN if it is not created
            $dsn = "$this->type:host=$this->server_name;port=$this->port;charset=$this->charset"; // DSN - data source name
            $sql = "CREATE DATABASE $this->database_name";
            $sql_check_db_exists = "SELECT SCHEMA_NAME
            FROM INFORMATION_SCHEMA.SCHEMATA
            WHERE SCHEMA_NAME = '$this->database_name';";
            $this->connection = $this->create_connection($dsn, $this->user_name, $this->password, $options);
            $check_if_db = $this->connection->query($sql_check_db_exists);
            if(!isset($check_if_db->fetch()['SCHEMA_NAME'])){
                $this->connection->query($sql);
            }   
            $this->execute("use $this->database_name");         
            echo nl2br("Connection successfully established \n");
        } 
        catch (PDOException $exception) {
            echo nl2br("Connection failed: " . $exception->getMessage() . "\n");
        }
    }

    function create_connection($connection_string, $user_name, $password, $options)
    {
        return new PDO($connection_string, $user_name, $password, $options);
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
        } catch (InvalidArgumentException $exception) {
            error_log("Parameter was not passed. " . $exception->getMessage(), 0);
            return false;
        }
    }
}
?>