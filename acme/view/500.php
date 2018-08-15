<!DOCTYPE html>
<html lang="en">
<head>
<title>CSS Website Layout</title>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/head.php'; ?>
<link rel="stylesheet" href="/acme/css/main.css">


</head>
<body>

<div class="header"> 
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/header.php'; ?>    
</div>

<div class="page-nav">
       <ul>
  <li><a href="/acme/index.php">Home</a></li>
  <li><a href="#">Cannon</a></li>
  <li><a href="#">Explosive</a></li>
  <li><a href="#">Misc</a></li>
  <li><a href="#">Rocket</a></li>
  <li><a href="#">Trap</a></li>
 </ul>

</div>
    
    <div class="row">
  <div class="column">
    <h2>Server Error</h2>
    <p>Sorry, the server experienced a problem</p>
    
      <hr>
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
