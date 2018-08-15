 <?php 
$clientData =$_SESSION['clientData']; 
$clientFirstname = $clientData['clientFirstname'];
$clientLastname = $clientData['clientLastname'];
$clientInitial = substr($clientFirstname, 0, 1); ?>

<h4>Review the <?php echo $invName; ?></h4>
<form action="/acme/reviews/index.php" method="post">
 Screen Name: <br>
 <input style="background-color:white;" type="text" name="clientFirstname" id="clientFirstname" <?php if(isset($clientFirstname)){echo "value='$clientInitial$clientLastname'";}  ?> disabled><br><br>
 Review:<br>
 <textarea  name="reviewText" id="ReviewText" required></textarea><br><br>
 <input type="submit" value="Submit Review">
 <input type="hidden" name="action" value="addReview">
</form>
<br><br>