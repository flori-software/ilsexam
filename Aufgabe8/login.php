<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h1>Login</h1>    
<?php
$kennung = $_POST["kennung"] ?? "";
$pin     = $_POST["pin"] ?? "";

if(preg_match('/^[a-zA-Z_]{5,8}$/', $kennung) == 1 && preg_match('/^\d{4}$/', $pin) == 1) {
    echo '<p>Ihre Anmeldung war erfolgreich</p>';
}

echo '<form action="#" method="POST">
<p>5 bis 8-stellige Kennung:
<input name="kennung" value="'.$kennung.'"></p>
<p>4-stellige PIN: <input name="pin" value="'.$pin.'"></p>
<input type="submit" value="Login">
</form>';
?>
</body>
</html>