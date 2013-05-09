<?php

$jpeg_data = file_get_contents('php://input');
$filename = PUB_PATH. "img/upload/.jpg";
$result = file_put_contents( $filename, $jpeg_data );

?>