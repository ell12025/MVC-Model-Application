<?php 
 $clientData = $_SESSION['clientData'];
 if($clientData['clientLevel'] < '2')
  {
   header ('Location: /acme/index.php');
   exit();
  }
  if (isset($_SESSION['message'])) {
 $message = $_SESSION['message'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>ACME | Product Management</title>
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
}?>  
</div>

<nav class="page-nav">
 <!--<ul>
  <li><a href="/acme/index.php">Home</a></li>
  <li><a href="#">Cannon</a></li>
  <li><a href="#">Explosive</a></li>
  <li><a href="#">Misc</a></li>
  <li><a href="#">Rocket</a></li>
  <li><a href="#">Trap</a></li>
 </ul>-->
    <?php echo $navList; ?>
</nav>
    
    <div class="row">
  <div class="column">
    <h2>Register</h2>
    <div class="form">
     

     
    <form method="post" action="/acme/products/index.php">
  <fieldset>
    <legend>Product Management</legend>
    <h4>Welcome to the product management page. Please choose an option below.</h4>
    <button class="linkedButton"><a href="/acme/products/index.php?action=new-cat">Add a New Category</a></button><br><br>
    <button class="linkedButton"><a href="/acme/products/index.php?action=new-prod">Add a New Product</a></button><br><br>
  </fieldset>
    </form>
    </div>
    <br>
    <?php
if (isset($message)) {
 echo $message;
} if (isset($prodList)) {
 echo $prodList;
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
<?php unset($_SESSION['message']); ?>
