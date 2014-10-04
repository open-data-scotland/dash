<?php

$raw_xml = file_get_contents("http://feeds.bbci.co.uk/news/scotland/rss.xml");

$xml = simplexml_load_string($raw_xml);

$raw_json = json_encode($xml);

$json = json_decode($raw_json);

$items = $json->channel->item;

foreach( $items as $item ) {
	echo $item->title."<br>";
}

$data = '
	{ 
		"token" : "b5089dd0-b9cd-4938-bca0-354d1f778a0e", 
		"data" : { 
			"title" : "The title", 
			"text" : "The main text"
		}
	}
';

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL,            "http://widge.herokuapp.com/widgets/rss-news" );
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 );
curl_setopt($ch, CURLOPT_POST,           1 );
curl_setopt($ch, CURLOPT_HTTPHEADER,     array('Content-Type: text/json')); 
curl_setopt($ch, CURLOPT_POSTFIELDS,     $data ); 

$result=curl_exec ($ch);

echo "<pre>";
var_dump($result);