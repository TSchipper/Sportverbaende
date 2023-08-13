<?php

//https://github.com/hungnttg/PHP/blob/master/DBController.php

class DBController
{
    //khai bao thong tin ket noi voi CSDL
    private $host = "localhost";
    private $user="root";
    //private $pass = "";
    public $masterDatabase = "mysql";
    public $appDatabase = "sportverbaende";

    //phuong thuc khoi tao
    public function __construct()
    {
        $this->conn = $this->connectDB();//khoi tao ket noi conn csdl
        if(!empty($this->conn)) {//neu da ton tai ket noi
            $this->selectDB();//chon database
        }

        $databaseExisting = false;
        $resultSet  = $this->runQuery("SHOW DATABASES");
        if ($resultSet != null) {
            foreach ($resultSet as $row) {
                if ($row['Database'] == $this->appDatabase) {
                    $databaseExisting = true;
                }
            }
            if (!$databaseExisting) {
                $sqlStatement = 'CREATE DATABASE '.$this->appDatabase;
                $this->execute($sqlStatement);

            }
        }
        mysqli_select_db($this->conn, $this->appDatabase);
    }

    public function executeSQLScript($filename)
    {
        $sqlCommand = file_get_contents($filename);
        $sqlCommand = str_replace("\t", " ", $sqlCommand);
        $sqlCommand = str_replace("\n", " ", $sqlCommand);
        $sqlCommand = str_replace("\r", " ", $sqlCommand);
        //$sqlCommand = str_replace(";;", ";", $sqlCommand);
        //$sqlCommand = str_replace(";;", ";", $sqlCommand);
        //$sqlCommand = str_replace(";;", ";", $sqlCommand);
        //$sqlCommand = str_replace(";;", ";", $sqlCommand);

        //$pdo = new PDO('mysql:host=localhost;dbname=test', 'username', 'password');;
        $connectionString = "mysql:host=".$this->host.";dbname=".$this->appDatabase;
        $pdo = new PDO($connectionString, $this->user, null);

        echo "<b><i>".$sqlCommand."</i></b>";
        $this->execute($sqlCommand);

        $statement = $pdo->prepare($sqlCommand);
        $result = $statement->execute();

        return ($result);
    }

    //ham ket noi CSDL
    public function connectDB()
    {
        $conn = mysqli_connect($this->host, $this->user, /*$this->pass*/ null, $this->masterDatabase);
        return $conn;
    }

    //ham chon DB
    public function selectDB()
    {
        mysqli_select_db($this->conn, $this->masterDatabase);
    }

    //ham chay cau lenh
    public function runQuery($query)
    {
        $result = mysqli_query($this->conn, $query);
        //doc ket qua bang vong lap
        while($row=mysqli_fetch_assoc($result)) {
            $restltset[] = $row;//chuyen thanh mang
        }
        if(!empty($restltset)) {
            return $restltset;
        }
    }

    //ham lay ve tong so dong
    public function numRows($query)
    {
        $result = mysqli_query($this->conn, $query);
        $rowcount = mysqli_num_rows($result);//lay ve tong so dong
        return $rowcount;
    }

    //ham them du lieu
    public function insert($query)
    {
        $insert_id="";
        $result = mysqli_query($this->conn, $query);
        if(!empty($result)) {
            $insert_id = mysqli_insert_id($this->conn);//gan id
        }
        return $insert_id;
    }

    //ham thuc thi cau lenh
    public function execute($query)
    {
        $result = mysqli_query($this->conn, $query);
        return $result;
    }
}
