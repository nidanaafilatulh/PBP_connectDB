<?php 
$db_host='localhost';
$db_database='bookorama';
$db_username='root';
$db_password='';
// TODO 1: Buatlah koneksi dengan database
try {
    $db = new mysqli('localhost', 'root', '', 'bookorama');
} catch (mysqli_sql_exception $e) {
    die("Connection failed: " . $e->getMessage());
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>