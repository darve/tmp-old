<?php


if (!class_exists('DB'))
{
class DB {

	var $table;
	var $idfield;
	var $props;
	var $required;
	var $formsubmit;
	var $extraerror;


	var $debug = false;

	function DB()
	{
	}

	//standard database functions
	/////////////////////////////////////////////////////
	function connect()
	{




			$dbUser = "tmpunder_ioox";
			$dbPass = "hd74n47TMP";
			$dbName = "tmpunder_ioox";
			$dbHost = "10.169.0.90";


			$db = mysql_connect($dbHost, $dbUser, $dbPass) or die("Unable to connect to Database - Please try again". mysql_error() .", mysql_errno=". mysql_errno());

			mysql_select_db($dbName, $db) or die('Error opening database');

			mysql_query("SET NAMES utf8");

			return $db;

	}



	function disconnect($db)
	{
		mysql_close($db);
	}

	function execute($sql, $database)
	{
		$db = $this->connect($database);
		if ($this->debug == true)
		{
			echo ($sql);
			echo ("<br>");
		}
		mysql_query("SET NAMES utf8");

		$result=mysql_query($sql);

		$this->disconnect($db);

		return $result;
	}

	//property values functions
	////////////////////////////////////////////////
	function setvalue($field, $value)
	{
		$this->props[$field] = $value;
	}

	function getvalue($field)
	{
		return $this->props[$field];
	}

	//save item into database
	///////////////////////////////////////////////
	function save($destructive = true)
	{



		if ($this->props[$this->idfield] == "")
		{

			$this->insert();
		}
		else
		{

			$this->update($destructive);
		}
			return true;
	}

	//update an existing item in the database
	////////////////////////////////////////////////
	function update($destructive = false)
	{

		$values = "";

		foreach ($this->props as $field => $value)
		{
			if ($value != "" || $destructive==true)
			{
				if ($values != "")
				{
					$values .= ", ";
				}
				if ($field != $this->idfield)
				{
					$values .= $field." = "."'".mysql_escape_string($value)."'";
				}
			}
		}

		$sql = "UPDATE ".$this->table." SET ".$values." WHERE ".$this->idfield." = ".$this->props[$this->idfield];


		$this->execute($sql);
	}

	//insert new item into database
	/////////////////////////////////////////////////
	function insert()
	{
		$fieldlist = "";
		$valuelist = "";

		foreach ($this->props as $field => $value)
		{
			if ($value != "")
			{
				if ($fieldlist != "")
				{
					$fieldlist .= ", ";
					$valuelist .= ", ";
				}

				if ($field != $this->idfield)
				{
					$fieldlist .= $field;
					$valuelist .= "'".mysql_escape_string($value)."'";
				}
			}
		}

		$sql = "INSERT INTO ".$this->table." (".$fieldlist.") VALUES (".$valuelist.")";


		$this->execute($sql, false);
		$this->props[$this->idfield] = mysql_insert_id();

		return $this->props[$this->idfield];
		$this->disconnect($db);


	}

	//delete item from the database
	////////////////////////////////////////////
	function delete()
	{
		$sql = "DELETE FROM ".$this->table." WHERE ".$this->idfield." = ".$this->props[$this->idfield];
		$this->execute($sql);
	}

	//delete item from the database
	////////////////////////////////////////////
	function deletefromget()
	{
		$sql = "DELETE FROM ".$this->table." WHERE ".$this->idfield." = ".$_GET['delete'];

		$this->execute($sql);
	}


	//populate the object with the details from the database
	/////////////////////////////////////////////
	function get()
	{
		$sql = "SELECT * FROM ".$this->table." WHERE ".$this->idfield." = '".$this->props[$this->idfield]."'";

		$result = $this->execute($sql);

		if ($result = mysql_fetch_array($result))
		{
			foreach ($result as $field => $value)
			{
				if (array_key_exists($field, $this->props))
				{
					$this->props[$field] = stripslashes($value);
				}
			}
			return true;
		}
		else
		{
			return false;
		}
	}

	//populate the object with the details from the database
	/////////////////////////////////////////////
	function getSingle($orderby="")
	{

	if($orderby=="")
	{
		$orderby=$this->idfield." DESC";
	}
		$sql = "SELECT * FROM ".$this->table." ";

		foreach($this->props as $field=>$value)
		{
			if ($value != "")
			{
				if ($where != "")
				{
					$where .= " AND ";
				}
				else
				{
					$where .= " WHERE ";
				}
				$where .= $field." = '".addslashes($value)."'";
			}
		}

		$sql = $sql.$where."ORDER BY ".$orderby." LIMIT 1 ";
					$result = $this->execute($sql,$this->database);

		if ($result = mysql_fetch_array($result))
		{
			foreach ($result as $field => $value)
			{
				if (array_key_exists($field, $this->props))
				{
					$this->props[$field] = $value;
				}
			}
			return true;
		}
		else
		{
			return false;
		}
	}

	//get a mysql dataset from the database that matches the values stored in the current object
	//////////////////////////////////////////////
	function getlist($start = null, $amount = null, $orderby = null, $notempty = null)
	{
		$sql = "SELECT * FROM ".$this->table;

		$where = "";

		foreach($this->props as $field=>$value)
		{
			if ($value != "")
			{
				if ($where != "")
				{
					$where .= " AND ";
				}
				else
				{
					$where .= " WHERE ";
				}
				$where .= $field." = '".addslashes($value)."' ";
			}
		}

		if($notempty!=''){
			if ($where != "")
				{
					$where .= " AND ";
				}
				else
				{
					$where .= " WHERE ";
				}
			$where .= $notempty." != '' ";

		}

		$limit = "";

		if ($start != null && $amount != null)
		{
			$limit .= " LIMIT ".$start.", ".$amount;
		}

		if ($orderby == null)
		{
			$sql .= $where." ORDER BY ".$this->idfield." ".$limit;
		}
		else
		{
			$sql .= $where." ORDER BY ".$orderby." ".$limit;
		}



		return $this->execute($sql);
	}


	//get a mysql dataset from the database that matches the values stored in the current object
	//////////////////////////////////////////////
	function getlistfromsearch($start = null, $amount = null, $orderby = null)
	{
		$sql = "SELECT * FROM ".$this->table;

		$where = "";

		foreach($this->props as $field=>$value)
		{
			if ($value != "")
			{
				if ($where != "")
				{
					$where .= " AND ";
				}
				else
				{
					$where .= " WHERE ";
				}
				$where .= $field." = '".addslashes($value)."'";
			}
		}


		if($_POST['search']!='')
		{
			$searchterm = $_POST['search'];
			foreach($this->searchterms as $value)
			{

				if ($where != "")
				{
					$where .= " OR ";
				}
				else
				{
					$where .= " WHERE (";
				}
				$where .= $value." LIKE '%".addslashes($searchterm)."%'";

			}
		}
		$where .= ")";
		$limit = "";

		if ($start != null && $amount != null)
		{
			$limit .= " LIMIT ".$start.", ".$amount;
		}

		if ($orderby == null)
		{
			$sql .= $where." ORDER BY ".$this->idfield." ".$limit;
		}
		else
		{
			$sql .= $where." ORDER BY ".$orderby." ".$limit;
		}


		return $this->execute($sql);
	}

	function countlist ()
	{
		$sql = "SELECT * FROM ".$this->table;

		$where = "";

		foreach($this->props as $field=>$value)
		{
			if ($value != "")
			{
				if ($where != "")
				{
					$where .= " AND ";
				}
				else
				{
					$where .= " WHERE ";
				}
				$where .= $field." = '".addslashes($value)."'";
			}
		}

		$sql .= $where;

		$result =  $this->execute($sql);

		return mysql_num_rows($result);
	}



	//get all relevent fields from $_POST
	////////////////////////////////////////////////////
	function getfrompost($pre = "")
	{


		foreach ($this->props as $field => $value)
		{


			if (array_key_exists($pre.$field, $_POST))
			{
				$this->props[$field] = $_POST[$pre.$field];


			}
			else if (array_key_exists ($field, $_FILES))
			{
				$this->props[$field] = $_FILES[$field]['name'];
			}
		}
	}

	//retrieve an item for a $_GET id
	/////////////////////////////////////////////////////
	function getfromid()
	{
		if (array_key_exists($this->idfield, $_GET))
		{
			$this->props[$this->idfield] = $_GET[$this->idfield];
			$this->get();
			return true;
		}
		else
		{
			return false;
		}
	}

	//check to see if the object has values for each required field
	/////////////////////////////////////////////////////
	function isvalid()
	{
		foreach ($this->required as $req)
		{




			if (empty($this->props[$req]))
			{

				return false;
			}
		}
		return true;
	}

	//returns the current state of the form page
	////////////////////////////////////////////////////
	function processform($pre = "")
	{


		$formstate = "empty";

		if (empty($_POST))
		{
			if($this->getfromid())
			{
				if ($this->debug)
				{
					echo ("item loaded from id<br>");
				}
				$formstate = "edit";
			}
		}
		else
		{

			$this->getfrompost($pre);

			if (isset($_POST[$this->formsubmit]))
			{

				if ($this->isvalid())
				{

					if($this->save(true))
					{
						if ($this->debug)
						{
							echo ("item saved<br>");
						}
						$formstate = "saved";
					}
					else
					{
						if ($this->debug)
						{
							echo ("Form was valid, but save failed<br>");
						}
						$formstate = "invalid";
					}
				}
				else
				{
					if ($this->debug)
					{
						echo ("item is not valid<br>");
					}
					$formstate = "invalid";
				}
			}
		}

		return $formstate;

	}

	//draw a dropdown list to the page from the object's database
	////////////////////////////////////////////////////
	function dropdown($name, $field, $value)
	{
		$result = $this->getlist(null, null);

		$dd = "<select name='".$name."'>";
		while($row = @mysql_fetch_array($result)) {
			$dd .= "<option";
			$dd .= " value='".$row[$this->idfield]."'";
			if ($row[$this->idfield] == $value) {
				$dd .= " selected";
			}
		$dd .= ">".stripslashes($row[$field])."</option>";
		}
		$dd .="</select>";

		echo ($dd);
	}

	//draw a radiogroup to the page from the object's database
	///////////////////////////////////////////////////
	function radiogroup($name, $field, $value)
	{
		$result = $this->getlist(null, null);

		$rg = "<table cellpadding=0 cellspacing=0 border=0>";

		while($row = @mysql_fetch_array($result)) {
			$rg .= "<tr><td>";
			$rg .= stripslashes($row[$field]);
			$rg .= "</td><td>";
			$rg .= "<input type='radio'";
			$rg .= " name='".$name."'";
			$rg .= " value='".$row[$this->idfield]."'";
			if ($row[$this->idfield] == $value) {
				$rg .= " checked";
			}
			$rg .= "></td></tr>\n";
		}
		$rg .="</table>";
		echo ($rg);
	}


	function paginate($url,$total,$page,$perpage)
	{

		if(ceil(($total/$perpage))<10){
			$maxpages = ceil($total/$perpage);
			//echo $maxpages;
		}else{
			$maxpages = 10;
		}
		//$maxpages = 10;
		echo "<div class='pagination'> Pages ";

		for($i=1; $i<=$maxpages; $i++){
			echo "<a href='".$url."?start=".(($i*$perpage)-$perpage)."' ";
			if($page==(($i*$perpage)-$perpage)){
				echo " class='selected'  ";
			}
			echo " id='".(($i*$perpage)-$perpage)."' >".$i."</a>";
		}

		echo "</div>";
	}

}
}

?>
