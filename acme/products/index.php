<?php

/* Products Controller */


// Create or access a Session
 session_start();

 
 // require statements
require_once '../library/connections.php';
require_once '../model/acme-model.php';

/* Getting the products model */

require_once '../model/products-model.php';

/* Getting the functions library*/

 require_once '../library/functions.php';
 require_once '../model/uploads-model.php';
 require_once '../model/reviews-model.php';



// Get the array of categories
	$categories = getCategories();
  
  //var_dump($categories);
  //exit;

  
 // Build a navigation bar using the $categories array
  $navList = buildNav();
  
 /*$navList = '<ul>';
 $navList .= "<li><a href='/acme/index.php' title='View the Acme home page'>Home</a></li>";
 foreach ($categories as $category) {
  $navList .= "<li><a href='/acme/index.php?action=".urlencode($category['categoryName'])."' title='View our $category[categoryName] product line'>$category[categoryName]</a></li>";
 }
 $navList .= '</ul>'; */

//echo $navList;
//exit;
 
 
/*$catList = '<select name="categoryId">';
$catList .= '<option selected="selected">Category</option>';
foreach ($categories as $category) {
 $catList .= "<option value=".urlencode($category['categoryId']).">$category[categoryName]</option>";
 
 
}

$catList .= '</select>';*/

$action = filter_input(INPUT_POST, 'action');
 if ($action == NULL){
  $action = filter_input(INPUT_GET, 'action');
 }

switch ($action) {
 case '':
  $products = getProductBasics();
  if(count($products) > 0){
  $prodList = '<table>';
  $prodList .= '<thead>';
  $prodList .= '<tr><th>Product Name</th><td>&nbsp;</td><td>&nbsp;</td></tr>';
  $prodList .= '</thead>';
  $prodList .= '<tbody>';
  foreach ($products as $product) {
   $prodList .= "<tr><td>$product[invName]</td>";
   $prodList .= "<td><a style='text-decoration: none;' href='/acme/products?action=mod&id=$product[invId]' title='Click to modify'>Modify</a></td>";
   $prodList .= "<td><a style='text-decoration: none;' href='/acme/products?action=del&id=$product[invId]' title='Click to delete'>Delete</a></td></tr>";
  }
   $prodList .= '</tbody></table>';
  } else {
   $message = '<p class="notify">Sorry, no products were returned.</p>';
}
  include '../view/prod-mgmt.php';
  break;
 case 'new-cat':
  include '../view/new-cat.php';
 break;
 case 'new-prod':
  include '../view/new-prod.php';
  break;
 case 'addCategory':
  $categoryName = filter_input(INPUT_POST, 'categoryName', FILTER_SANITIZE_STRING);
  
  
  if(empty($categoryName)) {
   $message = '<p style="color: red;"'
         . '>***Please enter category name***</p>';
   include '../view/new-cat.php';
   exit;
  }
  
  
  // send data to the model
  $categoryOutcome = addNewCategory($categoryName);
  
  // check and report the result
  if($categoryOutcome === 1) {
   header('Location: index.php');
   exit;
  } else {
   $message = "<p>Sorry, $categoryName couldn't be added.</p>";
   include '../view/new-cat.php';
  }
  break;
 case 'addProduct':
  // Filter and store the data
  $categoryIdString = filter_input(INPUT_POST, 'categoryId');
  $categoryId = (int)$categoryIdString;
  $invName = filter_input(INPUT_POST, 'invName', FILTER_SANITIZE_STRING);
  $invDescription = filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING);
  $invImage = filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_STRING);
  $invThumbnail = filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_STRING);
  $invPriceString = filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
  $invPrice = (float)$invPriceString;
  $invStockString = filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_STRING);
  $invStock = (int)$invStockString;
  $invSizeString = filter_input(INPUT_POST, 'invSize', FILTER_SANITIZE_STRING);
  $invSize = (int)$invSizeString;
  $invWeightString = filter_input(INPUT_POST, 'invWeight', FILTER_SANITIZE_STRING);
  $invWeight = (int)$invWeightString;
  $invLocation = filter_input(INPUT_POST, 'invLocation', FILTER_SANITIZE_STRING);
  $invVendor = filter_input(INPUT_POST, 'invVendor', FILTER_SANITIZE_STRING);
  $invStyle = filter_input(INPUT_POST, 'invStyle', FILTER_SANITIZE_STRING);
  
  
  $invPrice = checkInvPrice($invPrice);
  $invStock = checkInvStock($invStock);
  $invSize = checkInvSize($invSize);
  $invWeight = checkInvWeight($invWeight);
  
  
 
          
  // check for missing stuff
  if (empty($categoryId) || empty($invName) || empty($invDescription) || empty($invImage) || empty($invThumbnail) || empty($invPrice) || empty($invStock) || empty($invSize) || empty($invWeight) || empty($invLocation) || empty($invVendor) || empty($invStyle)) {
   $message = '<p style="color: red;"'
         . '>***Please provide the correct information for all entries***</p>';
   include '../view/new-prod.php';
   exit;
  }
  
  // Send the data to the model
  $productOutcome = addNewProduct($invName, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invSize, $invWeight, $invLocation, $categoryId, $invVendor, $invStyle);

  // check and report the result
if($productOutcome === 1) {
$message = "<p>Your product: $invName  was added successfully</p>";
include '../view/new-prod.php';
echo $categoryId, $invName, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invSize, $invWeight, $invLocation, $invVendor, $invStyle;
 exit;
 
  } else {
   $message = "<p>Sorry, $invName couldn't be added.</p>";
   include '../view/new-prod.php';
   exit;
  }
  break;
 case 'mod';
  $invId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
  $prodInfo = getProductInfo($invId);
  if(count($prodInfo)<1){
  $message = 'Sorry, no product information could be found.';
 }
 include '../view/prod-update.php';
 exit;
  break;
 case 'updateProd':
  $categoryIdString = filter_input(INPUT_POST, 'categoryId');
  $categoryId = (int)$categoryIdString;
  $invName = filter_input(INPUT_POST, 'invName', FILTER_SANITIZE_STRING);
  $invDescription = filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING);
  $invImage = filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_STRING);
  $invThumbnail = filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_STRING);
  $invPriceString = filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
  $invPrice = (float)$invPriceString;
  $invStockString = filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_STRING);
  $invStock = (int)$invStockString;
  $invSizeString = filter_input(INPUT_POST, 'invSize', FILTER_SANITIZE_STRING);
  $invSize = (int)$invSizeString;
  $invWeightString = filter_input(INPUT_POST, 'invWeight', FILTER_SANITIZE_STRING);
  $invWeight = (int)$invWeightString;
  $invLocation = filter_input(INPUT_POST, 'invLocation', FILTER_SANITIZE_STRING);
  $invVendor = filter_input(INPUT_POST, 'invVendor', FILTER_SANITIZE_STRING);
  $invStyle = filter_input(INPUT_POST, 'invStyle', FILTER_SANITIZE_STRING);
  $invIdString = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
  $invId = (int)$invIdString;
  

   // check for missing stuff
  if (empty($categoryId) || empty($invName) || empty($invDescription) || empty($invImage) || empty($invThumbnail) || empty($invPrice) || empty($invStock) || empty($invSize) || empty($invWeight) || empty($invLocation) || empty($invVendor) || empty($invStyle)) {
   $message = '<p style="color: red;"'
         . '>***Please provide the correct information for all entries***</p>';
   echo $categoryId, $invName, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invSize, $invWeight, $invLocation, $invVendor, $invStyle, $invId;
   include '../view/prod-update.php';
   exit;
  }
  
 // Send the data to the model
  $updateResult = updateProduct($categoryId, $invName, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invSize, $invWeight, $invLocation,  $invVendor, $invStyle, $invId);

  // check and report the result
if($updateResult) {
$message = "<p class='notice'>Congratulations, $invName was successfully updated.</p>";
 $_SESSION['message'] = $message;
 header('location: /acme/products/');
 exit;
  } else {
   $message = "<p class='notice'>Error! The new product was not updated.</p>";
    include '../view/prod-update.php';
 exit;
  }
  break;
 case 'del':
  $invId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
 $prodInfo = getProductInfo($invId);
 if (count($prodInfo) < 1) {
  $message = 'Sorry, no product information could be found.';
 }
 include '../view/prod-delete.php';
 exit;
 break;
 case 'deleteProd':
   $invName = filter_input(INPUT_POST, 'invName', FILTER_SANITIZE_STRING);
  $invIdString = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
  $invId = (int)$invIdString;
  
  
  $deleteResult = deleteProduct($invId);
 if ($deleteResult) {
  $message = "<p class='notice'>Congratulations, $invName was successfully deleted.</p>";
  $_SESSION['message'] = $message;
  header('location: /acme/products/');
  exit;
 } else {
  $message = "<p class='notice'>Error: $invName was not deleted.</p>";
  $_SESSION['message'] = $message;
  header('location: /acme/products/');
  exit;
 }
  break;
 case 'category':
  $categoryName = filter_input(INPUT_GET, 'categoryName', FILTER_SANITIZE_STRING);
 $products = getProductsByCategory($categoryName);
 if(!count($products)){
  $message = "<p class='notice'>Sorry, no $categoryName products could be found.</p>";
 } else {
  $prodDisplay = buildProductsDisplay($products);
 }
 include '../view/category.php';
  break;
 case 'viewProduct':
 $invId = filter_input(INPUT_GET, 'invId', FILTER_SANITIZE_STRING);
 $invName = filter_input(INPUT_GET, 'invName', FILTER_SANITIZE_STRING);
 $products = getProductsById($invId, $invName);
 $productThumbnail = getThumbnail($invId);

 $reviews = getReviewsById($invId);
 
 
if(!count($products)){
 $message = "<p class='notice'>Sorry, no products could be found.</p>";
} else {
 $prodDetailDisplay = buildDetailDisplay($products);
 $prodThumbailDisplay = buildThumbnailDisplay($productThumbnail);
 $allReviewsDisplay = buildReviewDisplay($reviews);
}
  include '../view/product-detail.php';
  break;
 default:
   include '../view/prod-mgmt.php';
  }
  
 

