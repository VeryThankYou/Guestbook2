<?php
// For at have adgang til sessions-variablen
session_start();

// hvis ikke bruger er logget ind viderestilles til logind-siden
if(empty( $_SESSION['brugerid'] )) {
  header('location:login.php');
}
?>


<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/mainStyles.css">
</head>
<body>
  <div class="header">
    <div class="fersken">
      <img src="../FanefjordFrugt_Logo_Fersken.png" alt="Fanefjord Frugt Logo">
    </div>
    <div class="browse">
      <ul>
        <li><button type="button" onclick="Test.php">Hjem</button></li>
        <li><button type="button" onclick="Test.php">Om os</button></li>
        <li><button type="button" onclick="Test.php">Galleri</button></li>
        <li><button type="button" onclick="Test.php">Vores produkter</button></li>
        <li><button type="button" onclick="Test.php">Gæstebog</button></li>
        <li><button type="button" onclick="Test.php">Kontakt</button></li>
      </ul>
    </div>
  </div>
 <?php

 // data for forbindelse til databasen
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "guestbook";

// �bn forbindelsen
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
$fejl_mangel = "";


$der_er_en_fejl = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST["slet"])){
	$hentid = $_POST["sletid"];

	$nysql = "DELETE FROM message WHERE id=$hentid";
	$conn->query($nysql);

	} else if(isset($_POST["send"])) {
	// tjek hvert felt
  if(empty($_POST["overskrift"])) {
    $fejl_mangel = "* alle felter skal udfyldes";
    $der_er_en_fejl = true;
  }
  else {
  $overskrift = $_POST["overskrift"];
  }
  if(empty($_POST["tekst"])) {
    $fejl_mangel = "* alle felter skal udfyldes";
    $der_er_en_fejl = true;
  }
  else {
  $tekst = $_POST["tekst"];
  }
  if(empty($_POST["afsender"])) {
    $fejl_mangel = "* alle felter skal udfyldes";
    $der_er_en_fejl = true;
  }
  else {
  $afsender = $_POST["afsender"];
  }

  // hvis der ikke er fejl, gem
  if($der_er_en_fejl == false) {
    $gemsql = "INSERT INTO message (text, sender, header) VALUES ('$tekst', '$afsender', '$overskrift');";
    $tekst = "";
	  $afsender = "";
	  $overskrift = "";
    $conn->query($gemsql);
    #echo $gemsql;
  }
	}
	}

$sql = "SELECT * FROM message;";
$result = $conn->query($sql);
?>

  <p class="gaestebogTitle">Gæstebog</p>
  <div class="gaestebog">
    <div>
      <form method="POST">
        <table class="gaesteSkriv">
          <tr>
            <th>Overskrift:</th>
            <td><input type="text" name="overskrift" value="<?php echo $overskrift; ?>" /></td>
          </tr>
          <tr>
            <th>Tekst:</th>
            <td><textarea name="tekst" rows="10" cols="40"><?php echo $tekst; ?></textarea></td>
          </tr>
          <tr>
            <th>Dit navn:</th>
            <td><input type="text" name="afsender" value="<?php echo $afsender; ?>" /></td>
          </tr>
          <tr>
            <th colspan="2"><span class="fejl"> <?php echo $fejl_mangel; ?> </span></th>
          </tr>
          <tr>
	           <td colspan="2"><input type="submit" name="send" value="gem" /> </td>
           </tr>
         </table>
       </form>
     </div>
     <div>


<?php

// hvis der er indl�g i databasen: start en html-tabel
if ($result->num_rows > 0) {
?>

    <table class="gaesteSe">
      <tr>
        <th>Dato</th>
        <th>Titel</th>
        <th>Kommentar</th>
        <th>Navn</th>
      </tr>
    <?php
    // l�b alle r�kker igennem
    while($row = $result->fetch_assoc()) {
    ?>
      <tr>
    <?php
      // mellemvariable til print
      $dato = $row["created"];
      $overskrift = $row["header"];
      $tekst = $row["text"];
      $afsender = $row["sender"];
	    $id = $row["id"];
      // print mellemvariable (som r�kke i html-tabellen)
      echo "<td>$dato</td><td>$overskrift</td><td>$tekst</td><td>$afsender</td><form method='POST'><td><input type='submit' class='button' name='slet' value='Slet' /><input type='hidden' value='$id' name='sletid'/></td></form>";
    ?>
      </tr>
    <?php

    }
    ?>
    </table>
  </div>
</div>
<div class="footer">
  <table class="footerTable">
    <col width="340px">
    <col width="420px">
    <col width="420px">
    <tr>
      <th>Find os</th>
      <th>Åbningstider</th>
      <th>Genveje</th>
    </tr>

    <tr>
      <td>Hårbøllevej 22</td>
      <td>Salgsbod: Åben i sæsonen ca. 15. aug. - 1. feb.</td>
      <td><a class="fadeLink" href="Test.php">Hjem</a>  | Om os</td>
    </tr>

    <tr>
      <td>Email: <a class="redLink" href="mailto:info@fanefjordfrugt.dk">info@fanefjordfrugt.dk</a></td>
      <td>Alle dage: Kl. 8-18</td>
      <td><a class="fadeLink" href="Test.php">Galleri</a>  | Sortiment</td>
    </tr>

    <tr>
      <td>Telefon: <span style="color: #ed7c59;">22 32 56 30</span></td>
      <td>Udenfor sæsonen: Kontakt os for aftale</td>
      <td><a class="redLink" href="Test.php">Kontakt os</a></td>
    </tr>
  </table>


</div>
    <?php

} else {
    echo "ingen indl�g, du kan skrive det f�rste";
}


$conn->close();
?>
</body>
</html>
