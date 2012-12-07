<?php 

include "./../config/config.inc";

$sql = "select * from shopping_list where active = 1 order by item";
$active_list = $PDO->query($sql);

$sql = "select * from shopping_list where active = 0 order by item";
$inactive_list = $PDO->query($sql);


?>
<!DOCTYPE html> 
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="initial-scale=1, maximum-scale=1">
<title>jQuery Mobile Web App</title>
<link href="jquery.mobile-1.0.min.css" rel="stylesheet" type="text/css"/>
<link href="shopping.css" rel="stylesheet" type="text/css"/>
<script src="jquery-1.6.4.min.js" type="text/javascript"></script>
<script src="jquery.mobile-1.0.min.js" type="text/javascript"></script>
<script>
// Listen for any attempts to call changePage().
$(document).bind( "pagebeforechange", function( e, data ) {
	
	/*$.get('items.php', function(t){
		$( '#page' ).children( ":jqmData(role=content)" ).html(t);
	});
	
	
	
	
	return;*/
	
	$('#form_item').submit(function(){
		
		$.post('process.php', {'action':'add', 'item': $('#item').val() }, function(t){ //alert(t);
			//var new_item = '<li class="items">' + $('#item').val() + '</li>'; 
			$('#listview').empty().append(t).listview('refresh');
			$('#item').val('');
			//$('div[data-role="footer"]').css({'bottom':0});
			
		 });
		return false;	
	});
	
	
	$(".items").live("swiperight",function(event) {
		$.post('process.php', {'action':'remove', 'id':$(this).attr('item_id')}, function(t){ alert(t); });
		
		$(this).remove();
	});
	
	$(".inactive-items").live("swiperight",function(event) {
		$.post('process.php', {'action':'activate', 'id':$(this).attr('item_id')}, function(t){ 
			$('#listview').empty().append(t).listview('refresh');
		 });
		
		
		$.post('process.php', {'action':'show_inactive', 'id':$(this).attr('item_id')}, function(t){ 
			$('#listview2').empty().append(t).listview('refresh');
		 });
		 
		 $(this).remove();
		
	});
	
	// We only want to handle changePage() calls where the caller is
	// asking us to load a page by URL.
	if ( typeof data.toPage === "string" ) {

		// We are being asked to load a page by URL, but we only
		// want to handle URLs that request the data for a specific
		// category.
		var u = $.mobile.path.parseUrl( data.toPage ),
			re = /^#page2/;

		if ( u.hash.search(re) !== -1 ) {

			// We're being asked to display the items for a specific category.
			// Call our internal method that builds the content for the category
			// on the fly based on our in-memory category data structure.
			//showCategory( u, data.options );
			var $page = $( u.hash ),

			// Get the header for the page.
			$header = $page.children( ":jqmData(role=header)" ),

			// Get the content area element for the page.
			$content = $page.children( ":jqmData(role=content)" );

			// The markup we are going to inject into the content
			// area of the page.
			
			
			$header.find( "h1" ).html( "fred" );
			$content.html( "<div>hi world.. this is cool content</div>" );
			$page.page();
			
			$.mobile.changePage( $page, data.options );
			// Make sure to tell changePage() we've handled this call so it doesn't
			// have to do anything.
			e.preventDefault();
		}
	}
});
</script>
</head> 
<body> 

<div data-role="page" id="page">
	<div data-role="header">
		<h1>Shopping Buddy</h1>
	</div>
	<div data-role="content">
    	
        <div data-role="collapsible-set" data-theme="b">
            <div data-role="collapsible" data-collapsed="true">
                <h3>
                    Manage Items
                </h3>
                <form id="form_item" action="process.php">
                <div data-role="fieldcontain" class="ui-hide-label">
                    <label for="username">Item:</label>
                    <input type="text" name="item" id="item" value="" placeholder="Item"/>
                </div>
                <input type="submit" value="Add"/>
                </form>
        	</div>
        </div>	
        
    
    
    	<div data-role="collapsible-set" data-theme="b">
            <div data-role="collapsible" data-collapsed="true">
                <h3>
                    Shopping List
                </h3>
            	<div id="list-container">
                    <ul data-role="listview" data-theme="d" id="listview">
                        <?php foreach($active_list as $row){?>
                            <li class="items" item_id="<?php echo $row['id']?>"><?php echo $row['item']?></li>
                        <?php }
                        ?>
                    </ul>
              	</div>
        	</div>
        </div>	
        
        <div data-role="collapsible-set" data-theme="b">
            <div data-role="collapsible" data-collapsed="true">
                <h3>
                    Inactive List
                </h3>
            	<div id="list-container">
                    <ul data-role="listview" data-theme="d" id="listview2">
                        <?php foreach($inactive_list as $row){?>
                            <li class="inactive-items" item_id="<?php echo $row['id']?>"><?php echo $row['item']?></li>
                        <?php }
                        ?>
                    </ul>
              	</div>
        	</div>
        </div>
        
        
        
	</div>
    
	<!--<div data-role="footer">
		<h4>Page Footer</h4>
	</div>-->
</div>


</body>
</html>
