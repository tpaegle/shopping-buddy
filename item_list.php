
<?php

include "./../config/config.inc";

$sql = "select * from shopping_list where active = 1 order by item";
$result = $PDO->query($sql);
$rows = $result->fetchAll();


echo $rows[0]['item'];
//pr($rows);

function pr($v){
	echo "<pre>";
	print_r($v);
	echo "</pre>";	
}
?>