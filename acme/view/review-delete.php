<!DOCTYPE html>
<html lang="en">
<head>
<title> <?php
         if (isset($invName)) { echo $invName; } ?> | ACME </title>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/head.php'; ?>
<link rel="stylesheet" href="/acme/css/main.css">
<link rel="stylesheet" href="/acme/css/prod-update-button.css">


<!--My textarea wasn't working in my external style sheets-->
<style>
textarea {
 
    width: 40%;
    height: 105px;
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
    header ('Location: /acme/index.php');
    exit();
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
    <div class="form">
     
      <?php
         if (isset($message)) {
           echo $message; }
     ?>
     
    
     
    <form method="post" action="/acme/accounts/index.php">
  <fieldset>
    <legend><?php
         if (isset($invName)) { echo $invName; } ?> Review</legend>
    <h4>Please confirm that you want to delete your review on the <?php if (isset($invName)) {echo $invName; } ?>. The delete is permanent.</h4><br>
    Review Date<br>
    <input type="text" name="reviewDate" id="reviewDate" <?php if(isset($reviewDate)) {echo "value='$reviewDate'";}?> readonly><br><br>
 
    
    
    Review Text<br>
    <textarea name="reviewText" id="reviewText" readonly><?php if(isset($reviewText)) {echo $reviewText; }?></textarea><br><br>
    
    <input type="submit" value="Delete Review"><br>
    <!-- Add the action name - value pair -->
    <input type="hidden" name="action" value="deleteReview">
    <input type="hidden" name="reviewId" value="<?php if(isset($reviewId)){ echo $reviewId;} ?>">
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