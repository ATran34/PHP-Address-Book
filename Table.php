<?php
include_once 'connection.php';
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Table</title>
  </head>
  <body>

    <form action= "Table.php" method="post">
      <input type ="text" name="first" placeholder="First name">
      <br>
      <input type ="text" name ="last" placeholder="Last name">
      <br>
      <input type ="text" name ="address" placeholder="Street Address">
      <br>
      <input type ="text" name ="city" placeholder="City">
      <br>
      <input type ="text" name ="state" placeholder="State">
      <br>
      <input type ="text" name ="zip" placeholder="ZIP">
      <br>
      <input type ="text" name ="email" placeholder="Email Address">
      <br>
      <input type ="text" name ="phone" placeholder="Phone Number">
      <br>
      <input type = "submit" name = "submit">
    </form>

    <?php
    if(isset($_POST['submit'])) {

    $first = ($_POST['first']);
    $last = ($_POST['last']);
    $address = ($_POST['address']);
    $city = ($_POST['city']);
    $state = ($_POST['state']);
    $zip = ($_POST['zip']);
    $email = ($_POST['email']);
    $phone = ($_POST['phone']);

    if($_POST['first'] == "" || $_POST['last'] == ""){
      echo "Please enter your First and Last Name <br>";
    }
    else if($_POST['address'] != "" && ($_POST['city'] == "" ||
     $_POST['state'] == "" || $_POST['zip'] == "")) {
       echo "Please enter City, State, and Zip with your Street Address";
     }
    else{
    $sql = "INSERT INTO people1 (firstName, lastName, streetAddress, City,
      State, Zip, Email, Phone)  VALUES ('$first', '$last', '$address',
        '$city', '$state', '$zip', '$email', '$phone');";
    $query = mysqli_query($conn, $sql);
        }
      }

     ?>
     <table>
       <tr>
         <th>First Name </th>
         <th>Last Name </th>
         <th>Street Address </th>
         <th>City </th>
         <th>State </th>
         <th>Zip </th>
         <th>Email </th>
         <th>Phone Number </th>
         <th>Date of Last Contact </th>
         <th>Creation date/time </th>

      <?php
     $table = "SELECT firstName, lastName, streetAddress, City, State, Zip,
     Email, Phone, lastContactDate, creationDate from people1";
     $result = $conn->query($table);

     if($result-> num_rows > 0){
       while($row = $result-> fetch_assoc()){
         echo
         "<tr><td>" . $row["firstName"] . "</td><td>" . $row["lastName"] .
         "</td><td>" . $row["streetAddress"] . "</td><td>" . $row["City"] .
         "</td><td>" . $row["State"] . "</td><td>" . $row["Zip"] .
         "</td><td>" . $row["Email"] . "</td><td>" . $row["Phone"] .
         "</td><td>" . $row["lastContactDate"] . "</td><td>" . $row["creationDate"] .
         "</td></tr>";
       }
       echo "</table>";
     }else{
       echo "Table is currently empty<br>";
     }
     ?>
      </tr>
   </table>
  </body>
</html>
