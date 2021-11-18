
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Transaction History</title>
  </head>
  <style>
      table {
          margin-top:40px;
          margin-left:40px;
          margin-right:10px;
          margin-bottom:60px;
      }
table tr {
  border:1px solid black;
}
table tr td,th  {
  padding:14px;
  border-right:1px solid black;
}
h3 {
    margin-top:30px;
    margin-left:40px;
}
@media only screen and (max-width: 600px) {

table {
  margin-left:5px;
  font-size:15px;
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
  <body>
<?php
  include 'database/_nav.php';
include 'database/_dbconnect.php';
?>
  <h3>Transaction History</h3>
  <?php

$sql = "select * from transfers";
$result = mysqli_query($conn,$sql);

?>

<table>
  <tr>
  <th>Sl No.</th>
  <th>Name</th>
  <th>Email</th>
  <th>Balance</th>
</tr>


<?php
$i=1;
while($data = mysqli_fetch_array($result)){
?>
<tr>
   <td> <?php echo $i ?> </td>
   <td> <?php echo $data["sender"]; ?> </td>
  <td> <?php echo $data["recipient"]; ?> </td>
   <td> <?php echo $data["amount"];  ?> </td>
</tr>

<?php
$i++;
}

?>
</table>


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