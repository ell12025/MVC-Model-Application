<?php 
if (isset($_SESSION['message'])) {
 $message = $_SESSION['message'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title><?php echo $invName; ?> Detail | Acme, Inc.</title>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/head.php'; ?>
<link rel="stylesheet" href="/acme/css/detailDisplay.css">
<link rel="stylesheet" href="/acme/css/prod-update-button.css">
<?php $_SESSION['invInfo'] = $invName;   ?>

<style>
textarea {
 
    width: 40%;
    padding: 12px 20px;
    box-sizing: border-box;
    border: 2px solid #ded6eb;
    border-radius: 4px;
    margin: 8px 0;
    display: inline-block;
    
}
</style>

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
<h1>Product Details for <?php echo $invName; ?></h1>
    
<?php if(isset($message)){
 echo $message; } 
 ?>

<?php if(isset($prodDetailDisplay)){ 
 echo $prodDetailDisplay; 
} ?>
<?php if(isset($prodThumbailDisplay)){ 
 echo $prodThumbailDisplay; 
} ?>

  </div>
</div>
 <div class="row">
  <div class="column">
<h1>Customer Reviews</h1>
<?php if(isset($messageR)){
 echo $messageR; } 
 ?>

<?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
         include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/review.php'; 
}  ?> 

<?php if(isset($allReviewsDisplay)){ 
 echo $allReviewsDisplay; 
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
<?php unset($_SESSION['message']); ?>

