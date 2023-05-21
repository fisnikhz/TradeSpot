<?php

require_once("connection.php");

$sql="CREATE TABLE `google_users` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `google_id` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
    `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
    `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
    `profile_image` text COLLATE utf8mb4_unicode_ci NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `google_id` (`google_id`)
   ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

 if(!mysqli_query($conn,$sql)){
	
	die("<br>Tabela nuk mund te krijohet! ".mysqli_error($conn));
	
}

echo "<br>Tabela eshte krijuar!";

mysqli_close($conn);  

?>
