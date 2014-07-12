<?php
/* MySQLe class by WebNuLL 
 * Klasa która w minimalnym stopniu zastępuje moduł MySQLi
 */
class mysqle
{
	private $Resource;

	public function __construct ( $inHost, $inUser, $inPassword, $inDatabase )
	{
		$this -> Resource = mysql_connect ( $inHost, $inUser, $inPassword );
		if (!$this->Resource) {
			die('MySQL Connect Error');
		}
		mysql_select_db( $inDatabase , $this -> Resource );
	}
	
	public function Query ( $inQuery )
	{
		return new mysqle_result ( mysql_query ( $inQuery ) , $this -> Resource );
		
	}
}

class mysqle_result
{
	private $Object;

	public function __construct ( $queryObject )
	{
		$this -> Object = $queryObject;
	}

	public function fetch_assoc ()
	{
		return mysql_fetch_assoc ( $this -> Object );
	}

	public function num_rows ()
	{
		return mysql_num_rows ( $this -> Object );
	}

	public function fetch_array ()
	{
		return mysql_fetch_array ( $this -> Object );
	}

	public function __get ( $Variable )
	{
		$Variable = strtolower( $Variable );

		switch ( $Variable )
		{
			case 'num_rows':
				return mysql_num_rows ( $this -> Object );
			break;
		}
	}
}
?>
