<?php 
 $clientData = $_SESSION['clientData'];
 if($clientData['clientLevel'] < '2')
  {
   header ('Location: /acme/index.php');
   exit();
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>ACME | Add Category</title>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/head.php'; ?>
<link rel="stylesheet" href="/acme/css/main.css">
<link rel="stylesheet" href="/acme/css/prod-update-button.css">



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
    <h2>Add New Category:</h2>
    <div class="form">
     
     <?php
         if (isset($message)) {
           echo $message; }
     ?>
     
    <form method="post" action="/acme/products/index.php">
  <fieldset>
    <legend>Category</legend>
    <h4>Add a new category below</h4>
    New category name<br>
    <input type="text" name="categoryName" id="categoryName"  required><br><br>
    <input type="submit" value="Add Category"><br>
    <!-- Add the action name - value pair -->
    <input type="hidden" name="action" value="addCategory">
  </fieldset>
    </form>
    </div>
    
    
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