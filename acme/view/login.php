<!DOCTYPE html>
<html lang="en">
<head>
<title>ACME | Login</title>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/head.php'; ?>
<link rel="stylesheet" href="/acme/css/main.css">
<link rel="stylesheet" href="/acme/css/form.css">



</head>
<body>

<div class="header">   
    <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
         include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/logoutheader.php'; 
} else {
    include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/header.php';
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
    <h2>Login</h2>
    <div class="form">
     
     <?php
         if (isset($_SESSION['message'])) {
 echo $_SESSION['message'];
}
     ?>
     
    <form action="/acme/accounts/index.php" method="post">
  <fieldset>
    <legend>Account Information:</legend>
    <b>Email Address</b><br>
    <input type="email" name="clientEmail" <?php if(isset($clientEmail)){echo "value='$clientEmail'";}  ?> required><br><br>
    <b>Password</b><br><br>
      <span>Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character</span> 
    <br>
    <input type="password" name="clientPassword" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" ><br>
     
    <br>
    <input type="submit" value="login"><br>
    <input type="hidden" name="action" value="Login">
    <h4>No account? Create one here</h4>
    <button class="linkedButton"><a href="/acme/accounts/index.php?action=registration">create an account</a></button>
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