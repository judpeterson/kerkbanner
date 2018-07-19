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
        echo "<a style=\"float:right\" href=\"edit.php\">Edit</a>";
        echo "<a style=\"float:right\" href=\"profile.php\">{$_SESSION["username"]}</a>
        </div>";
        echo "<h5>You are already logged in as {$_SESSION["username"]}. </h5>";
      }
      else{
        echo "<a style=\"float:right\"  href=\"login.php\">Log in</a>";
        echo "<a style=\"float:right\" href=\"subscribe.php\">Subscribe</a>
        </div>";
        echo "<div class=\"form\"><form action=\"login.php\" method=\"post\">
          Username:<br>
          <input type=\"text\" name=\"username\" maxlength=\"20\" required>
          <br>
          Password:<br>
          <input type=\"password\" name=\"psw\" maxlength=\"20\" required><br>
          <input type=\"submit\" value=\"Submit\">
        </form>
        </div>";
      }
    ?>
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
  $_POST['username'] = test_input($_POST['username']);
  $_POST['password'] = test_input($_POST['psw']);
  $servername = "localhost";
  $username = "cold";
  $password = "Qrp98w!!";
  $dbname = "mydata";
  $conn = new mysqli($servername, $username, $password, $dbname);
  if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
  }
  $sql = "SELECT * FROM users WHERE id = '{$_POST["username"]}'";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()){
      if($row["sha"] == hash(sha512, $_POST["psw"])){
        $_SESSION["username"]=$_POST["username"];
        $_SESSION["login"]=True;
        echo "logged in successfully as {$_SESSION["username"]}";
        header('Location: index.php');
      }
      else{
        echo "<h5>Incorrect password</h5>";
      }
    }
  }
  else{
      echo "<h5>Username not found</h5>";
  }
}
$conn->close();
?>

