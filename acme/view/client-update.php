<!DOCTYPE html>
<html lang="en">
<head>
<title>ACME | Update Account</title>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/head.php'; ?>
<link rel="stylesheet" href="/acme/css/main.css">
<link rel="stylesheet" href="/acme/css/form.css">

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
} ?>  
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
   <form method="post" action="/acme/accounts/index.php">
  <fieldset>
  
    <h1>Update Account</h1>
    <p>Use this form to update your name or email address.</p><br>
   
    <b>First Name</b><br>
    <input type="text" name="clientFirstname" <?php echo "value='$clientData[clientFirstname]'";  ?> required><br><br>
    <b>Last Name</b><br>
    <input type="text" name="clientLastname" <?php echo "value='$clientData[clientLastname]'";  ?> required><br><br>
    <b>Email Address</b><br>
    <input type="text" name="clientEmail" <?php echo "value='$clientData[clientEmail]'";  ?> required><br><br>
    
    <input type="submit" value="Update Account"><br>
    <!-- Add the action name - value pair -->
    <input type="hidden" name="action" value="updateAccount">
    <input type="hidden" name="clientId"  <?php echo "value='$clientData[clientId]'";  ?>>
  </fieldset>
   </form><br>
    
    <form method="post" action="/acme/accounts/index.php">
  <fieldset>
   <h2>Password Change</h2>
   <p>Use this form to change your password.</p>
   
    <?php
         if (isset($message)) {
           echo $message; }
     ?>
   
   <p>Your old password will be changed to the new one entered below. Also, remember...</p>
    
    <span>Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character</span> 
    <br>
    <input type="password" name="clientPassword" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" ><br><br>
    
    <input type="submit" value="Update Password"><br>
    <!-- Add the action name - value pair -->
    <input type="hidden" name="action" value="updatePassword">
    <input type="hidden" name="clientId"  <?php echo "value='$clientData[clientId]'";  ?>>
  </fieldset>
    </form>
   
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

