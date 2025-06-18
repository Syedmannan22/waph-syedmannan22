<?php 
if (!isset($_REQUEST["data"])) { 
    die("{\"error\": \"Please provide 'data' field\"}"); 
} 
echo htmlentities($_REQUEST["data"]); 
?>

