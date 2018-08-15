<!DOCTYPE html>
<html lang="en">
<head>
<title>ACME | Register</title>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/head.php'; ?>
<link rel="stylesheet" href="/acme/css/main.css">
<link rel="stylesheet" href="/acme/css/prod-update-button.css">



</head>
<body>

<div class="header">   
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/header.php'; ?> 
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
     
     <?php
         if (isset($message)) {
           echo $message; }
     ?>
     
    <form method="post" action="/acme/accounts/index.php">
  <fieldset>
    <legend>Account Information:</legend>
    <h4>Please complete ALL fields</h4>
    <b>First name</b><br>
    <input type="text" name="clientFirstname" id="clientFirstname" <?php if(isset($clientFirstname)){echo "value='$clientFirstname'";}  ?> required><br><br>
    <b>Last name</b><br>
    <input type="text" name="clientLastname" id="clientLastname" <?php if(isset($clientLastname)){echo "value='$clientLastname'";}  ?> required><br><br>
    <b> Email Address</b><br><br>
    <input type="email" name="clientEmail" id="clientEmail" <?php if(isset($clientEmail)){echo "value='$clientEmail'";}  ?> required><br><br>
    <b>Password</b><br><br>
    <span>Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character</span> 
    <br>
    <input type="password" name="clientPassword" id="clientPassword" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"><br><br>
    
    <input type="submit" value="Register"><br>
    <!-- Add the action name - value pair -->
    <input type="hidden" name="action" value="register">
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