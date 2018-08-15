<!DOCTYPE html>
<html lang="en">
<head>
<title><?php echo $categoryName; ?> Products | Acme, Inc.</title>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/head.php'; ?>
<link rel="stylesheet" href="/acme/css/main.css">

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
<h1><?php echo $categoryName; ?> Products</h1>
    
<?php if(isset($message)){
 echo $message; } 
 ?>

<?php if(isset($prodDisplay)){ 
 echo $prodDisplay; 
} ?>
      
  </div>
</div>
    
    <div class="footer">
<hr>
<p>&copy; ACME, All rights reserved.</p>
  
  <p>All images used are believed to be in "Fair Use". Please notify the author if any are not and they will be removed.</p>
  
  <p>Last Updated: 2018</p>
</div>

</body>
</html>

