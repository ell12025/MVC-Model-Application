<!DOCTYPE html>
<html lang="en">
<head>
<title>ACME | Admin</title>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/head.php'; ?>
<link rel="stylesheet" href="/acme/css/main.css">
</head>
<body>
<?php
 $clientData = $_SESSION['clientData'];
?>
<div class="header">
        <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
         include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/logoutheader.php'; 
} else {
    header ('Location: /acme/index.php');
    exit();
}?>  
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
    <h1>Account Details</h1>
     <?php if(isset($cookieFirstname)){
 echo "<h2>$cookieFirstname</h2>";
} ?>    
   <p>You are logged in.</p>
   
   <?php
         if (isset($message)) {
           echo $message; }
     ?>

    <ul>
     <li>First Name: <?php echo $clientData['clientFirstname'];?></li>
     <li>Last Name: <?php echo $clientData['clientLastname'];?></li>
     <li>Email Address: <?php echo $clientData['clientEmail'];?></li>
    </ul>
    
   <a href="/acme/accounts/index.php?action=client-update" style="text-decoration: none;"><p>Update Account Information</p></a>
  
    <?php 
     if ($clientData['clientLevel'] > '2')
     {
      echo '<h3>Administrative Functions</h3>';
      echo '<p>Use this link below to manage products.</p>';
       echo '<a style="text-decoration: none;" href="/acme/products/">Products</a>';
     }
     ?>
   
   <h3>Manage Your Product Reviews</h3>
   
   <?php
if (isset( $adminReviewDisplay)) {
 echo  $adminReviewDisplay;
}
?>
      
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

