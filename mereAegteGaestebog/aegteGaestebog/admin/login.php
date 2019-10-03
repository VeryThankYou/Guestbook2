<?php
// For at have adgang til sessions-variablen
session_start();

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
$brugerid="";
$kode="";
$kkode="";
$kid="";

// hvis navn og pw er udfyldt, check deres v�rdi
if(!empty( $_POST['brugerid'] ) && !empty( $_POST['kode'] )) {
  // her vil man altid checke ved at sl� op i database
  // og det g�r vi ogs� i n�ste eksempel
    $brugerid = $_POST['brugerid'];
  $kode = $_POST['kode'];

  $sql = "SELECT kode FROM users WHERE brugerid='$brugerid';";
$result = $conn->query($sql);
	   $fetch = $result;
	   $row = mysqli_fetch_assoc($fetch);
	   $kkode = $row['kode'];

	   $kid = $brugerid;
}
  // er brugernavn og password udfyldt korrekt?
  if($brugerid == $kid && password_verify($kode, $kkode) == true) {
    // husk brugernavn p� sessionen
    $_SESSION['brugerid'] = $brugerid;
    // viderestil til forside
    header('location:index.php');
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



  <form method="POST" style="min-height:275px;padding-left:600px;padding-top:75px;">
    <table>
      <tr>
        <th>Brugernavn: <br/></th>
        <th><input type="text" name="brugerid" /></th>
      </tr>
      <tr>
        <th>Adgangskode: <br /></th>
        <th><input type="password" name="kode" /></th>
      </tr>
      <tr>
	    <th><input type="submit" value="Login" /> </th>
      </tr>
    </table>
  </form>

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
  </body>
</html>
