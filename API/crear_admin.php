<?php
require "api/db.php";

$pass = password_hash("admin123", PASSWORD_DEFAULT);

$conn->query("UPDATE users SET password='$pass'
WHERE email='admin@jarvix.com'");

echo "Admin actualizado";
