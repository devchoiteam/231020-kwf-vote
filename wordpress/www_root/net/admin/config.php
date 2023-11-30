<?php

$config  = array();
$passs = trim(file_get_contents("config/pass.ini"));
$pass = $passs; $config['key'] = $pass;
?>
