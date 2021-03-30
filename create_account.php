<?php
require 'include/db_credentials.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>Create Account</title>
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="css/create_account.css">
  <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
  <script type="text/javascript">
    window.jQuery || document.write('<script src=“js/jquery-3.1.1.min.js”><\/script>');
  </script>
  <script type="text/javascript" src="js/create_account.js"></script>
</head>

<body>
  <?php include 'header.php'; ?>
  <div id="main_wrapper">
    <form method="post" action="create_account.php" id="user_form" enctype="multipart/form-data">
      <fieldset>
        <legend>
          <h1 id="header">Create Account</h1>
        </legend>

        <label>Username:</label>
        <input type="text" name="id" placeholder="Enter username" class="required" />
        <br />
        <label>Email:</label>
        <input type="text" name="email" placeholder="Enter your email" class="required" />
        <br />
        <label>Password:</label>
        <input type="password" name="password" placeholder="Enter password" class="required" />
        <br />
        <label>First Name:</label>
        <input type="text" name="fname" placeholder="Enter your first name" class="required" />
        <br />
        <label>Last Name:</label>
        <input type="text" name="lname" placeholder="Enter your last name" class="required" />
        <br />
        <label>User Photo:</label>
        <input type="file" id="uPhoto " name="photo" accept="image/png, image/jpeg" class="required">

        <div id="req">
          All fields must be entered
        </div>

        <input type="submit" value="Create Account" />
        <input type="reset" />
      </fieldset>
    </form>
    <?php
    $id = "";
    $email = "";
    $password = "";
    $fname = "";
    $lname = "";
    $userImage = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $id = $_POST["id"] ?? "";
      $email = $_POST["email"] ?? "";
      $password = $_POST["password"] ?? "";
      $fname = $_POST["fname"] ?? "";
      $lname = $_POST["lname"] ?? "";
      $userImage = $_FILES["photo"]["name"] ?? "";
      if ($userImage != "") {
        if ($_FILES["photo"]["size"] <= 64000) {
          if ($id != "" && $email != "" && $password != "" && $fname != "" && $lname != "" && $userImage != "") {
            $image = file_get_contents($_FILES["photo"]['tmp_name']);
            $sqlinsert = "INSERT INTO users(username, pass, firstName, lastName, email, pic) VALUES (?,?,?,?,?,?)";
            $statement = $pdo->prepare($sqlinsert);
            $statement->bindValue(1, $id);
            $statement->bindValue(2, $password);
            $statement->bindValue(3, $fname);
            $statement->bindValue(4, $lname);
            $statement->bindValue(5, $email);
            $statement->bindParam(6, $image, PDO::PARAM_LOB);
            $statement->execute();
            echo "<a href='login.php'>Account successfully created! Click here to login</a>";
          }
        } else {
          echo "<p>Upload Failed: Uploaded image file must be under 64 KB</p>";
        }
      }
    }
    ?>
    <!-- <a href="main.php">Go to Main Page</a> -->
  </div>
  <?php include 'footer.php'; ?>
</body>

</html>