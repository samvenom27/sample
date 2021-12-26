<?php require_once '../db.php';
session_start();
$conn = new mysqli($servername, $username, $password, $dbname);
if (isset($_POST['save'])) {
    $username = $_SESSION['username'];
    $name = mysqli_real_escape_string($conn, $username);
    $article_title = mysqli_real_escape_string($conn, $_POST['title']);

    $article_content = mysqli_real_escape_string($conn, $_POST['content']);

    if (!strlen($article_content) > 250 || strlen($article_content) == 0 || strlen($article_title) == 0) {
        echo "Error: Fields are empty! or content size exceeded 250 characters.";
    } else {
        $SELECT = "SELECT article_content From article Where article_title = ? Limit 1";
        $INSERT = "INSERT Into article (username, article_title, article_content)values(?,?,?)";

        $stmt = $conn->prepare($SELECT);
        $stmt->bind_param("s", $article_title);
        $stmt->execute();
        $stmt->bind_result($article_title);
        $stmt->store_result();
        $rnum = $stmt->num_rows;

        if ($rnum == 0) {
            $stmt->close();
            $stmt = $conn->prepare($INSERT);
            $stmt->bind_param("sss", $name, $article_title, $article_content);
            $stmt->execute();
            header("Location:article.php?mes=<p>Posted sucessfully.</p>");
        } else {
            echo "Some error occured while posting.";
        }
        $stmt->close();
        $conn->close();
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <link rel='stylesheet' href='../style.css' type='text/css'>
</head>

<body>
    <div class='container'>
        <div class='post_header'>
        <h1>Welcome to Blogger page.</h1>
        </div>
        <form action="post.php" method="post">
            <label>Title:</label><br>
            <textarea id="content" name="title" rows="2" cols="50"></textarea><br><br>
            <label>Type your content:</label><br>
            <textarea id="content" name="content" rows="4" cols="50"></textarea><br>

            <input type="submit" name='save' value="post">
        </form><br>
        
        <div class="post_dash">
        <a href='index.php'><button>Dashboard</button></a>
    </div>
    </div>
</body>

</html>