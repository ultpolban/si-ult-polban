<?php
$mysqli = new mysqli('localhost', 'root', '', 'si-ult-polban');
if ($mysqli->connect_error) {
    echo "CONNECT_ERR: " . $mysqli->connect_error . PHP_EOL;
    exit(1);
}
$res = $mysqli->query('SHOW TABLES');
if (!$res) {
    echo "ERROR: " . $mysqli->error . PHP_EOL;
    exit(1);
}
while ($row = $res->fetch_array()) {
    echo $row[0] . PHP_EOL;
}
$mysqli->close();
