<?php

/* ------------------------------------------------------------------------------ */
//
class Database
{
    // DB Params
    public static $host = 'localhost';
    public static $db_name = 'dbmyblog';
    public static $username = 'aliben01';
    public static $password = 'Security_39';
    public static $conn;

    // DB Connect
    public static function connect()
    {
        //self::$conn = null;
        try {
            self::$conn = new PDO('mysql:host=' . self::$host . ';dbname=' . self::$db_name,
                                   self::$username, 
                                   self::$password);
            self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            //if (Config::$_DEBUG) echo 'Connection OK' . '<br>';
            return "OK";
        } catch (PDOException $e) {
            //echo 'Connection Error: ' . $e->getMessage() . '<br>';
            return 'Exception.Message: ' . $e->getMessage();
        }        //return self::$conn;
    }

    // Get categories :Create query > Prepare statement > Execute query
    public static function doPrepExecGetStms($query)
    {
        $stmt = self::$conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    
    //
    public static function doPrepExecGetStmsWithParams($query, $pParams)
    {
        // Create query >  //Prepare statement >     // Bind ID >     // Execute query
        $stmt = self::$conn->prepare($query);
        foreach(array_keys($pParams) as $key) $stmt->bindParam(':'.$key, $pParams[$key]);
        $stmt->execute();
        return $stmt;
    }
    
}

/* ------------------------------------------------------------------------------ */
// Test DB connection
function Database_main()
{
    //$db = new Database();    //$db->connect();
    Database::connect();
}

// main
Database_main();
?>