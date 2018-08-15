<?php

/* 
 * This is the reviews model
 */

// Add review information to the database table
function addReview($reviewText, $invId, $clientId) {
 $db = acmeConnect();
 $today = date("Y-m-d h:i:s");
  $sql = 'INSERT INTO reviews (reviewText, reviewDate, invId, clientId) VALUES (:reviewText, :reviewDate, :invId, :clientId)';
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':reviewText', $reviewText, PDO::PARAM_STR);
  $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
  $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
  $stmt->bindValue(':reviewDate', $today, PDO::PARAM_STR);
    $stmt->execute();
    
    $rowsChanged = $stmt->rowCount();
    
     $stmt->closeCursor();

      return $rowsChanged;

}


// Get review information from reviews table
function getReviews() {
 $db = acmeConnect();
 $sql = 'SELECT reviewId, reviewText, reviewDate, inventory.invId, clients.clientId FROM reviews JOIN inventory on reviews.invId = inventory.invId JOIN clients ON reviews.clientId = clients.clientId';
 $stmt = $db->prepare($sql);
 $stmt->execute();
 $reviewArray = $stmt->fetchAll(PDO::FETCH_ASSOC);
 $stmt->closeCursor();
 return $reviewArray; 

}

function updateReview($reviewId, $reviewText, $reviewDate, $clientId) {
  $db = acmeConnect();
  $sql = 'UPDATE reviews SET reviewText = :reviewText, reviewDate = :reviewDate, clientId = :clientId WHERE reviewId = :reviewId';
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
  $stmt->bindValue(':reviewText', $reviewText, PDO::PARAM_STR);
    $stmt->bindValue(':reviewDate', $reviewDate, PDO::PARAM_STR);
  $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
  $stmt->execute();
  $rowsChanged = $stmt->rowCount();
  $stmt->closeCursor();
  return $rowsChanged;
}


// Deleting review information from the reviews table
function deleteReview($reviewId) {
 $db = acmeConnect();
 $sql = 'DELETE FROM reviews WHERE reviewId = :reviewId';
 $stmt = $db->prepare($sql);
 $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
 $stmt->execute();
 $result = $stmt->rowCount();
 $stmt->closeCursor();
 return $result;
}


function getInvIdByName($invName) {
 $db = acmeConnect();
 $sql = 'SELECT invId FROM inventory WHERE invName = :invName';
 $stmt = $db->prepare($sql);
 $stmt->bindValue(':invName', $invName, PDO::PARAM_STR);
 $stmt->execute();
 $invInfo = $stmt->fetch(PDO::FETCH_ASSOC);
 $stmt->closeCursor();
 
 return $invInfo;
}

function getReviewsById($invId) {
$db = acmeConnect();
$sql = 'SELECT rev.reviewText, rev.reviewDate, cl.clientFirstname, cl.clientLastname FROM reviews AS rev INNER JOIN inventory AS inv ON rev.invId = inv.invId INNER JOIN clients AS cl ON rev.clientId = cl.clientId WHERE rev.invId = :invId ORDER BY rev.reviewDate DESC';
 $stmt = $db->prepare($sql);
 $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);

 $stmt->execute();
 $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);
 $stmt->closeCursor();
 return $reviews;


}


function getReviewBasics($clientId) {
 $db = acmeConnect();
$sql = 'SELECT rev.reviewId, rev.reviewText, rev.reviewDate, inv.invName 
FROM reviews AS rev 
INNER JOIN clients AS cl ON
rev.clientId = cl.clientId 
INNER JOIN inventory AS inv ON
rev.invId = inv.invId
WHERE rev.clientId = :clientId';
 $stmt = $db->prepare($sql);
 $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
 $stmt->execute();
 $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);
 $stmt->closeCursor();
 return $reviews;

}

function getReviewInfo($reviewId) {
 $db = acmeConnect();
 $sql = 'SELECT * FROM reviews WHERE reviewId = :reviewId';
 $stmt = $db->prepare($sql);
 $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_STR);
 $stmt->execute();
 $reviewInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);
 $stmt->closeCursor();
 return $reviewInfo;
}


function getInvIdByReview($reviewId) {
  $db = acmeConnect();
  $sql = 'SELECT invId FROM reviews WHERE reviewId = :reviewId';
   $stmt = $db->prepare($sql);
 $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
$stmt->execute();
 $invId = $stmt->fetchAll(PDO::FETCH_ASSOC);
 $stmt->closeCursor();
 return $invId;

}


