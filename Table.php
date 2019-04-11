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
      <input type = "submit" name = "lastorder" value= "Last Name Ascending Order">
      <input type = "submit" name = "lastorderD" value= "Last Name Descending Order">
      <input type = "submit" name = "cityorder" value= "List by City">
      <input type = "submit" name = "stateorder" value= "List by State">
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

    //Input constraints
    if($_POST['first'] == "" || $_POST['last'] == ""){
      echo "Information was not added.<br>Please enter your First and Last Name <br>";
    }
    else if($_POST['address'] != "" && ($_POST['city'] == "" ||
     $_POST['state'] == "" || $_POST['zip'] == "")) {
       echo "Information was not added.<br>Please enter City, State, and Zip with your Street Address<br>";
     }
    /* else if(count($_POST['state']) != 2){
       echo "Information was not added.<br>Please enter State as 2 intials";
     }*/
     //if requirements are met, insert data into SQL server
    else{
    $sql = "INSERT INTO people1 (firstName, lastName, streetAddress, City,
      State, Zip, Email, Phone)  VALUES ('$first', '$last', '$address',
        '$city', '$state', '$zip', '$email', '$phone');";
    $query = mysqli_query($conn, $sql);
        }
      }

     ?>

      <?php

    //SELECT statements for table
     $table = "SELECT firstName, lastName, streetAddress, City, State, Zip,
     Email, Phone, lastContactDate, creationDate FROM people1";

     $tablelast = "SELECT lastName, firstName, streetAddress, City, State, Zip,
     Email, Phone, lastContactDate, creationDate FROM people1
     ORDER BY lastName ASC";

     $tablelastD = "SELECT lastName, firstName, streetAddress, City, State, Zip,
     Email, Phone, lastContactDate, creationDate FROM people1
     ORDER BY lastName DESC";

     $tablecity = "SELECT lastName, firstName, streetAddress, City, State, Zip,
     Email, Phone, lastContactDate, creationDate FROM people1
     ORDER BY City ASC";

     $tablestate = "SELECT lastName, firstName, streetAddress, City, State, Zip,
     Email, Phone, lastContactDate, creationDate FROM people1
     ORDER BY State ASC";

     //SELECT implementation to server
     $result = $conn->query($table);
     $resultlast = $conn->query($tablelast);
     $resultlastD = $conn->query($tablelastD);
     $resultcity = $conn->query($tablecity);
     $resultstate = $conn->query($tablestate);

     //Default table layout
     if(isset($_POST['submit'])){
       if($result-> num_rows > 0){
         echo "<table>
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
           <th>Creation date/time </th>";
       while($row = $result-> fetch_assoc()){
         echo
         "<tr><td>" .  $row["firstName"] . "</td><td>" . $row["lastName"] .
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
       }

   //List by LastName
     if(isset($_POST['lastorder'])){
      if($resultlast-> num_rows > 0){
       echo "<table>
        <tr>
         <th>Last Name </th>
         <th>First Name </th>
         <th>Street Address </th>
         <th>City </th>
         <th>State </th>
         <th>Zip </th>
         <th>Email </th>
         <th>Phone Number </th>
         <th>Date of Last Contact </th>
         <th>Creation date/time </th>";
       while($row = $resultlast-> fetch_assoc()){
       echo
       "<tr><td>" .  $row["lastName"] . "</td><td>" . $row["firstName"] .
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
     }
     //List by LastName Descending
     if(isset($_POST['lastorderD'])){
       if($resultlastD-> num_rows > 0){
         echo "<table>
          <tr>
           <th>Last Name </th>
           <th>First Name </th>
           <th>Street Address </th>
           <th>City </th>
           <th>State </th>
           <th>Zip </th>
           <th>Email </th>
           <th>Phone Number </th>
           <th>Date of Last Contact </th>
           <th>Creation date/time </th>";
       while($row = $resultlastD-> fetch_assoc()){
         echo
         "<tr><td>" .  $row["lastName"] . "</td><td>" . $row["firstName"] .
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
       }
    //List by City
        if(isset($_POST['cityorder'])){
         if($resultcity-> num_rows > 0){
           echo "<table>
            <tr>
             <th>City </th>
             <th>First Name </th>
             <th>Last Name </th>
             <th>Street Address </th>
             <th>State </th>
             <th>Zip </th>
             <th>Email </th>
             <th>Phone Number </th>
             <th>Date of Last Contact </th>
             <th>Creation date/time </th>";
         while($row = $resultcity-> fetch_assoc()){
           echo
           "<tr><td>" .  $row["City"] . "</td><td>" . $row["firstName"] .
           "</td><td>" . $row["lastName"] . "</td><td>" . $row["streetAddress"] .
           "</td><td>" . $row["State"] . "</td><td>" . $row["Zip"] .
           "</td><td>" . $row["Email"] . "</td><td>" . $row["Phone"] .
           "</td><td>" . $row["lastContactDate"] . "</td><td>" . $row["creationDate"] .
           "</td></tr>";
         }
         echo "</table>";
       }else{
         echo "Table is currently empty<br>";
           }
         }

      //List by State
      if(isset($_POST['stateorder'])){
          if($resultstate-> num_rows > 0){
            echo "<table>
             <tr>
              <th>State </th>
              <th>First Name </th>
              <th>Last Name </th>
              <th>Street Address </th>
              <th>City </th>
              <th>Zip </th>
              <th>Email </th>
              <th>Phone Number </th>
              <th>Date of Last Contact </th>
              <th>Creation date/time </th>";
          while($row = $resultstate-> fetch_assoc()){
            echo
            "<tr><td>" .  $row["State"] . "</td><td>" . $row["firstName"] .
            "</td><td>" . $row["lastName"] . "</td><td>" . $row["streetAddress"] .
            "</td><td>" . $row["City"] . "</td><td>" . $row["Zip"] .
            "</td><td>" . $row["Email"] . "</td><td>" . $row["Phone"] .
            "</td><td>" . $row["lastContactDate"] . "</td><td>" . $row["creationDate"] .
            "</td></tr>";
          }
          echo "</table>";
        }else{
          echo "Table is currently empty<br>";
            }
          }
     ?>
      </tr>
   </table>
  </body>
</html>
