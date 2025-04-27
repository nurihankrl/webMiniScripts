<?php
$addget = isset($_GET["Yid"]) ? $_GET["Yid"] : null;
$selamver = "Selam Yolcu,<br> Ben seni severek görüntüleyen bir kodum. Bir şeyler başardığının farkındayım. Kendine iyi bak, ama biraz daha hızlı olmalısın. <br> Yazar Kara, ";
if ($addget !== null && is_numeric($addget)) {
} else {
echo $selamver;
echo "<script>
setTimeout(function() {
    window.location.href = 'index.php';
}, 5000);
</script>";
exit;
}

$url = 'qrkodYemek.php';
$yemekJson = file_get_contents($url);

if ($yemekJson !== false) {
    $yemekler = json_decode($yemekJson, true);
    
    if (!is_array($yemekler)) {
        $yemekler = []; 
    }
} else {
    $yemekler = [];
}


if (empty($yemekler)) {
echo "<script>
setTimeout(function() {
    window.location.href = 'index.php';
}, 100);
</script>";
} else {
    $found = false; 
    foreach ($yemekler as $ymk) {
        $yemekidm = $ymk["yemekid"];
        if ($yemekidm === $addget) {
            $yemekimg = $ymk["image"];
            $yemekadi = $ymk["title"];
            $yemekalt = $ymk["alt"];
            $yemekdescription = $ymk["description"];
            $yemekprice = $ymk["price"];
            $myfoodlist = $ymk["icerik"];
            $myfoodcheck = $ymk["benzer_urunler"];
            $found = true;
            break; 
        }
    }

    if (!$found) {
echo $selamver;
echo "<script>
setTimeout(function() {
    window.location.href = 'index.php';
}, 5000);
</script>";
exit;
    }
}


?>


<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kara ||  <?php echo $yemekadi; ?>  Detayı</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f7f7f7;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 50px 20px;
        }

        header {
            text-align: center;
            margin-bottom: 60px;
        }

        header h1 {
            font-size: 3rem;
            font-weight: 700;
            color: #212121;
            margin-bottom: 15px;
        }

        .product-detail {
            display: flex;
            gap: 40px;
            justify-content: center;
            margin-bottom: 60px;
            flex-wrap: wrap;
        }

        .product-detail img {
            width: 400px;
            height: 400px;
            object-fit: cover;
            border-radius: 12px;
            max-width: 100%;
        }

        .product-info {
            max-width: 600px;
            width: 100%;
        }
		
		.product-info .short-description {
            font-size: 1.1rem;
            color: #555;
            margin-bottom: 20px;
            line-height: 1.6;
        }
		
		.price {
            font-size: 1.8rem;
            font-weight: 700;
            color: #ff6f61;
            margin-bottom: 20px;
        }

        .product-info h2 {
            font-size: 2rem;
            font-weight: 700;
            color: #333;
            margin-bottom: 15px;
        }

        .product-info p {
           font-size: 1.3rem;
           color: #555;
           margin-bottom: 20px;
           line-height: 1.6;
		   font-weight: 500;
        }

        .price {
            font-size: 1.6rem;
            font-weight: 700;
            color: #ff6f61;
            margin-bottom: 20px;
        }

        .ingredients {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
            margin-top: 30px;
            transition: all 0.3s ease;
        }

        .ingredients:hover {
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.2);
        }

        .ingredients h3 {
            font-size: 2rem;
            font-weight: 700;
            color: #333;
            margin-bottom: 20px;
            text-transform: uppercase;
            letter-spacing: 1px;
            border-bottom: 2px solid #ff6f61;
            padding-bottom: 10px;
        }

        .ingredients ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }


        .ingredients ul li {
            display: flex;
            align-items: center; /* Dikeyde ortalamak için */
            font-size: 1.2rem;
            color: #555;
            margin-bottom: 20px;
            position: relative;
        }

        .ingredients ul li:before {
            content: "✔";
            margin-right: 15px; 
            color: #ff6f61;
            font-size: 1.5rem;
        }

        .ingredients ul li span {
            font-weight: 600;
            color: #212121;
        }


        .similar-products {
            margin-top: 60px;
            text-align: center;
            display: flex;
            flex-wrap: wrap;
            justify-content: center; 
            gap: 20px;
        }

        .similar-products h3 {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 30px;
            width: 100%; 
        }

        .similar-products .product-item {
            display: inline-block;
            width: 250px;
            margin: 15px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            padding: 20px;
            cursor: pointer;
            transition: all 0.3s ease-in-out;
            transform: translateY(0);
        }

        .similar-products .product-item img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 15px;
        }

        .similar-products .product-item h4 {
            font-size: 1.4rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 10px;
        }

        .similar-products .product-item .price {
            font-size: 1.4rem;
            font-weight: 600;
            color: #ff6f61;
            margin-bottom: 10px;
        }


        .similar-products .product-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }


        .back-to-index-btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #212121;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 1.1rem;
            font-weight: 600;
            margin-top: 30px;
            transition: background-color 0.3s ease;
        }

        .back-to-index-btn:hover {
            background-color: #ff6f61;
        }


        @media (max-width: 768px) {
            header h1 {
                font-size: 2.5rem;
            }

            .product-detail {
                flex-direction: column;
                text-align: center;
            }

            .product-detail img {
                width: 100%;
                height: auto;
                margin-bottom: 20px;
            }

            .product-info {
                max-width: 100%;
            }

            .price {
                font-size: 1.4rem;
            }

            .similar-products .product-item {
                width: 45%; 
                margin: 10px;
                padding: 20px;
            }

            .similar-products .product-item img {
                height: 180px;
            }
        }

        @media (max-width: 480px) {
            header h1 {
                font-size: 2rem;
            }

            .product-info h2 {
                font-size: 1.8rem;
            }

            .product-info p {
                font-size: 1rem;
            }

            .product-detail {
                gap: 20px;
                text-align: center;
            }

            .similar-products .product-item {
                width: 100%;
                margin: 10px auto; 
                padding: 20px;
            }

            .similar-products .product-item img {
                height: 160px;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <header>
            <h1><?php echo $yemekadi; ?> Detayı</h1>
        </header>


        <div class="product-detail">
            <img src="<?php echo $yemekimg; ?>" alt="<?php echo $yemekalt; ?>">
            <div class="product-info">
                <h2><?php echo $yemekadi; ?></h2>
                <p style="short-description"><?php echo $yemekdescription; ?></p>
                <p class="price"><?php echo $yemekprice; ?></p>
            </div>
        </div>

        <div class="ingredients">
            <h3><?php echo $yemekadi; ?> İçindekiler</h3>
            <ul>
			
<?php 

     foreach ($myfoodlist as $icck){
     		echo "<li><span>".($icck)."</span></li>";
     }

?> 
			
                
				
				
				
            </ul>
        </div>

        <a href="index.php" class="back-to-index-btn">Başka Ürün Seç</a>


        <div class="similar-products">
            <h3>Benzer Ürünler</h3>
			
			
	
<?php 

     foreach ($myfoodcheck as $benz){
		    echo "<div class='product-item'>";           
			echo "<img src='".($benz['image'])."'>";
     		echo "<h4>".($benz['title'])."</h4>";
			echo "<p class='price'>".($benz['price'])."</p>";
			echo "</div>";
     }

?> 
		
          
               

         


        </div>

    </div>

</body>
</html>
