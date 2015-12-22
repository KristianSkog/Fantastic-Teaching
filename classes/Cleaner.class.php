<?php
class Cleaner{

	static function cleanVar($dirtyVar){
		$mysqli = DB::getInstance();
		$cleanVar = $mysqli->real_escape_string($dirtyVar);
		return $cleanVar;
	}
}
?>


			