<?php

$mevsimler = array("İlkbahar","Yaz","Sonbahar","Kış");
print_r($mevsimler);
echo"<br>";

$sehirler = array();
$sehirler[0] = "İstanbul";
$sehirler[1] = "Ankara";
$sehirler[2] = "İzmir";
$sehirler[3] = "Antalya";

print_r($sehirler);

echo"<br>";
echo(count($sehirler));

echo("<br>");
echo("FOR EACH DONGUSU");
echo("<br>");

foreach ($sehirler as $sehir) {
	echo($sehir);
	echo("<br>");
}

for($i=0;$i<count($sehirler);$i++){
	echo($sehirler[$i]);
	echo("<br>");
}

array_push($sehirler, "DENİZLİ");
array_unshift($sehirler, "AYDIN");

print_r($sehirler);

?>