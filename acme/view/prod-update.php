<?php
$clientData = $_SESSION['clientData'];
 if($clientData['clientLevel'] < '2')
  {
   header ('Location: /acme/index.php');
   exit();
  }
$catList = '<select name="categoryId" id="categoryId">';
$catList .= "<option>Choose a Category</option>";
foreach ($categories as $category) {
 $catList .= "<option value='$category[categoryId]'";
  if(isset($categoryId)){
   if($category['categoryId'] === $categoryIdString){
   $catList .= ' selected ';
  }
 } elseif(isset($prodInfo['categoryId'])){
  if($category['categoryId'] === $prodInfo['categoryId']){
   $catList .= ' selected ';
  }
}
$catList .= ">$category[categoryName]</option>";
}
$catList .= '</select>';
?>
<!DOCTYPE html><
<html lang="en">
<head>
<title><?php if(isset($prodInfo['invName'])){ echo "Modify $prodInfo[invName] ";} elseif(isset($invName)) { echo $invName; }?> | Acme</title>
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
<h2><?php if(isset($prodInfo['invName'])){ echo "Modify $prodInfo[invName] ";} elseif(isset($invName)) { echo $invName; }?></h2>
    <div class="form">
     
      <?php
         if (isset($message)) {
           echo $message; }
     ?>
    
     
    <form method="post" action="/acme/products/index.php">
  <fieldset>
    <legend>Product</legend>
    <h4>Modify a product below. All fields are required!</h4><br>
    Select a Category <br>
    <?php echo $catList; ?>
    <br>
    <br>
    
    Product name<br>
    <input type="text" name="invName" id="invName" <?php if(isset($invName)){ echo "value='$invName'"; } elseif(isset($prodInfo['invName'])) {echo "value='$prodInfo[invName]'"; }?> required><br><br>
    
    
    Product Description<br>
    <textarea name="invDescription" id="invDescription" required>
<?php if(isset($invDescription)){ echo $invDescription; }
elseif(isset($prodInfo['invDescription'])) {echo $prodInfo['invDescription']; }?>
</textarea><br><br>
    
    
     Product Image (path to image)<br>
    <input type="text" name="invImage" id="invImage" <?php if(isset($invImage)){ echo "value='$invImage'"; } elseif(isset($prodInfo['invImage'])) {echo "value='$prodInfo[invImage]'"; }?> required><br><br>
    
    
     Product Thumbnail (path to thumbnail)<br>
    <input type="text" name="invThumbnail" id="invThumbnail" <?php if(isset($invThumbnail)){ echo "value='$invThumbnail'"; } elseif(isset($prodInfo['invThumbnail'])) {echo "value='$prodInfo[invThumbnail]'"; }?> required><br><br>
    
    
     Product Price<br>
     <input type="text" name="invPrice" id="invPrice" <?php if(isset($invPrice)){ echo "value='$invPrice'"; } elseif(isset($prodInfo['invPrice'])) {echo "value='$prodInfo[invPrice]'"; }?> required><br><br>
     
     
     Amount in Stock<br>
    <input type="text" name="invStock" id="invStock" <?php if(isset($invStock)){ echo "value='$invStock'"; } elseif(isset($prodInfo['invStock'])) {echo "value='$prodInfo[invStock]'"; }?> required><br><br>
    
    
     Shipping Size (W x H x L in inches)<br>
    <input type="text" name="invSize" id="invSize" <?php if(isset($invSize)){ echo "value='$invSize'"; } elseif(isset($prodInfo['invSize'])) {echo "value='$prodInfo[invSize]'"; }?> required><br><br>
    
    
     Weight(lbs.)<br>
    <input type="text" name="invWeight" id="invWeight" <?php if(isset($invWeight)){ echo "value='$invWeight'"; } elseif(isset($prodInfo['invWeight'])) {echo "value='$prodInfo[invWeight]'"; }?> required><br><br>
    
    
     Location (city name)<br>
    <input type="text" name="invLocation" id="invLocation" <?php if(isset($invLocation)){ echo "value='$invLocation'"; } elseif(isset($prodInfo['invLocation'])) {echo "value='$prodInfo[invLocation]'"; }?> required><br><br>
    
    
     Vendor Name<br>
    <input type="text" name="invVendor" id="invVendor" <?php if(isset($invVendor)){ echo "value='$invVendor'"; } elseif(isset($prodInfo['invVendor'])) {echo "value='$prodInfo[invVendor]'"; }?> required><br><br>
    
    
     Primary Material<br>
    <input type="text" name="invStyle" id="invStyle" <?php if(isset($invStyle)){ echo "value='$invStyle'"; } elseif(isset($prodInfo['invStyle'])) {echo "value='$prodInfo[invStyle]'"; }?> required><br><br>
    
    
    <input type="submit" value="Update Product"><br>
    <!-- Add the action name - value pair -->
    <input type="hidden" name="action" value="updateProd">
    <input type="hidden" name="invId" value="<?php if(isset($prodInfo['invId'])){ echo $prodInfo['invId'];} elseif(isset($invId)){ echo $invId; } ?>">
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