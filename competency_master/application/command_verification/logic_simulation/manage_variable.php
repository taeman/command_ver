<?php
header("Content-Type: text/html; charset=tis-620");
?>
<!-- 
Start Import ExtJS framework
 -->
	<script type="text/javascript" src="js/manage_variable.js"></script>
<!-- 
End Import ExtJS framework
 -->
 <script type="text/javascript">
  	$(document).ready(function(){	
		linkPage("tree_variable_group.php", "tree-detail-container-group");				
	 	linkPage("tree_variable.php", "tree-detail-container");
		linkPage("variable.php", "body-detail-container");
	});
 </script>
<style type="text/css">
#manage_variable_panel {
	margin: 0px auto;
}
.folder {
    background-image:url(images/folder_page.png);
	height:20px;
}
</style>
<div id="manage_variable_panel"></div>
