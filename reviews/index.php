<?php

/* Reviews Controller */


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
  

$action = filter_input(INPUT_POST, 'action');
 if ($action == NULL){
  $action = filter_input(INPUT_GET, 'action');
 }
 
 switch ($action) {
 case 'addReview':
  // Store the incoming reviewText, invId, and clientId, 
 $reviewText = filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_STRING);
  
 $invName = $_SESSION['invInfo'] ;
 $clientData = $_SESSION['clientData'];
 $clientId = (int) $clientData['clientId'];
 $invInfo = getInvIdByName($invName);
 $invId = (int) $invInfo['invId'];
 
 
 if(empty($reviewText)) {
  $message = '<p style="color: red;"'
         . '>***Please provide information for your review.***</p>';
 $products = getProductsById($invId, $invName);
 $productThumbnail = getThumbnail($invId);
 $reviews = getReviewsById($invId, $clientId);
 
if(!count($products)){
 $message = "<p class='notice'>Sorry, no products could be found.</p>";
} else {
 $prodDetailDisplay = buildDetailDisplay($products);
 $prodThumbailDisplay = buildThumbnailDisplay($productThumbnail);
 $allReviewsDisplay = buildReviewDisplay($reviews);
}
  include '../view/product-detail.php';
  exit;
 }
 // Send the review to the review-model to add to databse
  $reviewOutcome = addReview($reviewText, $invId, $clientId);
  // Set a message based on the insert result
  if($reviewOutcome) {
    $message = '<p style="color: green;"'
         . '>Thanks for the review. It is displayed below.</p>';
  } else {
    $message = '<p style="color: red;"'
         . '>Sorry, your review could not be posted.</p>';
  }
  
 $products = getProductsById($invId, $invName);
 $productThumbnail = getThumbnail($invId);
 // Create variable for $reviews. Should be getting invId, clientId, reviewText and.... maybe reviewDate
 $reviews = getReviewsById($invId, $clientId);
 
if(!count($products)){
 $message = "<p class='notice'>Sorry, no products could be found.</p>";
} else {
 $prodDetailDisplay = buildDetailDisplay($products);
 $prodThumbailDisplay = buildThumbnailDisplay($productThumbnail);
 $allReviewsDisplay = buildReviewDisplay($reviews);
}
  include '../view/product-detail.php';
 break;
 case 'deleteReview':
 
  break;
  default:
   include '../view/admin.php';
   break;
   
 }
