<?php require_once "../db.php";
session_start();
$username = $_SESSION['username'];

if ($conn->connect_errno) {
  printf("Connect failed: %s\n", $conn->connect_error);
  exit();
}
$sql = "SELECT id,article_content, article_title FROM article where username = '$username'";
$result = $conn->query($sql);

?>
<!DOCTYPE html>

<head>
  <link rel='stylesheet' href='../style.css' type='text/css'>
</head>

<body>
  <div class='container'>
  <div class="article_header">
      <h1>Article page</h1>
    </div>
    <?php if (isset($_GET["mes"])) {
      echo $_GET["mes"];
    } ?>
    <table class='article_tbl'>
      <thead>
        <tr>
          <th>Title</th>
          <th>Content</th>
          <th>Action</th>
        </tr>
      </thead>
      <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
          <td><?php echo $row['article_title']; ?></td>
          <td><?php echo $row['article_content']; ?></td>
          <td><a href="edit.php?id=<?php echo $row['id'] ?>">Edit</a></td>
        </tr>
      <?php } ?>
    </table>
    <div class="article_btn">
      <a href="post.php"> <button> post page</button></a>&nbsp;&nbsp;
      <a href="index.php"> <button> Dashboard</button></a>&nbsp;&nbsp;
      <a href="view.php"> <button> View</button></a>&nbsp;&nbsp;
    </div>
  </div>
</body>

</html>