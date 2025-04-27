<?php

$renk1=array("Kırmızı","Mavi","Sarı","Siyah","Beyaz","Gri");
   $renk2=array("Yesil","Mavi","kırmızı","siyah","Beyaz","Gri");
 $son_renk=array_diff($renk1,$renk2);
 echo"<pre>";
 print_r($son_renk);

?>