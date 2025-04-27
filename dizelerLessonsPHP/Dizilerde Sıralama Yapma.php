<?php

$notlarim=array(
"Bilişim Teknolojilerin Temelleri"=>75,
"Programlama Temelleri"=>100,
"Bilgisayarlı Tasarım Uygulamaları"=>85,
"Mesleki Gelişim Atölyesi"=>95);


$notlarim=array(
"Bilişim Teknolojilerin Temelleri"=>75,
"Programlama Temelleri"=>100,
"Bilgisayarlı Tasarım Uygulamaları"=>85,
"Mesleki Gelişim Atölyesi"=>95);
asort($notlarim);
echo"<pre>";
print_r($notlarim);
arsort($notlarim);
echo"<pre>";
print_r($notlarim);


sort($notlarim);
 echo"<pre>";
 print_r($notlarim);
 rsort($notlarim);
 echo"<pre>";
 print_r($notlarim);


 natcasesort($notlarim);
 echo"<pre>";
 print_r($notlarim);
 natsort($notlarim);
 echo"<pre>";
 print_r($notlarim);


?>