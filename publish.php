<!DOCTYPE html>
  <html>
  <head>
     <link rel="stylesheet" type="text/css" href="publish.css">
      <title>Banner</title>
   </head>
  <?php
    if(!isset($_SESSION)){
      session_start();
    }
    ?>
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
        echo "<a style=\"float:right\" href=\"profile.php\">{$_SESSION["username"]}</a></div>";
      }
      else{
        echo "<a style=\"float:right\"  href=\"login.php\">Log in</a>";
        echo "<a style=\"float:right\" href=\"subscribe.php\">Subscribe</a></div>";
      }
  if($_SESSION["login"]==True){
    echo "
      <div class=\"form\"><form id=\"usrform\" action=\"publish.php\" method=\"post\">
        Title:<br>
        <input type=\"text\" name=\"title\" required><br>
        Author:<br>
        <input type=\"text\" name=\"author\" maxlength=\"40\" value=\"{$_SESSION["username"]}\" required>
        <br>
        Category:<br>
        <select name=\"category\">
          <option value=\"news\">News</option>
          <option value=\"obituaries\">Obituaries</option>
          <option value=\"columns\">Columns</option>
          <option value=\"kms\">KMS</option>
        </select><br>
        Story:<br>
        <textarea rows=\"10\" cols=\"100\" name=\"story\" form=\"usrform\" spellcheck=\"true\">
</textarea><br>
        <input type=\"submit\" value=\"Submit\">

      </form>
      </div>";
  }
  else{
    echo "<h5>You must be logged in to publish</h5>";
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
  $_POST['author'] = test_input($_POST['author']);
  $_POST['date'] = date("Y-m-d h:i:sa");
  $_POST['story'] = test_input($_POST['story']);
  $_POST['title'] = test_input($_POST['title']);
  $_POST['category'] = test_input($_POST['category']);
  $servername = "localhost";
  $username = "cold";
  $password = "Qrp98w!!";
  $dbname = "mydata";
  $conn = new mysqli($servername, $username, $password, $dbname);
  if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
  }
  $_POST['story'] = $conn->real_escape_string($_POST['story']);
  $_POST['title'] = $conn->real_escape_string($_POST['title']);
  $sql = "INSERT INTO News (Author, Title, Date, Story, Category)
VALUES ('{$_POST['author']}', '{$_POST['title']}', '{$_POST['date']}', '{$_POST['story']}', '{$_POST['category']}')";
  if ($conn->query($sql) === TRUE) {
    echo "<h5>Successfully published</h5>";
  }
  else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }  
}
$conn->close();
?>

