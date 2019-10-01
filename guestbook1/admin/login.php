<?php
// For at have adgang til sessions-variablen
session_start();

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



// hvis navn og pw er udfyldt, check deres værdi
if(!empty( $_POST['brugerid'] ) && !empty( $_POST['kode'] )) {
  // her vil man altid checke ved at slå op i database
  // og det gør vi også i næste eksempel
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
    // husk brugernavn på sessionen
    $_SESSION['brugerid'] = $brugerid;
    // viderestil til forside
    header('location:index.php');
  }

?>
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
  
 



  <form method="POST">
    <table width="100%"> 
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
  </body>
</html>
