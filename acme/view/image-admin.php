<?php 
if (isset($_SESSION['message'])) {
 $message = $_SESSION['message'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>ACME | Image Management</title>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/head.php'; ?>
<link rel="stylesheet" href="/acme/css/main.css">
<link rel="stylesheet" href="/acme/css/prod-mgmt-button.css">




</head>
<body>
<div class="header">
       <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
         include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/logoutheader.php'; 
} else {
    include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/header.php';
}   ?> 
</div>

<div class="page-nav">
       <!--<ul>
  <li><a href="/acme/index.php">Home</a></li>
  <li><a href="#">Cannon</a></li>
  <li><a href="#">Explosive</a></li>
  <li><a href="#">Misc</a></li>
  <li><a href="#">Rocket</a></li>
  <li><a href="#">Trap</a></li>
 </ul>-->
    <?php echo $navList; ?>

</div>
    
    <div class="row">
  <div class="column">
    <h1>Image Management</h1>
    <p>Welcome to the image management page. Please select 
     from one of the options below</p>
    
    <h2>Add New Product Image</h2>
<?php
 if (isset($message)) {
  echo $message;
 } ?>

<form action="/acme/uploads/" method="post" enctype="multipart/form-data">
 <label for="invItem">Product</label><br>
 <?php echo $prodSelect; ?><br><br>
 <label>Upload Image:</label><br>
 <input type="file" name="file1"><br>
 <input type="submit" class="regbtn" value="Upload">
 <input type="hidden" name="action" value="upload">
</form>
    <hr>
    
  <h2>Existing Images</h2>
<p class="notice">If deleting an image, delete the thumbnail too and vice versa.</p>
<?php
 if (isset($imageDisplay)) {
  echo $imageDisplay;
 } ?>  
      
  </div>
</div>
    
    <div class="footer">
<p>&copy; ACME, All rights reserved.</p>
  
  <p>All images used are believed to be in "Fair Use". Please notify the author if any are not and they will be removed.</p>
  
  <p>Last Updated: 2018</p>
</div>

</body>
</html>
<?php unset($_SESSION['message']); ?>
