<?php

function db_connect_fcw( $sys_dbname = 'fcw' ) {
 #global $host, $dbuser, $password;
  $conn = @mysql_pconnect("libwebmysqltest.ardclb.uta.edu", "dlsadmin", "edw00d");
  if ( !$conn || !@mysql_select_db( $sys_dbname, $conn ) ) {
 $conn = false;
  }
  return $conn;
}

?>

