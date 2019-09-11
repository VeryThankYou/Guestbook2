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
 // data for forbindelse til databasen
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "guestbook";

// åbn forbindelsen
$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset($conn,"utf8");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>


<?php
// variable til brugerens data
$overskrift = "";
$tekst = "";
$afsender = "";

// tomme variable til fejlmeddelelser
$fejl_overskrift = "";
$fejl_tekst = "";
$fejl_afsender = "";

$der_er_en_fejl = false;

// reager kun på POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // tjek hvert felt
  if(empty($_POST["overskrift"])) {
    $fejl_overskrift = "* overskrift skal udfyldes";
    $der_er_en_fejl = true;
  }
  else {
  $overskrift = $_POST["overskrift"];
  }
  if(empty($_POST["tekst"])) {
    $fejl_tekst = "* tekst skal udfyldes";
    $der_er_en_fejl = true;
  }
  else {
  $tekst = $_POST["tekst"];
  }
  if(empty($_POST["afsender"])) {
    $fejl_afsender = "* afsender skal udfyldes";
    $der_er_en_fejl = true;
  }
  else {
  $afsender = $_POST["afsender"];
  }
  
  // hvis der ikke er fejl, gem
  if($der_er_en_fejl == false) {
    $gemsql = "INSERT INTO message (text, sender, header) VALUES ('$tekst', '$afsender', '$overskrift');";
    $conn->query($gemsql);
    #echo $gemsql;
  }
}


$sql = "SELECT * FROM message;";
$result = $conn->query($sql);
?>


<form method="POST">
<table width="100%"> 
  <tr>
    <th>Overskrift: <br /></th>
    <th><input type="text" name="overskrift" value="<?php echo $overskrift; ?>" /></th>
    <th><span class="fejl"> <?php echo $fejl_overskrift; ?> </span> <br /></th>
  </tr>
  <tr>
    <th>Tekst: <br /></th>
    <th><textarea name="tekst" rows="10" cols="40"><?php echo $tekst; ?></textarea></th>
    <th><span class="fejl"><?php echo $fejl_tekst; ?> </span> <br /></th>
  </tr>
  <tr>
    <th>Dit navn: <br /></th>
    <th><input type="text" name="afsender" value="<?php echo $afsender; ?>" /></th>
    <th><span class="fejl"> <?php echo $fejl_afsender; ?> </span> <br /></th>
  </tr>
  <tr>
    <th> </th>
	<th><input type="submit" value="gem" /> </th>
	<th> </th>
  </tr>
  <tr>
    <th colspan="3"></td>
  </tr>


</table>

</form>


<?php

// hvis der er indlæg i databasen: start en html-tabel
if ($result->num_rows > 0) {
?>

    <table>
<?php
    // løb alle rækker igennem
    while($row = $result->fetch_assoc()) {
    ?>
      <tr>
    <?php
      // mellemvariable til print
      $dato = $row["created"];
      $overskrift = $row["header"];
      $tekst = $row["text"];
      $afsender = $row["sender"];
      // print mellemvariable (som række i html-tabellen)
      echo "<td>$dato</td><td>$overskrift</td><td>$tekst</td><td>$afsender</td>";
    ?>
      </tr>
    <?php

    }
    ?>
    </table>
    <?php
} else {
    echo "ingen indlæg, du kan skrive det første";
}
$conn->close();
?>
</body>
</html>
