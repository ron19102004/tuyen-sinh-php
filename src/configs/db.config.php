<?php
class DB {
    /**
     * @return PDO|null
     */
    public static function connect(){
        $meta_data = Env::get("database");
        $servername = $meta_data["host"];
        $username =  $meta_data["username"];
        $password =  $meta_data["password"];
        $dbname =  $meta_data["database_name"];
        $conn = null;
        try {
          $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
          // set the PDO error mode to exception
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
          echo "Connection failed: " . $e->getMessage();
        }
        return $conn;                                                                                                     
    }
}