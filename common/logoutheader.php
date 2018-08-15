<div class="logo"><a href="/acme/index.php"><img src="/acme/images/site/logo.gif" alt="ACME logo"></a></div>
        <div class="logo2">
          <?php
            $clientData =$_SESSION['clientData']; 
?>
         <a href="/acme/accounts/index.php?action=goToAdmin" style="text-decoration: none;"><p>Welcome | <?php echo $clientData['clientFirstname'];?></p></a>
            <a href="/acme/accounts/index.php?action=logout" style="text-decoration: none;"><p>Logout</p></a>
             
    </div>