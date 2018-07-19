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
      if($_GET["d"] == "y"){
        echo "<h5>Article Deleted.</h5>";
      }
      else if($_GET["d"] == "n"){
        echo "<h5>SQL Error.</h5>";
      }
      $servername = "localhost";
      $username = "cold";
      $password = "Qrp98w!!";
      $dbname = "mydata";
      $conn = new mysqli($servername, $username, $password, $dbname);
      if($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
      }
      $sql = "SELECT * FROM News ORDER BY number DESC LIMIT 5";
      if(isset($_POST['page']) && $_POST['page'] > 0){
        $offset = $_POST['page'] * 5;
        $sql = $sql . " OFFSET {$offset}";
      }
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()){
        echo "<div class=\"row\">
            <h3>{$row["Title"]}</h3>
            <h6>By {$row["Author"]} on {$row["Date"]}</h6>
            <form action=\"edit_story.php\" method=\"post\">
              <input type=\"hidden\" name=\"number\" value=\"{$row['number']}\"/>
              <input type=\"submit\" value=\"Edit\" />
              </form>
              <form action=\"delete.php\" method=\"post\">
                <input type=\"hidden\" name=\"number\" value=\"{$row['number']}\"/>
                <input type=\"submit\" value=\"Delete\" />
                </form>
        </div>";
        }
      }
      $conn->close();
    }
    else{
      echo "<a style=\"float:right\"  href=\"login.php\">Log in</a>";
      echo "<a style=\"float:right\" href=\"subscribe.php\">Subscribe</a></div>";
      echo "<h5>You must be logged in to edit.</h5>";
    }
  ?>
  <form action="edit.php" method="post" class="next">
    <input type="hidden" name="page" value="<?php
    if(!isset($_POST['page'])){
      echo "1";
    }
    else{
        $_POST['page'] = $_POST['page'] + 1;
        echo $_POST['page'];
      }
      ?>"/>
    <input type="submit" value="Next Five Stories" class="nextbutton"/>
    </form>
    <div class="footer">
      <p class="foot">Contact us:<br> 1001 Atlantic Ave, Kerkhoven, MN 56252 <br> (320) 264-3071
      </p>
  </div>
</body>
</html>

