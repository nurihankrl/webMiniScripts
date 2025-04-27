<?php

$url = 'https://api.raizymedya.com.tr/qrkodYemek.php';
$yemekJson = file_get_contents($url);

if ($yemekJson !== false) {
    $yemekler = json_decode($yemekJson, true);
    

    if (!is_array($yemekler)) {
        $yemekler = []; 
    }
} else {

    $yemekler = [];
}

?>


<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kara || QR Menü Tasarımı</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f7f7f7;
            color: #333;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 50px 20px;
        }

        header {
            text-align: center;
            margin-bottom: 60px;
        }

        header h1 {
            font-size: 4rem;
            font-weight: 700;
            color: #212121;
            margin-bottom: 15px;
            letter-spacing: 1px;
        }

        header p {
            font-size: 1.1rem;
            color: #6c757d;
            margin-top: 0;
        }
        .qr-container {
            text-align: center;
            margin-bottom: 50px;
        }

        .qr-container img {
            width: 250px;
            height: 250px;
            border-radius: 12px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .qr-container img:hover {
            transform: scale(1.1);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
        }

        .banner {
            background-color: #ff6f61;
            color: white;
            text-align: center;
            padding: 20px 0;
            margin-bottom: 40px;
            border-radius: 10px;
            font-size: 1.2rem;
            font-weight: 500;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease;
        }

        .banner:hover {
            background-color: #e55d4f; 
        }

        .banner a {
            color: white;
            text-decoration: none;
            font-weight: 600;
            padding: 8px 20px;
            background-color: #212121;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .banner a:hover {
            background-color: #ff6f61;
        }

        .flex-add {
            display: flex;
            justify-content: center; 
            gap: 20px; 
            flex-wrap: wrap; 
            margin-bottom: 40px; 
        }

        .banner-with-image {
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #4e73df; 
            color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease;
            margin-bottom: 40px;
            width: 100%;
            max-width: 650px; 
        }

        .banner-with-image img {
            width: 250px; 
            height: 200px;
            margin-right: 20px;
            border-radius: 8px;
            object-fit: cover;
        }

        .banner-with-image .content {
            text-align: left; 
        }

        .banner-with-image h3 {
            font-size: 1.6rem;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .banner-with-image p {
            font-size: 1.1rem;
            margin-bottom: 15px;
        }

        .banner-with-image a {
            color: white;
            text-decoration: none;
            font-weight: 600;
            padding: 8px 20px;
            background-color: #212121;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .banner-with-image a:hover {
            background-color: #ff6f61;
        }

        /* Menü listesi */
        .menu-list {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 40px;
        }

        /* Menü öğesi */
        .menu-item {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease, background-color 0.3s ease;
            text-align: center;
            cursor: pointer;
            overflow: hidden;
            position: relative;
        }

        /* Hover efektleri */
        .menu-item:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
            background-color: #f5f5f5;
        }

        .menu-item img {
            width: 100%;
            height: 220px;
            object-fit: cover;
            border-radius: 12px;
            transition: transform 0.4s ease;
        }

        .menu-item:hover img {
            transform: scale(1.1);
        }

        .menu-item h3 {
            font-size: 1.6rem;
            font-weight: 700;
            color: #333;
            margin: 20px 0 10px 0;
            transition: color 0.3s ease;
        }

        .menu-item:hover h3 {
            color: #ff6f61; 
        }

        .menu-item p {
            font-size: 1.1rem;
            color: #7a7a7a;
            margin-bottom: 15px;
            line-height: 1.5;
        }

        .price {
            font-size: 1.4rem;
            font-weight: 700;
            color: #ff6f61;
        }
        
        /* Responsive Tasarım */
        @media (max-width: 768px) {
            header h1 {
                font-size: 2.8rem;
            }

            .qr-container img {
                width: 200px;
                height: 200px;
            }

            .menu-list {
                grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
            }

            .banner {
                font-size: 1rem;
                padding: 15px 0;
            }

            .banner-with-image {
                font-size: 1rem;
                flex-direction: column; 
                text-align: center;
                max-width: 90%; 
                margin: auto;
                margin-bottom: 25px;
                padding: 40px;
            }

            .banner-with-image img {
                width: 200px;
                height: 120px;
                margin: 0 0 15px 0;
            }

            .banner-with-image .content {
                text-align: center;
            }
        }

        @media (max-width: 480px) {
            header h1 {
                font-size: 2.4rem;
            }

            .qr-container img {
                width: 160px;
                height: 160px;
            }

            .menu-list {
                grid-template-columns: 1fr;
            }

            .banner-with-image img {
                width: 200px;
                height: 150px;
            }
        }

a {
text-decoration: none;
}
    </style>
</head>
<body>

    <div class="container">
        <header>
            <h1>QR Yemek Menünüz</h1>
            <p>Yemeklerinizi QR kodu ile keşfedin ve kolayca sipariş verin.</p>
        </header>

        <div class="qr-container">
            <img src="qr-code.png" alt="QR Kod">
        </div>

        <div class="banner">
            <p><strong>Özel Teklif: %20 İndirim!</strong></p>
            <p>Bugün sipariş verenlere özel %20 indirim fırsatını kaçırmayın. </p>
        </div>

        <div class="flex-add">
            <div class="banner-with-image">
                <img src="hamburger.png" alt="Reklam Görseli">
                <div class="content">
                    <h3>Yeni Ürün! hamburger</h3>
                    <p>Bol Mağzemeli ve nefis bir seçenek.</p>
                    <a href="benzeryemekler.html">Hemen Keşfet</a>
                </div>
            </div>
        
            <div class="banner-with-image">
                <img src="arabiata.png" alt="Reklam Görseli">
                <div class="content">
                    <h3>Yeni Ürün! Makarna</h3>
                    <p>Bol Mağzemeli ve nefis bir seçenek.</p>
                    <a href="benzeryemekler.html">Hemen Keşfet</a>
                </div>
            </div>
        </div>
 
 


    <section class="menu-list">
        <?php 
        if (is_array($yemekler) && count($yemekler) > 0): 
            foreach ($yemekler as $item): 
        ?>
            <div class="menu-item">
                <a href="benzeryemekler.php?Yid=<?php echo $item['yemekid']; ?>">
                    <img src="<?php echo $item['image']; ?>" alt="<?php echo $item['alt']; ?>">
                    <h3><?php echo $item['title']; ?></h3>
                    <p><?php echo $item['description']; ?></p>
                    <p class="price"><?php echo $item['price']; ?></p>
                </a>
            </div>
        <?php endforeach; ?>
        <?php else: ?>
            <p>Menu öğeleri bulunamadı.</p>
        <?php endif; ?>
    </section>



   </div>

</body>
</html>
