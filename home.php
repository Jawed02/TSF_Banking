
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Home</title>
    <style>
 h3 {
     margin-top:40px;
     margin-left:40px;
     margin-bottom:40px;
     text-align:center;
 }
 table {
   margin-top:20px;
   margin-left:40px;
 }
.btn {
  margin-top:30px;
  margin-left:30px;
  text-align:center;
}
button {
  background-color:black;
  color:white;
  padding:10px;
  border-radius:8px;
  border:none;
  outline:none;
  margin-bottom:40px;
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
  padding:10px;
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
  </head>
  <body>
    <?php
  include 'database/_nav.php';
  include 'database/_dbconnect.php';

  if($_SERVER["REQUEST_METHOD"] == "POST"){
   $sender = $_POST["sender"];
   $sql = "select * from `customers` where name = '$sender'";
   $result = mysqli_query($conn,$sql);
   $num = mysqli_num_rows($result);
     if($num == 0){
      echo '<div class="alert alert-danger" role="alert">
      Please Enter a Valid Name to Continue..
  </div>';
     }else {
    session_start();
      $_SESSION["sends_money"] = $sender;    
      header("location:search.php");

     }
  }
  ?>
<!-- <?php
echo "Heyy ";
echo $sender;
?>   -->
<h3>All Customers</h3>


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


<?php




$sql = "select * from customers";
$result = mysqli_query($conn,$sql);
// $num = mysqli_num_rows($result);    //number of rows affected

// $row = mysqli_fetch_assoc($result);

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

</div>
<!-- action="search.php" -->
<div class="user">
<form method="post" >
<label>Selct a person as Sender : &nbsp;</label>
<input type="text" name="sender" class="sender" placeholder="Enter Sender's Name" required>

</div>

<div  class="btn">
<button>Transfer Money</button>
</div>
</form>


