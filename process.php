<?php
include "./../config/config.inc";
$id = sprintf("%d", $_POST['id']);
	switch($_POST['action']){
		case 'remove':
			
			$sql = "update shopping_list set active=0 where id = ?";
			$q = $PDO->prepare($sql); 
			$q->execute(array($id)); 
			
		break;
		case 'add':
			if($_POST['item']) {
				$sql = "insert into shopping_list (item) values ( ? )";
				$q = $PDO->prepare($sql); 
				$q->execute(array($_POST['item'])); 
			}
			
			
			$sql = "select * from shopping_list where active = 1 order by item";
			$result = $PDO->query($sql);
			$rows = $result->fetchAll();
			?>
			<?php foreach($rows as $row){?>
                <li class="items" item_id="<?php echo $row['id']?>"><?php echo $row['item']?></li>
            <?php }
                       
			exit;
		break;
		case "activate":

			$sql = "update shopping_list set active=1 where id = ?";
			$q = $PDO->prepare($sql); 
			$q->execute(array($id)); 
			
			$sql = "select * from shopping_list where active = 1 order by item";
			$result = $PDO->query($sql);
			$rows = $result->fetchAll();
			?>
			<?php foreach($rows as $row){?>
                <li class="items" item_id="<?php echo $row['id']?>"><?php echo $row['item']?></li>
            <?php }
                       
			exit;
		break;
		case "show_inactive":
			$sql = "select * from shopping_list where active = 0 order by item";
			$result = $PDO->query($sql);
			$rows = $result->fetchAll();
			?>
			<?php foreach($rows as $row){?>
                <li class="inactive-items" item_id="<?php echo $row['id']?>"><?php echo $row['item']?></li>
            <?php }
		
		break;
		case "delete";
			$sql = "delete from shopping_list where id = ?";
			$q = $PDO->prepare($sql); 
			$q->execute(array($id)); 
		break;
		
			
		
	}



?>