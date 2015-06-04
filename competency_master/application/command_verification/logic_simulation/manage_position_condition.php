<?php
header("Content-Type: text/html; charset=windows-874");
?>
<!-- 
Start Import ExtJS framework
 -->
	<script type="text/javascript" src="js/manage_position_condition.js"></script>
<!-- 
End Import ExtJS framework
 -->
 <script type="text/javascript">
  	$(document).ready(function(){			
	 	linkPage("tree_position.php", "tree-detail-container");
		linkPage("position_condition.php", "body-detail-container");
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
<div id="manage_position_condition_panel"></div>
