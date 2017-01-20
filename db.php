<?php
$db = new PDO('mysql:host=libwebmysqltest.ardclb.uta.edu;dbname=fcw;charset=utf8', 'fcwUser', 'edw00d');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
?>
