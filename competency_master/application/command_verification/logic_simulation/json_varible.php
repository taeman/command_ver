<?php
$data_out[] = array("name"=>"Lisa","email"=>"lisa@simpsons.com","phone"=>"555-111-1224");
$data_out[] = array("name"=>"Lisa2","email"=>"lisa2@simpsons.com","phone"=>"555-111-0000");
echo '{"items":'.json_encode($data_out).'}';
?>
