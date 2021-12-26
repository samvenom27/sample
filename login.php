<?php require_once "db.php";
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $username = $_POST["username"];
    $password = $_POST["password"];

    if ($stmt = $conn->prepare('SELECT username, email FROM register WHERE username = ? AND password = ?')) {
        $stmt->bind_param('ss', $username, $password);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($username, $email);
            $stmt->fetch();

            if ($password) {
                session_regenerate_id();
                $_SESSION['username'] = $username;
                $_SESSION['email'] = $email;
                header('Location:users\index.php');
            }
        } else {
            // Incorrect username
            echo "<div class='echo_error'><p>Incorrect username and password!</p></div>";
        }

        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <title>Login</title>
    <link rel='stylesheet' href='style.css' type='text/css'>
</head>

<body>
    <div class='box'>
        <div class='box1'>
            <form action='login.php' method='post'>
                <p class="logoff"><?php if (isset($_GET["logmsg"])) {
                                        echo $_GET["logmsg"];
                                    } ?></p>
                <div class='welcome'>
                    <h2>WELCOME</h2><br /><br>
                </div>
                <div class='lbls'>
                    <lable class='lbl' id='lblname'>Username</lable><br /> <input type='text' name='username' class='form' id='name' /><br />
                    <lable class='lbl' id='lblpsw'>Password</lable><br /> <input type='password' name='password' class='form' id='psw' /><br><br>
                    <input type='submit' value='Login' method='post' class='button' />
                </div>
                <br><br>
                <div class='reg'>
                    <p class='foot'>Don't have an account?</p>
                    <a href='index.php' class='foot'>Register here</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>