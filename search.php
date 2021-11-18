<?php
  session_start();
  $sends_money = $_SESSION["sends_money"];

   

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

<style>
 h3 {
   margin-top:40px;
 }
  .user_input {
      margin-top:30px;
  }
  .input {
    border:none;
    border-bottom:1px solid black;
    padding:10px;
    margin-top:20px;
  }
  .input::placeholder{
      letter-spacing:4px;
  }
  .btn {
  margin-top:30px;
  margin-left:30px;
  text-align:center;
}
button {
  background-color:black;
  color:white;
  padding:10px 20px;
  border-radius:8px;
  border:none;
  outline:none;
  margin-top:20px;
  margin-left:20px;
  margin-bottom:40px;
}
h6 {
  margin-left:40px;
  font-size:20px;
}
h5 {
  margin-left:40px;
  margin-bottom:40px;
}
h4 {
  margin-left:40px;
}
table {
  margin-left:40px;
  margin-top:40px;
}
table tr {
  border:1px solid black;
}
table tr td,th  {
  padding:14px;
  border-right:1px solid black;
}
.user {
  margin-top:30px;
  margin-left:40px;
}
.sender {
  border:none;
  border-bottom:1px solid black;
}
p {
  font-size:20px;
  margin-bottom:30px;
  margin-left:40px;

}
@media only screen and (max-width: 600px) {

table {
  margin-left:5px;
  font-size:12px;
  margin-right:5px;
}
table tr {
border:1px solid black;


}
table tr td,th  {
padding:4px;
border-right:1px solid black;

}
}


     </style>

    </style>

    <title> <?php echo $sends_money ?></title>
  </head>
  <body>
  <?php
      $run = false;
  include 'database/_nav.php';
  include 'database/_dbconnect.php';

  echo "<br>";
echo "<h6> Hello <b>". $sends_money. "</b></h6>";

$sql = "select * from customers";
$result = mysqli_query($conn,$sql);

?>
<div class="users">

<table>
  <tr>
  <th>Sl No.</th>
  <th>Name</th>
  <th>Email</th>
  <th>Balance</th>
</tr>

<?php
$i = 1;
while($row = mysqli_fetch_array($result)) {
 //not to display sender's name
  if($row["name"] == $sends_money){
    //to get senders current balance
    $_SESSION["sender_balance"] = $row["current_balance"];
    echo "<h6>Available Balance :<b> " .$_SESSION["sender_balance"]."</b></h6>";
    continue;
  }



?>
<tr>
    <td><?php echo $i; ?></td>
    <td><?php echo $row["name"]; ?></td>
     <td><?php echo $row["email"]; ?></td>
    <td><?php echo $row["current_balance"]; ?></td> 
  </tr>
<?php
$i++;
}
?>


</table>




<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){
  
  $user = $_POST['user'];


if($user == null) {
  echo '<div class="alert alert-danger" role="alert">
    Please Enter Reciepents Name To Continue..
</div>';
}else {
      $sql = "select * from `customers` where name = '$user'";
    $result = mysqli_query($conn,$sql);
    $num = mysqli_num_rows($result);
    $run = true;
  }

}

?>

  <div class="container">
<h3>Search People To Transfer Money</h3>

<form method="post">
<div class="user_input">
    <label>Enter Full Name Of Reciepent :</label>
<br>
    <input class="input" type="text" name="user" placeholder="Search People">
</div>

<div  class="btn">
<button>Search</button>
</div>
</form>
</div>

<?php
if($_SERVER["REQUEST_METHOD"] == "POST" && $run == true){

if($num == 0){
  echo "<h5>No Records Found. </h5>";
}
else if($sends_money == $user){
     echo "<h5>You cannot transfer money to yourself.. </h5>";

  }

else {
  echo "<p><b> " .$num ." Record Found. </b><p>";
 while ($data = mysqli_fetch_array($result)){

echo "<h6>Name : ". $data["name"];"</h6>";
echo "<br>";
echo "Email : ". $data["email"];
echo "<br>";
echo "Available Balance : ". $data["current_balance"];
//to store receipents credentials
$_SESSION["name"] = $data["name"];
$_SESSION["balance"] = $data["current_balance"];

//while ends here
}
echo "<br>";
echo "<br>";
echo "<h4>Enter Amount</h4>";
//to store sender name
$_SESSION["sender_name"] = $sends_money;

?>
<form action="send_money.php"  method="post">
<div class="input-group mx-4 mt-4">
<span class="input-group-text">₹</span>
<input type="text" name="amount" class="form-control" aria-label="Amount">
</div>


<?php
echo "<br>";
?>


<button>Transfer</button>
</form>
<?php
 //else  ends here
}      

}
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

