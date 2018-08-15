<!DOCTYPE html>
<html lang="en">
<head>
<title>ACME | Home</title>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/head.php'; ?>
<link rel="stylesheet" href="/acme/css/homestyle.css">

</head>
<body>

<div class="header">
       <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
         include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/logoutheader.php'; 
} else {
    include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/header.php';
}   ?> 
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
  <div class="column1">
    <h2>Welcome to Acme!</h2>
      <div class="container">
          <img src="/acme/images/site/rocketfeature.jpg" alt="rocket">
          <div class="top-right"><h2>Acme Rocket</h2>
          <p>Quick lighting fuse<br>NHTSA approved seat belts<br>Mobile launch stand included</p>
              <a href="#"><img src="/acme/images/site/iwantit.gif" alt="I want it"></a>
          
          
          
          </div>

      </div>
   
  </div>
  
  </div>

    
    
    <div class="row">
  <div class="column">
    <h2>Featured Reciples</h2>
      <div class="sub_row">
          <div class="sub_column">
      <img src="/acme/images/recipes/bbqsand.jpg" alt="bbq sandwich recipe"><a href=URL(https://www.allrecipes.com/recipe/92462/slow-cooker-texas-pulled-pork/)><br>Pulled Roadrunner BBQ</a>
          </div>
    <div class="sub_column">
        <img src="/acme/images/recipes/potpie.jpg" alt="toppie"><a href=URL(https://www.pillsbury.com/recipes/classic-chicken-pot-pie/1401d418-ac0b-4b50-ad09-c6f1243fb992)><br>Roadrunner Pot Pie</a>
          </div>
        </div>
      
      <div class="sub_row">
          <div class="sub_column">
      <img src="/acme/images/recipes/soup.jpg" alt="soup"><a href=URL(https://www.allrecipes.com/recipe/26460/quick-and-easy-chicken-noodle-soup/)><br>Roadrunner Soup</a>
      </div>
        <div class="sub_column">
            <img src="/acme/images/recipes/taco.jpg" alt="tacos"><a href=URL(https://www.allrecipes.com/recipe/37906/chicken-tacos/)><br>Roadrunner Tacos</a>
          </div>
      
        </div>
    </div>
  <div class="column">
    <h2>Acme Rocket Reviews</h2>
      <p></p>
    <ul>
    <li>"I don't know how I ever caught roadrunners before this." (4/5)</li>
    <li>"That thing was fast!" (4/5)</li>
    <li>"Talk about fast delivery." (5/5)</li>
    <li>"I didn't even have to pull the meat apart." (4.5/5)</li>
    <li>"I'm on my thirtieth one. I love these things!" (5/5)</li>
  </ul>
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
