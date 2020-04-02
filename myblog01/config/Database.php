<?php 
/*------------------------------------------------------------------------------*/
  //
  class Database {
    // DB Params
    private $host = 'localhost';
    private $db_name = 'dbmyblog';
    private $username = 'aliben01';
    private $password = 'Security_39';
    private $conn;
    //private 
    public static $sconn;

    // DB Connect
    public function connect0() {
      $this->conn = null;

      try { 
        $this->conn = new PDO(  'mysql:host=' . $this->host . ';dbname=' . $this->db_name, 
                                $this->username, 
                                $this->password);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
        if(Config::$_DEBUG) echo 'Connection OK'. '<br>';
      } catch(PDOException $e) {
        echo 'Connection Error: ' . $e->getMessage() . '<br>';
      }

      return $this->conn;
    }


        // DB Connect
        public static function connect() {
          //self::sconn = null;
          self::$sconn = null;
          try { 
            self::$sconn = new PDO(  'mysql:host=' . $this->host . ';dbname=' . $this->db_name, 
                                    $this->username, 
                                    $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
            if(Config::$_DEBUG) echo 'Connection OK'. '<br>';
          } catch(PDOException $e) {
            echo 'Connection Error: ' . $e->getMessage() . '<br>';
          }
    
          return $this->conn;
        }
    
// Get categories :Create query > Prepare statement > Execute query
public static function doPrepExecGetStms($conn, $query)
{
  $stmt = $conn->prepare($query); 
  $stmt->execute();
  return $stmt;
}
}
/*------------------------------------------------------------------------------*/
  //Test DB connection
  function Database_main(){
    $db =  new Database();
    $db->connect();
  }

  //main
  //Database_main();
?>