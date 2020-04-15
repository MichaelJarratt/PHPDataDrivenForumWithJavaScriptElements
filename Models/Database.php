<?php
class Database
{
    private $connection;
    static private $database;

    private function __construct()
    {
        try
        {
            $servername = "poseidon.salford.ac.uk";
            $username = "sye564";
            $password = "Gx3jUJK2DyEkHgL";
            $this->connection = new PDO("mysql:host=$servername;dbname=sye564_forum", $username, $password);
            // set the PDO error mode to exception
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //echo "Connected successfully";
        }
        catch (PDOException $e) //catch exception if it fails to connect
        {
            echo "DB connection failed ".$e->getMessage(); //returns error message
        }
    }

    /*
     * returns instance of database
     */
    public static function getInstance()
    {
        if(!isset(self::$database))
        {
            self::$database = new Database();
            return self::$database;
        }
        else
        {
            return self::$database;
        }
    }

    //testing method
    public function getEverything()
    {
        $statement = $this->connection->prepare("SELECT * FROM Users");
        //var_dump($statement);
        $statement->execute();
        //var_dump($statement);
        $result = $statement->setFetchMode(PDO::FETCH_ASSOC);
        //var_dump($result);
        var_dump($statement->fetchAll());

    }

    //executes any query meant to return a result and returns the raw output
    public function retrieve($query)
    {
        $statement = $this->connection->prepare($query);
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_ASSOC); //sets array to associative indexing
        $result = $statement->fetchAll();
        //var_dump($result);
        return $result;
    }

    //executes any update query on the database
    public function update($query)
    {
        $statement = $this->connection->prepare($query);
        $statement->execute();
    }
}