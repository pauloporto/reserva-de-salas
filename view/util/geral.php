<?php

class Geral{

	static function clear_par($param)
	{
		$badchars   =  array(")", "(", "'","\"",";","--","\\",">","..","&");
		return  str_replace($badchars,'',$param);
	}

}
?>
