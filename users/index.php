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
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <title>Document</title>
</head>

<body>

    <div class='container'>
        <div>
            <h1>Article page</h1>
        </div>
        <table class='table article_tbl' >
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Title</th>
                    <th scope="col">Content</th>
                    <th scope="col">Edit content</th>
                    <th scope="col">View content</th>
                </tr>
            </thead>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td ><?php echo $row['article_title']; ?></td>
                    <td><?php echo $row['article_content']; ?></td>
                    <td><a class="btn btn-success edit_btn" data-id="<?php echo $row['id']; ?>">Edit</a></td>
                    <td><a class="btn btn-info view_btn" data-id="<?php echo $row['id']; ?>"> View</a></td>

                </tr>
            <?php } ?>
        </table>
        <div class="article_btn">
            <a href="post.php" > <button class="btn btn-secondary"> post a Blog</button></a>&nbsp;&nbsp;
            <!-- <a href="index.php" > <button class="btn btn-secondary"> Dashboard</button></a>&nbsp;&nbsp; -->
        </div>
    </div>

    <!-- bootstrap modal for edit  -->
    <div class="modal" tabindex="-1" role="dialog" id="modal_frm">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit and Update the content</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- update html -->

                <div class="container">

                    <form>
                        <!-- <label>ID:</label> -->
                        <input type="hidden" name="id" value="" id="hid_id" />
                        <!-- <p><?php echo $id ?></p> -->
                        <label>Title:</label><br>
                        <textarea id="title" name="title" rows="2" cols="50"></textarea><br><br>
                        <label>Type your content:</label><br>
                        <textarea id="content" name="content" rows="4" cols="50"></textarea><br>
                        <input type="submit" name='update' value="Update" class="btn btn-primary update_btn">
                    </form>
                    <div class="modal-footer">
                    
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                
                </div>
                </div>





                <!-- view content -->




                <!-- <div class="modal-footer">
        <button type="button" class="btn btn-primary">Save changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div> -->
            </div>
        </div>
    </div>
    <div class="container mt-5">
        <!-- <a class="btn btn-success" href="#" id="edit_btn">Edit</a> -->
    </div>

    <!-- view content bootstrap -->

    <div class="modal" tabindex="-1" role="dialog" id="view_modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">view content</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">

                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">Title</th>
                                    <th scope="col">Content</th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr class="view_data">
                                    <!-- <td id="view_title"></td>
                                    <td id="view_content"></td> -->
                                </tr>
                            </tbody>
                        </table>


                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <script src="../script.js"></script>
</body>

</html>