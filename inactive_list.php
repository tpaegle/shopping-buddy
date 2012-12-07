
<?php
include "./../config/config.inc";

$sql = "select * from shopping_list where active = 0 order by item";
$inactive_list = $PDO->query($sql);




?>
<?php foreach($inactive_list as $row){?>
                            <li class="inactive-items" item_id="<?php echo $row['id']?>"><?php echo $row['item']?></li>
                        <?php }
                        ?>