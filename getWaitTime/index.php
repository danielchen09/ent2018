<!--login-->
<?php
ini_set('display_errors', 1);
ini_set('displat_startup_errors', 1);
error_reporting(E_ALL);
include("../classes.php");
session_start();
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link rel="shortcut icon" type="image/x-icon" href="../marker.png" />
        <title>Hospital Finder-Get wait time</title>
  </head>
  <body>
      <div class="jumbotron">
        <h1>Get Time Data</h1>
      </div>

      <?php
        
        ?>
      <div class="jumbotron" id="mainJumbotron">
        <div class="panel panel-default">

          <div class="panel-heading">文章URL抓取</div>

          <div class="panel-body">
            <div class="form-group">
              <label for="article_title">文章標題</label>
              <input type="text" class="form-control" id="article_title" placeholder="文章標題">
            </div>
            <div class="form-group">
              <label for="website_url">網站URL</label>
              <input type="text" class="form-control" id="website_url" placeholder="網站URL">
            </div>

            <button type="submit" class="btn btn-default">抓取</button>
          </div>
        </div>
        <div class="panel panel-default">

          <div class="panel-heading">文章URL</div>

          <div class="panel-body">
            <h3></h3>
          </div>
        </div>
      </div>
  </body>
</html>