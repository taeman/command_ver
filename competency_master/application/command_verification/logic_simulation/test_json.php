<?php
header("Content-Type: text/html; charset=windows-874");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=TIS-620" />
<title>Form Validate</title>
<script type="text/javascript" src="js/jquery/jquery-1.6.4.min.js"></script>
<script type="text/javascript" src="js/jqueryui/js/jquery-ui-1.8.16.custom.min.js"></script>
<script type="text/javascript" src="js/main.js"></script>
</head>
<body topmargin="0" leftmargin="0" rightmargin="0" >
<script>
function loadPage(){
	var link_page = 'json_varible.php';
	var show_html = "#link_maps";
	$.get(link_page, function(data) {
	  $(show_html).val(data);
	 //alert(data);
	});
}
function jsonReadMaps(){
	var strMaps = document.getElementById( 'link_maps' ).value;
	//arrMapID = mapID.split( "," );
	var json_obj_items = eval( '(' + strMaps + ')' );
	//alert(strMaps);
	var items = json_obj_items.items;
	var count = items.length;
	var strImage = '';
	for (I=0;I<count;I++){
		strImage += items[I].name;
		if(I != count){
			strImage += ',';
		}else{
			strImage += '';
		}
		
	}
	return strImage;
}
</script>
<a href="javascript:alert(jsonReadMaps());">Get Json</a>
<input type="text" name="link_maps" id="link_maps" value="" size="90"/>
<script>
loadPage();
</script>
</body>
</html>
