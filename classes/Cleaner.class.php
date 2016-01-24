<?php
class Cleaner{
	// recieves something from $dirtyVar and returns it clean as $cleanVar using real_escape_string.

	static function cleanVar($dirtyVar){
		$mysqli = DB::getInstance();
		$cleanVar = $mysqli->real_escape_string($dirtyVar);
		return $cleanVar;
	}
}
?>


			