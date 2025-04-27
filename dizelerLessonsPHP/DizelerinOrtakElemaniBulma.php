<?php

  $renk1=array("Kırmızı","Mavi","Sarı","Siyah","Beyaz","Gri");
   $renk2=array("Yeşil","Mavi","kırmızı","siyah","Beyaz","gri");
   $renk3=array("yeşil","Mavi","Sarı","siyah","Beyaz","Gri");
 $son_renk=array_intersect($renk1,$renk2,$renk3);
 echo"<pre>";
 print_r($son_renk);

?>