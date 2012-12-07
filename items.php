
<?php

include "./../config/config.inc";

$sql = "select * from shopping_list where active = 1 order by item";
$result = $PDO->query($sql);

function pr($v){
	echo "<pre>";
	print_r($v);
	echo "</pre>";	
}
?>