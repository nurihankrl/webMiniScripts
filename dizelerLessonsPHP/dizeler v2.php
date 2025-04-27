<?php

$kitaplar=array("Çalıkuşu","Dokuzuncu Hariciye Koğuşu","Sinekli Bakkal");
array_unshift($kitaplar,"Suç ve Ceza");
array_push($kitaplar,"Vadideki Zambak");
echo"<pre>";
print_r($kitaplar);


array_shift($kitaplar);
array_pop($kitaplar);
echo"<pre>";
print_r($kitaplar);

unset($kitaplar[1]);
echo"<pre>";
print_r($kitaplar);

?>