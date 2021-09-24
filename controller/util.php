<?php

/* classe de funcionalidades gerais e uteis */
class Util
{

	// limpar parametros que possam causar SQL injection
    public static function clearparam($param) {
	
		$badchars   =  array(")", "(", "'","\"",";","--","\\",">","..");
		return  str_replace($badchars,'',$param);

    }
	
	// comparação entre datas
	public static function ndate_diff($date1, $date2) { 
		$current = $date1; 
		$datetime2 = date_create($date2); 
		$count = 0; 
		while(date_create($current) < $datetime2){ 
			$current = gmdate("Y-m-d", strtotime("+1 day", strtotime($current))); 
			$count++; 
		} 
		return $count; 
	} 
	
}


?>