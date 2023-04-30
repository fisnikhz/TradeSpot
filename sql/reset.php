<?php

require_once("connection.php");

$sql="CREATE TABLE temp_reseto (
  `email` varchar(250) NOT NULL,
  `key` varchar(250) NOT NULL,
  `expDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1";

 if(!mysqli_query($conn,$sql)){
	
	die("<br>Tabela nuk mund te krijohet! ".mysqli_error($conn));
	
}

echo "<br>Tabela eshte krijuar!";

mysqli_close($conn);  

?>