<?php
  if(!isset($_SESSION)){
    session_start();
  }
  $servername = "localhost";
  $username = "cold";
  $password = "Qrp98w!!";
  $dbname = "mydata";
  $conn = new mysqli($servername, $username, $password, $dbname);
  if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
  }
  $sql = "SELECT * FROM News WHERE Category='columns' ORDER BY number DESC LIMIT 6";
  if(isset($_POST['page']) && $_POST['page'] > 0){
    $offset = $_POST['page'] * 5;
    $sql = $sql . " OFFSET {$offset}";
  }
  $result = $conn->query($sql);
  $inc = 0;
  $_SESSION['storyOne'] = "";
  $_SESSION['storyTwo'] = "";
  $_SESSION['storyThree'] = "";
  $_SESSION['storyFour'] = "";
  $_SESSION['storyFive'] = "";
  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()){
      if($inc == 0){
        $_SESSION['storyOne'] = "<div class=\"row\">
            <h2><a class=\"headerlink\" href=\"article.php?a={$row["number"]}\">{$row["Title"]}</a></h2>
            <h4>By {$row["Author"]} at {$row["Date"]}</h4>
            <p>" . nl2br($row["Story"]) . "</p>
        </div>";
      }
      else if($inc == 1){
        $_SESSION['storyTwo'] = "<div class=\"row\">
            <h2><a class=\"headerlink\" href=\"article.php?a={$row["number"]}\">{$row["Title"]}</a></h2>
            <h4>By {$row["Author"]} at {$row["Date"]}</h4>
            <p>" . nl2br($row["Story"]) . "</p>
        </div>";
      }
      else if($inc == 2){
        $_SESSION['storyThree'] = "<div class=\"row\">
            <h2><a class=\"headerlink\" href=\"article.php?a={$row["number"]}\">{$row["Title"]}</a></h2>
            <h4>By {$row["Author"]} at {$row["Date"]}</h4>
            <p>" . nl2br($row["Story"]) . "</p>
        </div>";
      }
      else if($inc == 3){
        $_SESSION['storyFour'] = "<div class=\"row\">
            <h2><a class=\"headerlink\" href=\"article.php?a={$row["number"]}\">{$row["Title"]}</a></h2>
            <h4>By {$row["Author"]} at {$row["Date"]}</h4>
            <p>" . nl2br($row["Story"]) . "</p>
        </div>";
      }
      else if($inc == 4){
        $_SESSION['storyFive'] = "<div class=\"row\">
            <h2><a class=\"headerlink\" href=\"article.php?a={$row["number"]}\">{$row["Title"]}</a></h2>
            <h4>By {$row["Author"]} at {$row["Date"]}</h4>
            <p>" . nl2br($row["Story"]) . "</p>
        </div>";
      }
      $inc += 1;
  }
}
  $conn->close();
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="banner.css">
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
          echo "<a style=\"float:right\" href=\"profile.php\">{$_SESSION["username"]}</a>";
        }
        else{
          echo "<a style=\"float:right\"  href=\"login.php\">Log in</a>";
          echo "<a style=\"float:right\" href=\"subscribe.php\">Subscribe</a>";
        }
      ?>
    </div>
    <div class="wrapper">
      <div class="three">
        <?php
              echo $_SESSION['storyTwo'];
            ?>
        </div>
      <div class="four">
        <?php
            echo $_SESSION['storyOne'];
        ?>
        </div>
      <div class="five">
        <?php
              echo $_SESSION['storyThree'];
            ?>
        </div>
      <div class="six">
        <?php
              echo $_SESSION['storyFour'];
            ?>
        </div>
      <div class="seven">
         <?php
              echo $_SESSION['storyFive'];
            ?></div>
    </div>
  <form action="columns.php" method="post" class="next">
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

