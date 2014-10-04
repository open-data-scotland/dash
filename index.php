<?php

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

curl_setopt($ch, CURLOPT_URL,            "http://widge.herokuapp.com/widgets/welcome" );
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 );
curl_setopt($ch, CURLOPT_POST,           1 );
curl_setopt($ch, CURLOPT_HTTPHEADER,     array('Content-Type: text/json')); 
curl_setopt($ch, CURLOPT_POSTFIELDS,     $data ); 

$result=curl_exec ($ch);

echo "<pre>";
var_dump($result);