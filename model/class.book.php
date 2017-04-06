<?php
/*
	This SQL query will create the table to store your object.

	CREATE TABLE `book` (
	`bookid` int(11) NOT NULL auto_increment,
	`title` VARCHAR(255) NOT NULL,
	`synapsis` VARCHAR(255) NOT NULL,
	`date` DATE NOT NULL, PRIMARY KEY  (`bookid`)) ENGINE=MyISAM;
*/

/**
* <b>book</b> class with integrated CRUD methods.
* @author Yannig Smagghe
* @version POG 3.2 / PHP5
* @copyright Free for personal & commercial use. (Offered under the BSD license)
* @link http://www.phpobjectgenerator.com/?language=php5&wrapper=pog&objectName=book&attributeList=array+%28%0A++0+%3D%3E+%27title%27%2C%0A++1+%3D%3E+%27synapsis%27%2C%0A++2+%3D%3E+%27date%27%2C%0A%29&typeList=array+%28%0A++0+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++1+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++2+%3D%3E+%27DATE%27%2C%0A%29
*/
include_once('class.pog_base.php');
class book extends POG_Base
{
	public $bookId = '';

	/**
	 * @var VARCHAR(255)
	 */
	public $title;
	
	/**
	 * @var VARCHAR(255)
	 */
	public $synapsis;
	
	/**
	 * @var DATE
	 */
	public $date;
	
	public $pog_attribute_type = array(
		"bookId" => array('db_attributes' => array("NUMERIC", "INT")),
		"title" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"synapsis" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"date" => array('db_attributes' => array("NUMERIC", "DATE")),
		);
	public $pog_query;
	
	
	/**
	* Getter for some private attributes
	* @return mixed $attribute
	*/
	public function __get($attribute)
	{
		if (isset($this->{"_".$attribute}))
		{
			return $this->{"_".$attribute};
		}
		else
		{
			return false;
		}
	}
	
	function book($title='', $synapsis='', $date='')
	{
		$this->title = $title;
		$this->synapsis = $synapsis;
		$this->date = $date;
	}
	
	
	/**
	* Gets object from database
	* @param integer $bookId 
	* @return object $book
	*/
	function Get($bookId)
	{
		$connection = Database::Connect();
		$this->pog_query = "select * from `book` where `bookid`='".intval($bookId)."' LIMIT 1";
		$cursor = Database::Reader($this->pog_query, $connection);
		while ($row = Database::Read($cursor))
		{
			$this->bookId = $row['bookid'];
			$this->title = $this->Unescape($row['title']);
			$this->synapsis = $this->Unescape($row['synapsis']);
			$this->date = $row['date'];
		}
		return $this;
	}
	
	
	/**
	* Returns a sorted array of objects that match given conditions
	* @param multidimensional array {("field", "comparator", "value"), ("field", "comparator", "value"), ...} 
	* @param string $sortBy 
	* @param boolean $ascending 
	* @param int limit 
	* @return array $bookList
	*/
	function GetList($fcv_array = array(), $sortBy='', $ascending=true, $limit='')
	{
		$connection = Database::Connect();
		$sqlLimit = ($limit != '' ? "LIMIT $limit" : '');
		$this->pog_query = "select * from `book` ";
		$bookList = Array();
		if (sizeof($fcv_array) > 0)
		{
			$this->pog_query .= " where ";
			for ($i=0, $c=sizeof($fcv_array); $i<$c; $i++)
			{
				if (sizeof($fcv_array[$i]) == 1)
				{
					$this->pog_query .= " ".$fcv_array[$i][0]." ";
					continue;
				}
				else
				{
					if ($i > 0 && sizeof($fcv_array[$i-1]) != 1)
					{
						$this->pog_query .= " AND ";
					}
					if (isset($this->pog_attribute_type[$fcv_array[$i][0]]['db_attributes']) && $this->pog_attribute_type[$fcv_array[$i][0]]['db_attributes'][0] != 'NUMERIC' && $this->pog_attribute_type[$fcv_array[$i][0]]['db_attributes'][0] != 'SET')
					{
						if ($GLOBALS['configuration']['db_encoding'] == 1)
						{
							$value = POG_Base::IsColumn($fcv_array[$i][2]) ? "BASE64_DECODE(".$fcv_array[$i][2].")" : "'".$fcv_array[$i][2]."'";
							$this->pog_query .= "BASE64_DECODE(`".$fcv_array[$i][0]."`) ".$fcv_array[$i][1]." ".$value;
						}
						else
						{
							$value =  POG_Base::IsColumn($fcv_array[$i][2]) ? $fcv_array[$i][2] : "'".$this->Escape($fcv_array[$i][2])."'";
							$this->pog_query .= "`".$fcv_array[$i][0]."` ".$fcv_array[$i][1]." ".$value;
						}
					}
					else
					{
						$value = POG_Base::IsColumn($fcv_array[$i][2]) ? $fcv_array[$i][2] : "'".$fcv_array[$i][2]."'";
						$this->pog_query .= "`".$fcv_array[$i][0]."` ".$fcv_array[$i][1]." ".$value;
					}
				}
			}
		}
		if ($sortBy != '')
		{
			if (isset($this->pog_attribute_type[$sortBy]['db_attributes']) && $this->pog_attribute_type[$sortBy]['db_attributes'][0] != 'NUMERIC' && $this->pog_attribute_type[$sortBy]['db_attributes'][0] != 'SET')
			{
				if ($GLOBALS['configuration']['db_encoding'] == 1)
				{
					$sortBy = "BASE64_DECODE($sortBy) ";
				}
				else
				{
					$sortBy = "$sortBy ";
				}
			}
			else
			{
				$sortBy = "$sortBy ";
			}
		}
		else
		{
			$sortBy = "bookid";
		}
		$this->pog_query .= " order by ".$sortBy." ".($ascending ? "asc" : "desc")." $sqlLimit";
		$thisObjectName = get_class($this);
		$cursor = Database::Reader($this->pog_query, $connection);
		while ($row = Database::Read($cursor))
		{
			$book = new $thisObjectName();
			$book->bookId = $row['bookid'];
			$book->title = $this->Unescape($row['title']);
			$book->synapsis = $this->Unescape($row['synapsis']);
			$book->date = $row['date'];
			$bookList[] = $book;
		}
		return $bookList;
	}
	
	
	/**
	* Saves the object to the database
	* @return integer $bookId
	*/
	function Save()
	{
		$connection = Database::Connect();
		$rows = 0;
		if ($this->bookId!=''){
			$this->pog_query = "select `bookid` from `book` where `bookid`='".$this->bookId."' LIMIT 1";
			$rows = Database::Query($this->pog_query, $connection);
		}
		if ($rows > 0)
		{
			$this->pog_query = "update `book` set 
			`title`='".$this->Escape($this->title)."', 
			`synapsis`='".$this->Escape($this->synapsis)."', 
			`date`='".$this->date."' where `bookid`='".$this->bookId."'";
		}
		else
		{
			$this->pog_query = "insert into `book` (`title`, `synapsis`, `date` ) values (
			'".$this->Escape($this->title)."', 
			'".$this->Escape($this->synapsis)."', 
			'".$this->date."' )";
		}
		$insertId = Database::InsertOrUpdate($this->pog_query, $connection);
		if ($this->bookId == "")
		{
			$this->bookId = $insertId;
		}
		return $this->bookId;
	}
	
	
	/**
	* Clones the object and saves it to the database
	* @return integer $bookId
	*/
	function SaveNew()
	{
		$this->bookId = '';
		return $this->Save();
	}
	
	
	/**
	* Deletes the object from the database
	* @return boolean
	*/
	function Delete()
	{
		$connection = Database::Connect();
		$this->pog_query = "delete from `book` where `bookid`='".$this->bookId."'";
		return Database::NonQuery($this->pog_query, $connection);
	}
	
	
	/**
	* Deletes a list of objects that match given conditions
	* @param multidimensional array {("field", "comparator", "value"), ("field", "comparator", "value"), ...} 
	* @param bool $deep 
	* @return 
	*/
	function DeleteList($fcv_array)
	{
		if (sizeof($fcv_array) > 0)
		{
			$connection = Database::Connect();
			$pog_query = "delete from `book` where ";
			for ($i=0, $c=sizeof($fcv_array); $i<$c; $i++)
			{
				if (sizeof($fcv_array[$i]) == 1)
				{
					$pog_query .= " ".$fcv_array[$i][0]." ";
					continue;
				}
				else
				{
					if ($i > 0 && sizeof($fcv_array[$i-1]) !== 1)
					{
						$pog_query .= " AND ";
					}
					if (isset($this->pog_attribute_type[$fcv_array[$i][0]]['db_attributes']) && $this->pog_attribute_type[$fcv_array[$i][0]]['db_attributes'][0] != 'NUMERIC' && $this->pog_attribute_type[$fcv_array[$i][0]]['db_attributes'][0] != 'SET')
					{
						$pog_query .= "`".$fcv_array[$i][0]."` ".$fcv_array[$i][1]." '".$this->Escape($fcv_array[$i][2])."'";
					}
					else
					{
						$pog_query .= "`".$fcv_array[$i][0]."` ".$fcv_array[$i][1]." '".$fcv_array[$i][2]."'";
					}
				}
			}
			return Database::NonQuery($pog_query, $connection);
		}
	}
}
?>