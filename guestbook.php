<html>
  <head>
    <meta charset="utf-8">
    <style>
      table {border-collapse: collapse; }
      table, td {border: 1px solid black; }
      input[type=text], textarea {
        width: 100%;
      }
    </style>
  </head>
  <body>
 <?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "guestbook";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset($conn,"utf8");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<form method="POST">
Overskrift: <br />
<input type="text" name="overskrift" /><br />
Tekst: <br/>
<textarea name="tekst" rows="10" cols="40"></textarea><br />
Dit navn: <br />
<input type="text" name="afsender"/><br />
<input type="submit" value="gem" />
</form>

<?php
// gem hvis udfyldt
if(!empty($_POST["overskrift"]) && !empty($_POST["tekst"])) {
  $overskrift = $_POST["overskrift"];
  $tekst = $_POST["tekst"];
  $afsender = $_POST["afsender"];
  $gemsql = "INSERT INTO message (text, sender, header) VALUES ('$tekst', '$afsender', '$overskrift');";
  $conn->query($gemsql);
  #echo $gemsql;
}


$sql = "SELECT * FROM message;";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
?>

    <table>
<?php
    // output data of each row
    while($row = $result->fetch_assoc()) {
    ?>
      <tr>
    <?php
      $dato = $row["created"];
      $overskrift = $row["header"];
      $tekst = $row["text"];
      $afsender = $row["sender"];

      echo "<td>$dato</td><td>$overskrift</td><td>$tekst</td><td>$afsender</td>";
    ?>
      </tr>
    <?php

    }
    ?>
    </table>
    <?php
} else {
    echo "0 results";
}
$conn->close();
?>
</body>
</html>
