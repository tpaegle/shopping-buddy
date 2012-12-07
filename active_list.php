<link href="jquery.mobile-1.0.min.css" rel="stylesheet" type="text/css"/>
<link href="shopping.css" rel="stylesheet" type="text/css"/>
<?php
include "./../config/config.inc";

$sql = "select * from shopping_list where active = 1 order by item";
$active_list = $PDO->query($sql);




?>
<?php foreach($active_list as $row){?>
                            <li class="items" item_id="<?php echo $row['id']?>"><?php echo $row['item']?></li>
                        <?php }
                        ?>