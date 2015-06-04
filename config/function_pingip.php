<?  
function pingAddress($ip) {
    $pingresult = exec("/bin/ping -c2 -w2 $ip", $outcome, $status);  
    if ($status==0) {
	 $status = "1"; 
    } else {
	 $status = "0";
    }
    return $status;
}
// Some IP Address
#echo "result : ".pingAddress("192.168.5.1000"); 

?>
