<!DOCTYPE html>
<html>
<head>
 <link rel="stylesheet" type="text/css" href="banner.css">
 <link rel="stylesheet" type="text/css" href="publish.css">
</head>
<?php
  if(!isset($_SESSION)){
   session_start();
  }
  ?>
<body>
<div class="header">
<h1>Kerkhoven Banner</h1>
</div>
<div class="topnav">
  <a href="news.php">News</a>
  <a href="columns.php">Columns</a>
  <a href="obituaries.php">Obituaries</a>
  <a href="kms.php">KMS</a>
  <a href="about.php">About Us</a>
  <a href="https://www.facebook.com/KerkhovenBanner">Facebook</a>
  <?php
    if($_SESSION["login"]==True){
      echo "<a style=\"float:right\" href=\"logout.php\">Log out</a>";
      echo "<a style=\"float:right\" href=\"publish.php\">Publish</a>";
      echo "<a style=\"float:right\" href=\"edit.php\">Edit</a>";
      echo "<a style=\"float:right\" href=\"profile.php\">{$_SESSION["username"]}</a></div>";
      function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
      }
      if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $_POST['number'] = test_input($_POST['number']);
        $servername = "localhost";
        $username = "cold";
        $password = "Qrp98w!!";
        $dbname = "mydata";
        $conn = new mysqli($servername, $username, $password, $dbname);
        if($conn->connect_error){
          die("Connection failed: " . $conn->connect_error);
        }
        $del = false;
        $sql = "DELETE FROM News WHERE number = '{$_POST['number']}'";
        if ($conn->query($sql) === TRUE) {
          $del = true;
        }
      }
      $conn->close();
      if($del){
        header('Location: edit.php?d=y');
      }
      else{
        header('Location: edit.php?d=n');
      }
    }
    else{
      echo "<a style=\"float:right\"  href=\"login.php\">Log in</a>";
      echo "<a style=\"float:right\" href=\"subscribe.php\">Subscribe</a></div>";
      echo "<h5>You must be logged in to edit.</h5>";
    }
  ?>
  <div class="footer">
    <p>Contact Us:<br>
      1001 Atlantic Ave, Kerkhoven, MN 56252<br>
      (320) 264-3071
    </p>
  </div>
</body>
</html>
