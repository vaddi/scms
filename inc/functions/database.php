<?php

class database
{
  private $connection = NULL;
  private $result = NULL;
  private $counter = NULL;
  
  // Connect DB
  public function __construct($host, $user, $pass, $database) {
	$this->connection = mysql_connect($host, $user, $pass);
  	mysql_select_db($database, $this->connection);
  }
  
  // Disconnect DB
  public function disconnect() {
    if (is_resource($this->connection))				
        mysql_close($this->connection);
  }
 
  // Query
  public function query($query) {
  	$this->result = mysql_query($query,$this->connection);
  	$this->counter = NULL;
  }
  
  public function subquery($query) {
    if (($this->result = mysql_query($query,$this->connection)) == NULL)
    {
        $this->result = NULL;
        return NULL;
    } else if (($this->result = mysql_query($query,$this->connection)) == '')
    {
        $this->result = '';
        return '1';
    }
  	
  	
  }
  
  // Objekt als Reihe, Tupel
  public function fetchRow() {
  	return mysql_fetch_assoc($this->result);
  }
  
  // Array 
  public function fetchArr() {
  	return mysql_fetch_array($this->result);
  }
  
  // Objekt  
  public function fetchObj() {
  	return mysql_fetch_object($this->result);
  }
  
  // Anzahl Spalten (Attribute, Felder)
  public function mysql_num_fields() {
  	return mysql_num_fields($this->result);
  }
  
  // Ueberschriften, Attribute auslesen
  public function mysql_field_name($count) {
  	return mysql_field_name($this->result, $count);
  }
  
  // Anzahl der Reihen (Tupel)
  public function count() {
  	if($this->counter == NULL && is_resource($this->result)) {
  		$this->counter = mysql_num_rows($this->result);
  	}
 
	return $this->counter;
  }
}

?>
