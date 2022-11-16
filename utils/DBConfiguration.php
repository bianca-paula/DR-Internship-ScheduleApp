<?php
include_once "DBTables.php";
include_once "DBData.php";
include_once "./helpers/DBHelper.php";
class DBConfiguration
{
    protected $type;
    protected $server_name;
    protected $user_name;
    protected $password;
    protected $database_name;
    private $connection;
    protected $port;
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
            // we don't add the database_name to DSN if it is not created
            $conStr = "$this->type:host=$this->server_name;port=$this->port;charset=$this->charset"; // DSN - data source name

            $sql = DBHelper::createDatabase($this->database_name);
            $sql_check_db_exists = DBHelper::checkDatabase();
          
            //Create connection
            $this->connection = $this->create_connection($conStr, $this->user_name, $this->password, $options);
            $check_if_db = $this->execute($sql_check_db_exists, array('database_name' => $this->database_name));

            //if database name isn't given back by fetch create the database
            if (!isset($check_if_db->fetch()['SCHEMA_NAME'])) {
                $this->execute($sql);
            }
            $this->execute("use $this->database_name");
        } catch (PDOException $exception) {
            //on failure print message
            echo nl2br("Connection failed: " . $exception->getMessage() . "\n");
        }
    }

    private function create_connection($conStr, $user_name, $password, $options)
    {
        return new PDO($conStr, $user_name, $password, $options);
    }

    public function getConnection()
    {
        return $this->connection;
    }

    //return true if successfull 
    //and as response the query response for SELECT statement
    //return false if unsuccsessfull
    function execute(string $sql, $arguments = null)
    {
        try {
            if (!$arguments) {
                return $this->getConnection()->query($sql);
            }
            $statement = $this->getConnection()->prepare($sql);

            //execute statement with arguments
            $statement->execute($arguments);
            return $statement;
        } catch (InvalidArgumentException $exception) {
            error_log("Parameter was not passed. " . $exception->getMessage(), 0);
            return false;
        }
    }
}
