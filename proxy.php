<?php

$myCurl = curl_init();
curl_setopt_array($myCurl, array(
    CURLOPT_URL => 'http://localhost/py/print/html/action',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => /*http_build_query*/(json_encode($_REQUEST))
));

$response = curl_exec($myCurl);
curl_close($myCurl);
$data = json_decode($response, true);
echo $data;                               
?>

<script language="JavaScript">
window.print();
setInterval(function() { window.close(); }, 500);
</script>