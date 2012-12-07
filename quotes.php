<?php
/*
$doc = new DOMDocument;

$doc->load("http://www.google.com/ig/api?stock=GOOG");



$xpath = new DOMXPath($doc);

// our query is relative to the records node
$query = 'string(//finance/pretty_symbol/@data)';
$query2 = 'string(//finance/change/@data)';


$symbol = $xpath->evaluate($query);
$last = $xpath->evaluate($query2);
echo $symbol ."\n";

echo $last . "\n";*/

echo date("m/d/Y H:i:s") . "\n";

$quotes = file_get_contents("http://finance.google.com/finance/info?client=ig&q=NASDAQ%3aGOOG");
$data = json_decode(str_replace("//" , "" ,  $quotes));

//print_r($data);
echo $data[0]->t . "\n";
echo $data[0]->c . "\n";


?>