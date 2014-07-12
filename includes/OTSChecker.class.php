<?php
class OTSChecker
{
	public $ConnData;
	private $OTData=array(), $XML=array(), $Uptime = array(), $TimeOut;
	public function __construct($IP, $Port=7171)
	{
		$this -> ConnData = array('IP' => $IP, 'Port' => $Port);
	}

	public function SocketTimeOut( $inTimeOut )
	{
		$this -> TimeOut = intval ( $inTimeOut );	
	}

	public function GetData()
	{
		$info = chr(6) . chr(0) . chr(255) . chr(255) . 'info';
		$Sock = @fsockopen( $this->ConnData['IP'] , $this->ConnData['Port'] , $errno, $errstr, 10);

		if ( is_resource ( $Sock ) )
		{
			if ( isset ( $this -> TimeOut ) )
			{
				stream_set_timeout( $Sock , $this -> TimeOut );
			}

			@fwrite( $Sock , $info );

			$Data = NuLL;

			while ( !feof ( $Sock ) )
			{
				$Data .= fgets( $Sock , 1024 );
			}

			@fclose( $Sock );

			

			if ( $Data != NuLL )
			{
				$this->XML = simplexml_load_string ( $Data );
			}

			$this -> OTData['status'] = 'Online';
		} else {
			$this -> OTData['status'] = 'Offline';		
		}
	}

	public function Status ()
	{
		return $this -> OTData['status'];
	}

	private function GenerateUptime ( &$Data )
	{
		preg_match('/uptime="(\d+)"/', $Data, $matches);
		$h = floor($matches[1] / 3600);
		$m = floor(($matches[1] - $h*3600) / 60);
		
		return array ( 'hours' => $h , 'minutes' => $m );
	}

	public function GetOwnerName()
	{
		if ( is_object ( $this -> XML) )
			return (string) $this -> XML -> owner -> attributes() -> name;
	}

	public function GetOwnerEmail()
	{
		if ( is_object ( $this -> XML) )
			return (string) $this -> XML -> owner -> attributes() -> email;
	}

	public function GetServerName()
	{
		if ( is_object ( $this -> XML) )
			return (string) $this -> XML -> serverinfo -> attributes() -> servername;
	}

	public function GetServerLocation()
	{
		if ( is_object ( $this -> XML) )
			return (string) $this -> XML -> serverinfo -> attributes() -> location;
	}

	public function GetServerVersion()
	{
		if ( is_object ( $this -> XML) )
			//return (string) $this -> XML -> serverinfo -> attributes() -> version;
			return (string) $this -> XML -> serverinfo -> attributes() -> version;
	}
	
	public function GetNowUptime()
	{
		if ( is_object ( $this -> XML) )
			return (string) $this -> XML -> serverinfo -> attributes() -> uptime;
	}
	
	public function GetCountOfPlayersOnline()
	{
		if ( is_object ( $this -> XML) )
			return (string) $this -> XML -> players -> attributes() -> online;
	}

	public function GetMaxPlayersCount()
	{
		if ( is_object ( $this -> XML) )
			return (string) $this -> XML -> players -> attributes() -> max;
	}

	public function GetMaxPlayersRecord()
	{
		if ( is_object ( $this -> XML) )
			return (string) $this -> XML -> players -> attributes() -> peak;
	}
	
	public function GetAllMonsters()
	{
		if ( is_object ( $this -> XML) )
			return (string) $this -> XML -> monsters -> attributes() -> total;
	}

	public function GetMotd()
	{
		if ( is_object ( $this -> XML) )
			return (string) $this -> XML -> motd;
	}
}
?> 
