<?php

/* Accounts Controller */


// Create or access a Session
 session_start();
 
 
// Require statements
require_once '../library/connections.php';

require_once '../model/acme-model.php';

/* Getting the accounts model */

require_once '../model/accounts-model.php';

/* Getting the functions library*/

 require_once '../library/functions.php';
 
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
 
 if(isset($_COOKIE['firstname'])){
 $cookieFirstname = filter_input(INPUT_COOKIE, 'firstname', FILTER_SANITIZE_STRING);
}


$action = filter_input(INPUT_POST, 'action');
 if ($action == NULL){
  $action = filter_input(INPUT_GET, 'action');
 }

switch ($action) {
 case 'logout':
  session_destroy();
  $_SESSION = array();
  include '../model/home.php';
  break;
 case 'login':
  include '../view/login.php';
  break;
 case 'registration':
  include '../view/registration.php';
 break;
 case 'register':
  // Filter and store the data
$clientFirstname = filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING);
$clientLastname = filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING);
$clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
$clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);

// Checking for an existing email address 
$existingEmail = checkExistingEmail($clientEmail);

// Check for existing email address in the table
if($existingEmail){
 $message = '<p class="notice" style="color: red;">That email address already exists. Do you want to login instead?</p>';
 include '../view/login.php';
 exit;
}

$clientEmail = checkEmail($clientEmail);
$checkPassword = checkPassword($clientPassword);



 // Check for missing data
 if (empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($checkPassword)) {
 $message = '<p style="color: red;"'
         . '>***Please provide information for all empty form fields.***</p>';
 include '../view/registration.php';
 exit; 
}

// Hash the checked password
$hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);

// Send the data to the model
$regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $hashedPassword);


// Check and report the result
if($regOutcome === 1){
 
  setcookie('firstname', $clientFirstname, strtotime('+1 year'), '/');
  
 $_SESSION['message'] = "Thanks for registering $clientFirstname. Please use your email and password to login.";
header('Location: /acme/accounts/?action=login');
 exit;
 
} else {
 $message = "<p>Sorry $clientFirstname, but the registration failed. Please try again.</p>";
 include '../view/registration.php';
 exit;
}
break;

 case 'Login': 
$clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
$clientEmail = checkEmail($clientEmail);
$clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);
$passwordCheck = checkPassword($clientPassword);

// Run basic checks, return if errors
if (empty($clientEmail) || empty($passwordCheck)) {
 $message = '<p class="notice">Please provide a valid email address and password.</p>';
 include '../view/login.php';
 exit;
}
  
// A valid password exists, proceed with the login process
// Query the client data based on the email address
$clientData = getClient($clientEmail);
// Compare the password just submitted against
// the hashed password for the matching client
$hashCheck = password_verify($clientPassword, $clientData['clientPassword']);
// If the hashes don't match create an error
// and return to the login view
if(!$hashCheck) {
  $message = '<p class="notice">Please check your password and try again.</p>';
  include '../view/login.php';
  exit;
}

// A valid user exists, log them in
$_SESSION['loggedin'] = TRUE;
// Remove the password from the array
// the array_pop function removes the last
// element from an array

array_pop($clientData);
// Store the array into the session
$_SESSION['clientData'] = $clientData;
$clientId = (int) $clientData['clientId'];
$reviews = getReviewBasics($clientId);
$adminReviewDisplay = buildRevAdminDisplay($reviews);
// Send them to the admin view
include '../view/admin.php';
exit;
break;
 case 'goToAdmin':
  // A valid user exists, log them in
$_SESSION['loggedin'] = TRUE;

// Store the array into the session
$clientData = $_SESSION['clientData'];
$clientId = (int) $clientData['clientId'];
$reviews = getReviewBasics($clientId);
$adminReviewDisplay = buildRevAdminDisplay($reviews);
// Send them to the admin view
include '../view/admin.php';
exit;
break;

 case 'client-update':
   $clientId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
  $clientInfo = getClientInfo($clientId);
include '../view/client-update.php';
  break;
 case 'updateAccount':
  // Filter and store the data
$clientFirstname = filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING);
$clientLastname = filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING);
$clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
$clientIdString = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_STRING);
$clientId = (int)$clientIdString;

 if (empty($clientFirstname) || empty($clientLastname) || empty($clientEmail)) {
 $message = '<p style="color: red;"'
         . '>***Please provide information for all empty form fields.***</p>';
 echo $clientFirstname, $clientLastname, $clientEmail;
 include '../view/client-update.php';
 exit; 
 }
 
 // send the data to the model
 $updateAccountResult = updateAccount($clientFirstname, $clientLastname, $clientEmail, $clientId);
 
 // check and report the result
 if($updateAccountResult) {
  $message = "<p class='notice'>$clientFirstname, your update was successful.</p>";
 $clientData = getClient($clientEmail);
 $_SESSION['clientData'] = $clientData;
include '../view/admin.php';
 exit;
  } else {
   $message = "<p class='notice'>Error! $clientFirstname, your changes could not be made.</p>";
    include '../view/admin.php';
 exit;
  }
  break;
 case 'updatePassword':
  $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);
  $clientIdString = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_STRING);
$clientId = (int)$clientIdString;
  
  $checkPassword = checkPassword($clientPassword);

 // Check for missing data
 if (empty($checkPassword)) {
 $message = '<p style="color: red;"'
         . '>***Please provide information for all empty form fields.***</p>';
 include '../view/client-update.php';
 exit; 
}

// Hash the checked password
$hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);
$updatePasswordResult = updatePassword($hashedPassword, $clientId);
if($updatePasswordResult) {
 $message = "<p class='notice'>Your password was updated successful.</p>";
  $clientData = getClientInfo($clientId);
 $_SESSION['clientData'] = $clientData;
include '../view/admin.php';
 exit;
  } else {
   $message = "<p class='notice'>Error! Your password could not be updated.</p>";
    include '../view/admin.php';
 exit;
  }
  break;
 case 'mod':
  $reviewId = filter_input(INPUT_GET, 'reviewId', FILTER_VALIDATE_INT);
  $reviewDate = filter_input(INPUT_GET, 'reviewDate', FILTER_SANITIZE_STRING);
  $reviewText = filter_input(INPUT_GET, 'reviewText', FILTER_SANITIZE_STRING);
  $invName = filter_input(INPUT_GET, 'invName', FILTER_SANITIZE_STRING);
   $reviewInfo = getReviewInfo($reviewId, $reviewDate, $reviewText);
  if (count($reviewInfo) < 1) {
   $message = 'Sorry, no review information could be found.';
  }
  include '../view/review-update.php';
  exit;
  break;
 case 'updateReview':
   $reviewId = filter_input(INPUT_POST, 'reviewId', FILTER_SANITIZE_NUMBER_INT);
  $reviewText = filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_STRING);
  $reviewDate = filter_input(INPUT_POST, 'reviewDate', FILTER_SANITIZE_STRING);
  $clientData = $_SESSION['clientData'];
  $clientId = (int) $clientData['clientId'];
 
 
 if(empty($reviewId) || empty($reviewText) || empty($reviewDate) || empty($clientId)) {
  $message = '<p style="color: red;"'
         . '>***Please provide information for your review.***</p>';
  include '../view/review-update.php';
  exit;
 }
 
  $updateResult = updateReview($reviewId, $reviewText, $reviewDate, $clientId);
  if($updateResult) {
  $message ='<p style="color: green;"'
         . '>Your review was successfully updated.</p>';
  $clientData = $_SESSION['clientData'];
  $clientId = (int) $clientData['clientId'];
  $reviews = getReviewBasics($clientId);
  $adminReviewDisplay = buildRevAdminDisplay($reviews);
include  '../view/admin.php';
 exit;
 } else {
  $message = '<p style="color: red;"'
         . '>Error: <br>Either you have refreshed the page and the current review ID was successfully deleted and could not be found. Or there was an error processing your request at this time.</p>';
  $clientData = $_SESSION['clientData'];
  $clientId = (int) $clientData['clientId'];
  $reviews = getReviewBasics($clientId);
  $adminReviewDisplay = buildRevAdminDisplay($reviews);
include  '../view/admin.php';
 exit;
 }
  break;
 case 'del':
  $reviewId = filter_input(INPUT_GET, 'reviewId', FILTER_VALIDATE_INT);
  $reviewDate = filter_input(INPUT_GET, 'reviewDate', FILTER_SANITIZE_STRING);
  $reviewText = filter_input(INPUT_GET, 'reviewText', FILTER_SANITIZE_STRING);
  $invName = filter_input(INPUT_GET, 'invName', FILTER_SANITIZE_STRING);
  $reviewInfo = getReviewInfo($reviewId, $reviewDate, $reviewText);
  if (count($reviewInfo) < 1) {
   $message = 'Sorry, no review information could be found.';
  }
  include '../view/review-delete.php';
  exit;
  break;
 case 'deleteReview':
  $reviewIdString = filter_input(INPUT_POST, 'reviewId', FILTER_SANITIZE_NUMBER_INT);
  $reviewId = (int)$reviewIdString;
  
  $deleteResult = deleteReview($reviewId);
  if ($deleteResult) {
  $message ='<p style="color: green;"'
         . '>Your review was successfully deleted.</p>';
  $clientData = $_SESSION['clientData'];
  $clientId = (int) $clientData['clientId'];
  $reviews = getReviewBasics($clientId);
  $adminReviewDisplay = buildRevAdminDisplay($reviews);
include  '../view/admin.php';
 exit;
 } else {
  $message = '<p style="color: red;"'
         . '>Error: <br>Either you have refreshed the page and the current review ID was successfully deleted and could not be found. Or there was an error processing your request at this time.</p>';
  $clientData = $_SESSION['clientData'];
  $clientId = (int) $clientData['clientId'];
  $reviews = getReviewBasics($clientId);
  $adminReviewDisplay = buildRevAdminDisplay($reviews);
include  '../view/admin.php';
 exit;
 }
  break;
 
 default: 
 
  break;
}




