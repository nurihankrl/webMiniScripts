<?php 
$servername = "localhost";
$username = "root";
$password = "";
$database = "eokul";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn === false) {
	die("bağlantı hatası" . $conn -> connect_error);
}
echo "<p>bağlantı başarılı</p>";

$sql = "SELECT * FROM ogrenci_data";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
	while($row = mysqli_fetch_assoc($result)) {
		echo "<table>
		<td>Okul No: " .$row["ogrenci_no"]. "
		 - Adı: " .$row["ogrenci_adi"].  "
		  - Doğum Tarihi: " . $row["ogrenci_dogumTarihi"]. "
		  <br></td></table>";
	}
} else {
	echo "tabloda veri bulunamadı!";
}
?>
