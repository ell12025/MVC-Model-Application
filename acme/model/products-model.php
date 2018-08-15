<?php

/* 
 * This is the product model for inserting new Product
 */
function addNewProduct($invName, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invSize, $invWeight, $invLocation, $categoryId, $invVendor, $invStyle){
 // Create a connection object using the acme connection function
 $db = acmeConnect();
 
 
 // The SQL statement
 $sql = 'INSERT INTO inventory (invName, invDescription, invImage, invThumbnail, invPrice, invStock, invSize, invWeight, invLocation, categoryId, invVendor, invStyle)
  VALUES (:invName, :invDescription, :invImage, :invThumbnail, :invPrice, :invStock, :invSize, :invWeight, :invLocation, :categoryId, :invVendor, :invStyle)';
 
 
 // Create the prepared statement using the acme connection
 $stmt = $db->prepare($sql);
 
 
 // The next four lines replace the placeholders in the SQL
 // statement with the actual values in the variables
 // and tells the database the type of data it is
 $stmt->bindValue(':categoryId', $categoryId, PDO::PARAM_STR);
 $stmt->bindValue(':invName', $invName, PDO::PARAM_STR);
 $stmt->bindValue(':invDescription', $invDescription, PDO::PARAM_STR);
 $stmt->bindValue(':invImage', $invImage, PDO::PARAM_STR);
 $stmt->bindValue(':invThumbnail', $invThumbnail, PDO::PARAM_STR);
 $stmt->bindValue(':invPrice', $invPrice, PDO::PARAM_STR);
 $stmt->bindValue(':invStock', $invStock, PDO::PARAM_STR);
 $stmt->bindValue(':invSize', $invSize, PDO::PARAM_STR);
 $stmt->bindValue(':invWeight', $invWeight, PDO::PARAM_STR);
 $stmt->bindValue(':invLocation', $invLocation, PDO::PARAM_STR);
 $stmt->bindValue(':invVendor', $invVendor, PDO::PARAM_STR);
 $stmt->bindValue(':invStyle', $invStyle, PDO::PARAM_STR);
 
 
 // Insert the data
 $stmt->execute();
 
 
 // Ask how many rows changed as a result of our insert
 $rowsChanged = $stmt->rowCount();
 
 
 // Close the database interaction
 $stmt->closeCursor();
 
 
 // Return the indication of success (rows changed)
 return $rowsChanged;
 
}






/* 
 * This is the product model for inserting a new category
 */
function addNewCategory($categoryName){
 // Create a connection object using the acme connection function
 $db = acmeConnect();
 
 
 // The SQL statement
 $sql = 'INSERT INTO categories (categoryName)
     VALUES (:categoryName)';
 
 
 // Create the prepared statement using the acme connection
 $stmt = $db->prepare($sql);
 
 
 // The next four lines replace the placeholders in the SQL
 // statement with the actual values in the variables
 // and tells the database the type of data it is
 $stmt->bindValue(':categoryName', $categoryName, PDO::PARAM_STR);
 
 
 
 // Insert the data
 $stmt->execute();
 
 
 // Ask how many rows changed as a result of our insert
 $rowsChanged = $stmt->rowCount();
 
 
 // Close the database interaction
 $stmt->closeCursor();
 
 
 // Return the indication of success (rows changed)
 return $rowsChanged;
 
}






/* 
 * The following function will get basic product information from the inventory table for starting an update or delete process. 
 */
function getProductBasics() {
 $db = acmeConnect();
 $sql = 'SELECT invName, invId FROM inventory ORDER BY invName ASC';
 $stmt = $db->prepare($sql);
 $stmt->execute();
 $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
 $stmt->closeCursor();
 return $products;
}





/* 
 * This function is selecting a single product based on its id
 */
function getProductInfo($invId){
 $db = acmeConnect();
 $sql = 'SELECT * FROM inventory WHERE invId = :invId';
 $stmt = $db->prepare($sql);
 $stmt->bindValue(':invId', $invId, PDO::PARAM_STR);
 $stmt->execute();
 $prodInfo = $stmt->fetch(PDO::FETCH_ASSOC);
 $stmt->closeCursor();
 return $prodInfo;
}

/* 
 * This is the update product function
 */
function updateProduct($categoryId, $invName, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invSize, $invWeight, $invLocation, $invVendor, $invStyle, $invId){
 // Create a connection object using the acme connection function
 $db = acmeConnect();
 
 
 // The SQL statement
 $sql = 'UPDATE inventory SET invName = :invName, invDescription = :invDescription, invImage = :invImage, invThumbnail = :invThumbnail, invPrice = :invPrice, invStock = :invStock, invSize = :invSize, invWeight = :invWeight, invLocation = :invLocation, categoryId = :categoryId, invVendor = :invVendor, invStyle = :invStyle WHERE invId = :invId';
 
 
 // Create the prepared statement using the acme connection
 $stmt = $db->prepare($sql);
 
 
 // The next four lines replace the placeholders in the SQL
 // statement with the actual values in the variables
 // and tells the database the type of data it is
 $stmt->bindValue(':invName', $invName, PDO::PARAM_STR);
 $stmt->bindValue(':invDescription', $invDescription, PDO::PARAM_STR);
 $stmt->bindValue(':invImage', $invImage, PDO::PARAM_STR);
 $stmt->bindValue(':invThumbnail', $invThumbnail, PDO::PARAM_STR);
 $stmt->bindValue(':invPrice', $invPrice, PDO::PARAM_STR);
 $stmt->bindValue(':invStock', $invStock, PDO::PARAM_STR);
 $stmt->bindValue(':invSize', $invSize, PDO::PARAM_STR);
 $stmt->bindValue(':invWeight', $invWeight, PDO::PARAM_STR);
 $stmt->bindValue(':invLocation', $invLocation, PDO::PARAM_STR);
 $stmt->bindValue(':categoryId', $categoryId, PDO::PARAM_STR);
 $stmt->bindValue(':invVendor', $invVendor, PDO::PARAM_STR);
 $stmt->bindValue(':invStyle', $invStyle, PDO::PARAM_STR);
 $stmt->bindValue(':invId', $invId, PDO::PARAM_STR);

 
 
 // Insert the data
 $stmt->execute();
 
 
 // Ask how many rows changed as a result of our insert
 $rowsChanged = $stmt->rowCount();
 
 
 // Close the database interaction
 $stmt->closeCursor();
 
 
 // Return the indication of success (rows changed)
 return $rowsChanged;
 
}

/* 
 * This function will carry out a product deletion
 */
function deleteProduct($invId) {
 // Create a connection object using the acme connection function
 $db = acmeConnect();
 
 
 // The SQL statement
 $sql = 'DELETE FROM inventory WHERE invId = :invId';
 
 
 // Create the prepared statement using the acme connection
 $stmt = $db->prepare($sql);
 
 
 // The next four lines replace the placeholders in the SQL
 // statement with the actual values in the variables
 // and tells the database the type of data it is
 $stmt->bindValue(':invId', $invId, PDO::PARAM_STR);

 
 
 // Insert the data
 $stmt->execute();
 
 
 // Ask how many rows changed as a result of our insert
 $rowsChanged = $stmt->rowCount();
 
 
 // Close the database interaction
 $stmt->closeCursor();
 
 
 // Return the indication of success (rows changed)
 return $rowsChanged;
 
}

// This new function will get a list of products based on the category
function getProductsByCategory($categoryName){
 $db = acmeConnect();
 $sql = 'SELECT * FROM inventory WHERE categoryId IN (SELECT categoryId FROM categories WHERE categoryName = :categoryName)';
 $stmt = $db->prepare($sql);
 $stmt->bindValue(':categoryName', $categoryName, PDO::PARAM_STR);
 $stmt->execute();
 $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
 $stmt->closeCursor();
 return $products;
}

// This new function will get a list of products based on the Id
function getProductsById($invId, $invName) {
 $db = acmeConnect();
 $sql = 'SELECT * FROM inventory WHERE categoryId IN (SELECT categoryId FROM categories WHERE invId = :invId)';
 $stmt = $db->prepare($sql);
 $stmt->bindValue(':invId', $invId, PDO::PARAM_STR);
 $stmt->execute();
 $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
 $stmt->closeCursor();
 return $products;
}





