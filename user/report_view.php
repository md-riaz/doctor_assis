<?php
require_once '../config/functions.php';
$id = $_GET['id']??null;

$q = $con->query("SELECT prescription FROM report WHERE id = $id")->fetch_assoc();

echo htmlspecialchars_decode($q['prescription']);
exit();
