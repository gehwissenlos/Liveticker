<?php    
function base36_encode($base10){
    return base_convert($base10,10,36);
}
 
function base36_decode($base36){
    return base_convert($base36,36,10);
} 

function createPassword () {
	$pool = "qwertzupasdfghkyxcvbnm";
	$pool .= "23456789";
	$pool .= "WERTZUPLKJHGFDSAYXCVBNM";
	
	$password = "";
	srand ((double)microtime()*1000000);
	for($index = 0; $index < 8; $index++)
	{
		$password .= substr($pool,(rand()%(strlen ($pool))), 1);
	}
	return $password;
}

function PostToHost($host, $path, $referer, $data_to_send) {
  $fp = fsockopen($host, 80);
  fputs($fp, "POST $path HTTP/1.1\r\n");
  fputs($fp, "Host: $host\r\n");
  fputs($fp, "Referer: $referer\r\n");
  fputs($fp, "Content-type: application/x-www-form-urlencoded\r\n");
  fputs($fp, "Content-length: ". strlen($data_to_send) ."\r\n");
  fputs($fp, "Connection: close\r\n\r\n");
  fputs($fp, $data_to_send);
  while(!feof($fp)) {
      $res .= fgets($fp, 128);
  }
  fclose($fp);
 
  return $res;
}


function crawlerDetect($USER_AGENT)
{
	/*
	$crawlers = array(
    'Google'=>'Google',
    'MSN' => 'msnbot',
    'Rambler'=>'Rambler',
    'Yahoo'=> 'Yahoo',
    'AbachoBOT'=> 'AbachoBOT',
    'accoona'=> 'Accoona',
    'AcoiRobot'=> 'AcoiRobot',
    'ASPSeek'=> 'ASPSeek',
    'CrocCrawler'=> 'CrocCrawler',
    'Dumbot'=> 'Dumbot',
    'FAST-WebCrawler'=> 'FAST-WebCrawler',
    'GeonaBot'=> 'GeonaBot',
    'Gigabot'=> 'Gigabot',
    'Lycos spider'=> 'Lycos',
    'MSRBOT'=> 'MSRBOT',
    'Altavista robot'=> 'Scooter',
    'AltaVista robot'=> 'Altavista',
    'ID-Search Bot'=> 'IDBot',
    'eStyle Bot'=> 'eStyle',
    'Scrubby robot'=> 'Scrubby',
    )*/
	
    // to get crawlers string used in function uncomment it
    // it is better to save it in string than use implode every time
    // global $crawlers
    // $crawlers_agents = implode('|',$crawlers);
    $crawlers_agents = 'Google|msnbot|Rambler|Yahoo|AbachoBOT|accoona|AcioRobot|ASPSeek|CocoCrawler|Dumbot|FAST-WebCrawler|GeonaBot|Gigabot|Lycos|MSRBOT|Scooter|AltaVista|IDBot|eStyle|Scrubby';
	$crawlers_agents = 'Google';
 
    if ( strpos($crawlers_agents , $USER_AGENT) === false ) {
       return true;
	 } else {
		return false;
	 }
    // crawler detected
    // you can use it to return its name
    /*
    else {
       return array_search($USER_AGENT, $crawlers);
    }
    */
}
?>