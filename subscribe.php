<?php
  if(!isset($_SESSION)){
   session_start();
  }
  ?>
<!DOCTYPE html>
<html>
<head>
   <link rel="stylesheet" type="text/css" href="login.css">
    <link rel="stylesheet" type="text/css" href="publish.css">
     <title>Banner</title>
 </head>
<body>
  <div class="header">
    <h1><a class="headerlink" href="index.php">Kerkhoven Banner</a></h1>
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
      echo "<a style=\"float:right\" href=\"profile.php\">{$_SESSION["username"]}</a>";
    }
    else{
      echo "<a style=\"float:right\"  href=\"login.php\">Log in</a>";
      echo "<a style=\"float:right\" href=\"subscribe.php\">Subscribe</a>";
    }
  ?>
</div>
<h5> Provide your email and phone number and we will get in touch. </h5>
<div class="form"><form action="subscribe.php" method="post">
  Email Address:<br>
  <input type="email" name="email" maxlength="30" required>
  <br>
  Phone Number:<br>
  <input type="tel" name="phone" maxlength="12" required><br>
  <input type="submit" value="Submit">
</form>
</div>
<div class="footer">
  <p class="foot">Contact us:<br> 1001 Atlantic Ave, Kerkhoven, MN 56252 <br> (320) 264-3071
  </p>
</div>
</body>
</html>
<?php
  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $_POST['email'] = test_input($_POST['email']);
    $_POST['phone'] = test_input($_POST['phone']);
    $_POST['date'] =  date("Y-m-d h:i:sa");
    $servername = "localhost";
    $username = "cold";
    $password = "Qrp98w!!";
    $dbname = "mydata";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if($conn->connect_error){
    	die("Connection failed: " . $conn->connect_error);
    }
    $sql = "INSERT into subscribe (email, phone, date) values('{$_POST["email"]}', '{$_POST["phone"]}', '{$_POST["date"]}')";
    if ($conn->query($sql) === TRUE) {
      echo "<h5>We will contact you soon!</h5>";
    }
    else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
  }
  $conn->close();
?>
