<?php
require 'config.php';
$mysqli = db_connect();

$username = 'admin';
$password = 'admin123';
$role = 'admin';

$hash = password_hash($password, PASSWORD_DEFAULT);

$stmt = $mysqli->prepare("SELECT id_user FROM user WHERE username=? LIMIT 1");
$stmt->bind_param('s', $username);
$stmt->execute();
$res = $stmt->get_result();
if($res->num_rows > 0){
    echo "Admin already exists. If you want to recreate, delete the user first.";
    exit;
}

$stmt = $mysqli->prepare("INSERT INTO user (username, password, role) VALUES (?, ?, ?)");
$stmt->bind_param('sss', $username, $hash, $role);
if($stmt->execute()){
    echo "Admin user created. Username: {$username} Password: {$password}";
} else {
    echo "Failed to create admin: " . $mysqli->error;
}