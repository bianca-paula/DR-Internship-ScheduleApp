<?php
class DbConfig
{
    protected $serverName;
    protected $userName;
    protected $password;
    protected $databaseName;
    protected $connection;

    function DbConfig($serverName, $userName, $password, $databaseName)
    {
        $this->serverName = $serverName;
        $this->userName = $userName;
        $this->password = $password;
        $this->databaseName = $databaseName;

        try{
            $this->connection = new PDO("mysql:host=$serverName;databaseName=$databaseName;userName=$userName;password=$password",$userName,$password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Connection successfully established";
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
}
?>