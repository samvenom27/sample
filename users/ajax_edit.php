<?php require_once "../db.php";
session_start();
if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $sql = "SELECT article_content, article_title FROM article where id = '$id'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    echo json_encode($row);
}

if (isset($_POST["id"])) {
    $id = $_POST["id"];
    $article_title = mysqli_real_escape_string($conn, $_POST['title']);
    $article_content = mysqli_real_escape_string($conn, $_POST['content']);
    if (strlen($article_content) > 250 || strlen($article_content) == 0 || strlen($article_title) == 0) {
        echo "Error: content size exceeded 250 characters or Empty.";
    } else {
        // query for updation.      
        $UPDATE = "UPDATE article SET article_content = '$article_content',article_title = '$article_title'  WHERE id= '$id'";
        $stmt = $conn->prepare($UPDATE);
        $stmt->execute();
        $stmt->store_result();
        $rnum = $stmt->num_rows;
        echo $rnum;
        
        
        $stmt->close();
        // header("Location:article.php?mes=<p>Updated sucessfully.</p>");
    }
    $stmt->close();
    $conn->close();
}
