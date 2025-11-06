<?php
require 'config.php';
require 'auth.php';
$mysqli = db_connect();

$error = '';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if($username === '' || $password === ''){
        $error = 'Please fill username and password.';
    } else {
        $stmt = $mysqli->prepare('SELECT id_user, username, password, role FROM user WHERE username = ? LIMIT 1');
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $res = $stmt->get_result();
        if($res->num_rows === 1){
            $u = $res->fetch_assoc();
            if(password_verify($password, $u['password'])){
                $_SESSION['user'] = [
                    'id_user' => $u['id_user'],
                    'username' => $u['username'],
                    'role' => $u['role']
                ];
                header('Location: dashboard.php');
                exit;
            } else {
                $error = 'Wrong username or password.';
            }
        } else {
            $error = 'Wrong username or password.';
        }
    }
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Login - LaundryCrafty</title>
  <link rel="stylesheet" href="assets/style.css">
</head>
<body>
  <div class="wrap auth">
    <h2>LaundryCrafty — Login</h2>
    <?php if($error): ?><div class="alert"><?=$error?></div><?php endif; ?>
    <form method="post" class="form">
      <label>Username <input type="text" name="username" required></label>
      <label>Password <input type="password" name="password" required></label>
      <button class="btn" type="submit">Login</button>
    </form>
  </div>
</body>
</html>