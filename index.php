<?php

$xml = simplexml_load_file("http://feeds.bbci.co.uk/news/scotland/rss.xml");

$json = json_decode( json_encode($xml) );

$items = $json->channel->item;

// $max_iterations = 20;
$max_iterations = count($items);

for ($i = 0; $i < $max_iterations; $i++) {

	$rand = rand(0, count($items));
	$item = $items[$rand];

	$data = '
		{ 
			"token" : "b5089dd0-b9cd-4938-bca0-354d1f778a0e", 
			"data" : { 
				"title" : "' . $item->title . '", 
				"text" : "' . $item->description .'"
			}
		}
	';

	update($data);
	sleep(2);

}


function update($data) {

	$ch = curl_init();

	curl_setopt($ch, CURLOPT_URL,            "http://widge.herokuapp.com/widgets/rss-news" );
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 );
	curl_setopt($ch, CURLOPT_POST,           1 );
	curl_setopt($ch, CURLOPT_HTTPHEADER,     array('Content-Type: text/json')); 
	curl_setopt($ch, CURLOPT_POSTFIELDS,     $data ); 

	curl_exec ($ch);
	
}
