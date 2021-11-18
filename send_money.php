<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Transaction Status</title>
  </head>
  <body>
  <?php
  session_start();
  include 'database/_nav.php';
  $name = $_SESSION["name"];
  $current_balance = $_SESSION["balance"];
   
  if($_SERVER["REQUEST_METHOD"] == "POST"){
  $transfer_amount = $_POST["amount"];
  $sender_balance = $_SESSION["sender_balance"];
  $sender_name = $_SESSION["sender_name"];
}
?>

<?php

include 'database/_dbconnect.php';

if($transfer_amount == 0 || $transfer_amount == null){
  echo '<div class="alert alert-danger" role="alert">
  Please Enter a Valid Amount..
  </div>';
  // $transfer_amount = 0;
  
}elseif($transfer_amount > $sender_balance) {
  echo '<div class="alert alert-danger" role="alert">
  Insufficient Balance..
  </div>';
}
else{
  // echo $name . "<br>";
  // echo $current_balance . "<br>";
  // echo $transfer_amount . "<br>";
  // echo $updated_amount . "<br>";
  
  
  $updated_amount = $current_balance + $transfer_amount;
  $senders_updated_balance = $sender_balance - $transfer_amount;
  // echo $senders_updated_balance;

  
  $sql = "update `customers` set current_balance='$updated_amount' where name='$name'";
  $sql2 = "insert into `transfers` (`sender`,`recipient`,`amount`) VALUES ('$sender_name','$name','$transfer_amount')";
  $sql3 =  "update `customers` set current_balance='$senders_updated_balance' where name='$sender_name'";
    $result = mysqli_query($conn,$sql);
    // $num = mysqli_num_rows($result);
    $result2 = mysqli_query($conn,$sql2);
    $result3 = mysqli_query($conn,$sql3);
    if($result2){
         
      echo '<div class="alert alert-success mt-5" role="alert">
      <h4 class="alert-heading">Success!<h4>
      <p>Your Transaction of '. $transfer_amount .' Rupees with '. $name.' has been Successful.</p>
      <hr>';
      ?>
      
      <a href="transaction_history.php"><p>See Transaction History</p></a>
    <?php
    echo '</div>';
    // header( "refresh:3;url=index.php" );

    }else {
      echo '<div class="alert alert-danger" role="alert">
        Some Error Occured..  
      </div>';
    }

  }

// $user = $_POST['user'];

// if($user == null) {
//   echo '<div class="alert alert-danger" role="alert">
//     Please Enter Reciepents Name To Continue..
// </div>';
// }else {
    
// $sql = "select * from `customers` where name = '$user'";
// $result = mysqli_query($conn,$sql);
// $num = mysqli_num_rows($result);
// //  echo $num;

//       if($num == 0){
//         echo "No Records Found.";
//       }else {
//         echo $num ." Records Found.";
//         echo "<br>";
//        while ($data = mysqli_fetch_array($result)){

//       echo "Name : ". $data["name"];
//       echo "<br>";
//       echo "Email : ". $data["email"];
//       echo "<br>";
//       echo "Available Balance : ". $data["current_balance"];
      
//       //while ends here
//       }
//       echo "<br>";
//       echo "<br>";
//       echo "<h4 class=amount>Enter Amount</h4>";
//       echo '<div class="input-group mt-4">
//       <span class="input-group-text">₹</span>
//       <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
//       <span class="input-group-text">.00</span>
//     </div>';
    
    
//        //else  ends here
//     }   
 
// }


?>



    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
  </body>
</html>

