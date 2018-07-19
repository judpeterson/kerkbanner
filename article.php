
<?php
  if(!isset($_SESSION)){
   session_start();
  }
  if(isset($_GET['a'])){
    $servername = "localhost";
    $username = "cold";
    $password = "Qrp98w!!";
    $dbname = "mydata";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if($conn->connect_error){
      die("Connection failed: " . $conn->connect_error);
    }
    $sql = "SELECT * FROM News WHERE number={$_GET['a']}";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()){
      $_SESSION['art'] = "<div class=\"row\">
          <h2>{$row["Title"]}</h2>
          <h4>By {$row["Author"]} at {$row["Date"]}</h4>
          <p class=\"article\">" . nl2br($row["Story"]) . "</p>
      </div>";
      }
    }
  }
  else{
    $_SESSION['art'] = "Article not found.";
  }
  $conn->close();
?>
<!DOCTYPE html>
<html>
<head>
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
      echo "<a style=\"float:right\" href=\"profile.php\">{$_SESSION["username"]}</a></div>";
    }
    else{
      echo "<a style=\"float:right\"  href=\"login.php\">Log in</a>";
      echo "<a style=\"float:right\" href=\"subscribe.php\">Subscribe</a></div>";
    }
    echo $_SESSION['art'];
  ?>

  <div class="footer">
  <p class="foot">Contact us:<br> 1001 Atlantic Ave, Kerkhoven, MN 56252 <br> (320) 264-3071
  </p>
</div>
</body>
</html>

