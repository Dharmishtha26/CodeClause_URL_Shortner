<?php 
  include "php/config.php";
  $new_url = "";
  if(isset($_GET)){
    foreach($_GET as $key=>$val){
      $u = mysqli_real_escape_string($conn, $key);
      $new_url = str_replace('/', '', $u);
    }
      $sql = mysqli_query($conn, "SELECT full_url FROM url WHERE shorten_url = '{$new_url}'");
      if(mysqli_num_rows($sql) > 0){
        $sql2 = mysqli_query($conn, "UPDATE url SET clicks = clicks + 1 WHERE shorten_url = '{$new_url}'");
        if($sql2){
            $full_url = mysqli_fetch_assoc($sql);
            header("Location:".$full_url['full_url']);
          }
      }
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Short URL</title>
    <link rel="stylesheet" href="new.css" >
     <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
</head>
<body>
    <header>
    <div class="overlay">
    <h1>Short URL</h1>
    <h2> A fast and simple URL Shortener</h2>
   </div>
    <p>Free URL Shortener for transforming long, ugly links into nice, memorable and trackable short URLs.
      Use it to shorten links for any social media platforms, blogs, SMS, emails, ads, or pretty
      much anywhere else you want to share them.
      Short URl is the best free alternative to generic URL shorteners.
      After shorterning the URL,check how many clicks it received.</p>
    
    <br/>
    <button class="select">Sign Up</button>
    <button class="select">Login</button>
    </div>
    </header>

    <div class="wrapper">
        <form action="#">
          <i class="url-icon uil uil-link"></i>
          <iconify-icon icon="arcticons:urlsanitizer" style="color: skyblue;"></iconify-icon>
          <input type="text" name="full-url" placeholder="Enter or paste a long URL" required>
          <button class="short">Shorten</button>
        </form>
        
      
          <?php
      $sql2 = mysqli_query($conn, "SELECT * FROM url ORDER BY id DESC");
      if(mysqli_num_rows($sql2) > 0){;
        ?>
          <div class="statistics">
            <?php
              $sql3 = mysqli_query($conn, "SELECT COUNT(*) FROM url");
              $res = mysqli_fetch_assoc($sql3);

              $sql4 = mysqli_query($conn, "SELECT clicks FROM url");
              $total = 0;
              while($count = mysqli_fetch_assoc($sql4)){
                $total = $count['clicks'] + $total;
              }
            ?>
            <span>Total Links: <span><?php echo end($res) ?></span> & Total Clicks: <span><?php echo $total ?></span></span>
            <a href="php/delete.php?delete=all">Clear All</a>
            <a href="php/delete.php?delete=all">Clear All</a>
        </div>
        <span>Total Links: <span><?php echo end($res) ?></span> & Total Clicks: <span><?php echo $total ?></span></span>
          <a href="#">Clear All</a>
          </div>
          
          <div class="urls-area">
            <div class="title">
              <li>Shorten URL</li>
              <li>Original URL</li>
              <li>Clicks</li>
              <li>Action</li>
            </div>
            <?php
            while($row = mysqli_fetch_assoc($sql2)){
              ?>
                <div class="data">
                <li>
                  <a href="<?php echo $domain.$row['shorten_url'] ?>" target="_blank">
                  <?php
                    if($domain.strlen($row['shorten_url']) > 50){
                      echo $domain.substr($row['shorten_url'], 0, 50) . '...';
                    }else{
                      echo $domain.$row['shorten_url'];
                    }
                  ?>
                  </a>
                </li> 
                <li>
                  <?php
                    if(strlen($row['full_url']) > 60){
                      echo substr($row['full_url'], 0, 60) . '...';
                    }else{
                      echo $row['full_url'];
                    }
                  ?>
                </li> 
              </li>
                <li><?php echo $row['clicks'] ?></li>
                <li><a href="php/delete.php?id=<?php echo $row['shorten_url'] ?>">Delete</a></li>
              </div>
              <?php
            }
          ?>
      </div>
        <?php
      }
      ?>
          <div class="blur-effect"></div>
      <div class="popup-box">
      <div class="info-box ">Your short link is ready. You can also edit your short link now but can't edit once you saved it.</div>
    <form action="#" autocomplete="off">
    
    <input  class="input-box"   type="text" class="shorten-url" spellcheck="false" required value="example.com">
    <i class="copy-icon uil uil-copy-alt"></i>
    <button>Save</button>
  </form>
  </div>
        </div>
</div>
    
   <script src="script.js"></script> 
</body>
</html>