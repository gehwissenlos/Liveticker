<?php
$crawler = "Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)";
//$crawler = $_SERVER['HTTP_USER_AGENT'];
echo $crawler;
$crawlers_agents = "Google";
 
    if ( stripos($crawlers_agents , $crawler) === true ) {
       echo "<br />Google";
	 } else {
		echo "<br />nicht Google";
	 }

?>