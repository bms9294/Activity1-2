<?php
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
class MySqlClient {
	//Local storage of the Mysql config.
	private $conf;
	
	//Store the connection for multiple queries.
	private $conn;

	//store the statement for this use and future uses, until changed
	private $stmt;
	
	//array of queries to select from. Should be loaded when using the class.
	// EX. $mysqlclient = MySqlClient::withArray($querylist);
	private $array;

	//Examples of a query array. These arrays can (and probably should) be in
	// other files, like what was done for the config.
	private $query = array(
		'createATable' => 'CREATE TABLE IF NOT EXISTS test(yes INT, no VARCHAR(56))',
		'getAllFromTable' => 'SELECT * FROM test',
		'getFromTableWhere' => 'SELECT * FROM test WHERE yes=?'
	);
	
	// Class constructor. Get the config and store it for later use.
	function __construct($with=false){
		if($with != false){
			$this->withArray($with);
		}
		$this->conf = include("config.php"); //Get the config.php returned array.
		$db = ($this->conf)['db_name'];
		($this->query)['createDB'] = "CREATE DATABASE IF NOT EXISTS {$db}";
	}

	//Load a query array when the class is created.
	public function withArray($arra){
		if(is_array($arra)){
			$this->array = $arra;
		}else 
		if(is_string($arra)){
			$this->array = include("{$arra}");
		}
		//foreach($this->array as $k => $v){
		//	echo "Key: {$k}, Val: {$v}<br />";
		//}

	}
	//Example of gettting one of the config values.
	// Returns the host that the class should connect to.
	public function getValue($value){
		return ($this->conf)["{$value}"];
	}
	
	//Create the database if it doesn't exist.
	public function createDB(){
		$this->stmt = $this->conn->prepare($this->query['createDB']);
		$this->stmt->execute();
	}

	//Prepare and store the query for execution.
	public function prepare($query){
	//echo "Try {$query}"."<br />";
		if(isset($this->array) && array_key_exists($query,$this->array)){
			//echo ($this->array)[$query];
			$this->stmt = $this->conn->prepare(($this->array)[$query]);
			
		}else{
			$this->stmt = $this->conn->prepare($query);
			//echo $query;
		}
		
	}

	//Execute the query after being prepared and return the result.
	public function exec($array=false){
	if($array == false)$array = Array();
		if($this->stmt->execute($array)){
			return $this->stmt;
		}else{
			return false;
		}
	}

	//Will query mysql with an already prepared statement and return the rows in
	// the Array() format.
	public function getRows($array){
		if($this->stmt->execute($array)){
			return var_export($this->stmt);
		}else{
			return false;
		}
	}
	//
	// Uses the values from /core/mysql/config.php to connect to the Videos4u database
	// 
	function connect($dbname=false){
		$host = ($this->conf)['host'];
		$db = ($this->conf)['db_name'];
		$charset = ($this->conf)['charset'];
		$user = ($this->conf)['username'];
		$pass = ($this->conf)['password'];
		$dsn = "mysql:host={$host};port=3306";
		
		if($dbname === false){
			$dsn .= ";dbname={$db};";
		}else{
			$dsn .= ";dbname={$dbname};";
		}
		
		//echo "dsn= {$dsn}<br />";
		$options = [
			PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
			PDO::ATTR_EMULATE_PREPARES   => false,
		];
		try {
			$this->conn = new PDO($dsn, $user, $pass, $options);
			return $this->conn; //Connection successful.
		} catch (\PDOException $e) {
			 throw new \PDOException($e->getMessage(), (int)$e->getCode());
			 //You should check to see what went wrong.
		}
	}
}

