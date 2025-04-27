<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nöbetçi Eczane</title>
    <link rel="stylesheet" href="styles.css">
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var citySelect = document.getElementById('city');
            var districtSelect = document.getElementById('district');

            citySelect.addEventListener('change', function() {
                districtSelect.selectedIndex = 0;
                document.querySelector('form').submit();
            });
        });
    </script>
</head>
<body>
    <header>
        <div class="container">
            <h1>Nöbetçi Eczane</h1>
        </div>
    </header>
    <main>
        <div class="container">
         
        <?php
        $ilver = isset($_POST["ilver"]) ? $_POST["ilver"] : null; 
        $ilcever = isset($_POST["ilcever"]) ? $_POST["ilcever"] : null;

        $eczaneler = []; 

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $url = 'https://api.raizymedya.com.tr/nobetciEczane.php?ilver=' . urlencode($ilver) . '&ilcever=' . urlencode($ilcever);
            $eczaneJson = file_get_contents($url);
            
            if ($eczaneJson !== false) {
                $eczaneler = json_decode($eczaneJson, true);
                
                if (!is_array($eczaneler)) {
                    $eczaneler = []; 
                }
            } else {
                $eczaneler = [];
            }
        }
        ?>

        <form method="POST" action="">
            <label for="city">İl:</label>
            <select id="city" name="ilver" required>
                <option value="">Seçin</option>
                <option value="Adana" <?php echo $ilver == 'Adana' ? 'selected' : ''; ?>>Adana</option>
                <option value="Adıyaman" <?php echo $ilver == 'Adıyaman' ? 'selected' : ''; ?>>Adıyaman</option>
                <option value="Afyonkarahisar" <?php echo $ilver == 'Afyonkarahisar' ? 'selected' : ''; ?>>Afyonkarahisar</option>
                <option value="Ağrı" <?php echo $ilver == 'Ağrı' ? 'selected' : ''; ?>>Ağrı</option>
                <option value="Amasya" <?php echo $ilver == 'Amasya' ? 'selected' : ''; ?>>Amasya</option>
                <option value="Ankara" <?php echo $ilver == 'Ankara' ? 'selected' : ''; ?>>Ankara</option>
                <option value="Antalya" <?php echo $ilver == 'Antalya' ? 'selected' : ''; ?>>Antalya</option>
                <option value="Artvin" <?php echo $ilver == 'Artvin' ? 'selected' : ''; ?>>Artvin</option>
                <option value="Aydın" <?php echo $ilver == 'Aydın' ? 'selected' : ''; ?>>Aydın</option>
                <option value="Balıkesir" <?php echo $ilver == 'Balıkesir' ? 'selected' : ''; ?>>Balıkesir</option>
                <option value="Bilecik" <?php echo $ilver == 'Bilecik' ? 'selected' : ''; ?>>Bilecik</option>
                <option value="Bingöl" <?php echo $ilver == 'Bingöl' ? 'selected' : ''; ?>>Bingöl</option>
                <option value="Bitlis" <?php echo $ilver == 'Bitlis' ? 'selected' : ''; ?>>Bitlis</option>
                <option value="Bolu" <?php echo $ilver == 'Bolu' ? 'selected' : ''; ?>>Bolu</option>
                <option value="Burdur" <?php echo $ilver == 'Burdur' ? 'selected' : ''; ?>>Burdur</option>
                <option value="Bursa" <?php echo $ilver == 'Bursa' ? 'selected' : ''; ?>>Bursa</option>
                <option value="Çanakkale" <?php echo $ilver == 'Çanakkale' ? 'selected' : ''; ?>>Çanakkale</option>
                <option value="Çankırı" <?php echo $ilver == 'Çankırı' ? 'selected' : ''; ?>>Çankırı</option>
                <option value="Çorum" <?php echo $ilver == 'Çorum' ? 'selected' : ''; ?>>Çorum</option>
                <option value="Denizli" <?php echo $ilver == 'Denizli' ? 'selected' : ''; ?>>Denizli</option>
                <option value="Diyarbakır" <?php echo $ilver == 'Diyarbakır' ? 'selected' : ''; ?>>Diyarbakır</option>
                <option value="Edirne" <?php echo $ilver == 'Edirne' ? 'selected' : ''; ?>>Edirne</option>
                <option value="Elazığ" <?php echo $ilver == 'Elazığ' ? 'selected' : ''; ?>>Elazığ</option>
                <option value="Erzincan" <?php echo $ilver == 'Erzincan' ? 'selected' : ''; ?>>Erzincan</option>
                <option value="Erzurum" <?php echo $ilver == 'Erzurum' ? 'selected' : ''; ?>>Erzurum</option>
                <option value="Eskişehir" <?php echo $ilver == 'Eskişehir' ? 'selected' : ''; ?>>Eskişehir</option>
                <option value="Gaziantep" <?php echo $ilver == 'Gaziantep' ? 'selected' : ''; ?>>Gaziantep</option>
                <option value="Giresun" <?php echo $ilver == 'Giresun' ? 'selected' : ''; ?>>Giresun</option>
                <option value="Gümüşhane" <?php echo $ilver == 'Gümüşhane' ? 'selected' : ''; ?>>Gümüşhane</option>
                <option value="Hakkari" <?php echo $ilver == 'Hakkari' ? 'selected' : ''; ?>>Hakkari</option>
                <option value="Hatay" <?php echo $ilver == 'Hatay' ? 'selected' : ''; ?>>Hatay</option>
                <option value="Isparta" <?php echo $ilver == 'Isparta' ? 'selected' : ''; ?>>Isparta</option>
                <option value="Mersin" <?php echo $ilver == 'Mersin' ? 'selected' : ''; ?>>Mersin</option>
                <option value="İstanbul" <?php echo $ilver == 'İstanbul' ? 'selected' : ''; ?>>İstanbul</option>
                <option value="İzmir" <?php echo $ilver == 'İzmir' ? 'selected' : ''; ?>>İzmir</option>
                <option value="Kars" <?php echo $ilver == 'Kars' ? 'selected' : ''; ?>>Kars</option>
                <option value="Kastamonu" <?php echo $ilver == 'Kastamonu' ? 'selected' : ''; ?>>Kastamonu</option>
                <option value="Kayseri" <?php echo $ilver == 'Kayseri' ? 'selected' : ''; ?>>Kayseri</option>
                <option value="Kırklareli" <?php echo $ilver == 'Kırklareli' ? 'selected' : ''; ?>>Kırklareli</option>
                <option value="Kırşehir" <?php echo $ilver == 'Kırşehir' ? 'selected' : ''; ?>>Kırşehir</option>
                <option value="Kocaeli" <?php echo $ilver == 'Kocaeli' ? 'selected' : ''; ?>>Kocaeli</option>
                <option value="Konya" <?php echo $ilver == 'Konya' ? 'selected' : ''; ?>>Konya</option>
                <option value="Kütahya" <?php echo $ilver == 'Kütahya' ? 'selected' : ''; ?>>Kütahya</option>
                <option value="Malatya" <?php echo $ilver == 'Malatya' ? 'selected' : ''; ?>>Malatya</option>
                <option value="Manisa" <?php echo $ilver == 'Manisa' ? 'selected' : ''; ?>>Manisa</option>
                <option value="Kahramanmaraş" <?php echo $ilver == 'Kahramanmaraş' ? 'selected' : ''; ?>>Kahramanmaraş</option>
                <option value="Mardin" <?php echo $ilver == 'Mardin' ? 'selected' : ''; ?>>Mardin</option>
                <option value="Muğla" <?php echo $ilver == 'Muğla' ? 'selected' : ''; ?>>Muğla</option>
                <option value="Muş" <?php echo $ilver == 'Muş' ? 'selected' : ''; ?>>Muş</option>
                <option value="Nevşehir" <?php echo $ilver == 'Nevşehir' ? 'selected' : ''; ?>>Nevşehir</option>
                <option value="Niğde" <?php echo $ilver == 'Niğde' ? 'selected' : ''; ?>>Niğde</option>
                <option value="Ordu" <?php echo $ilver == 'Ordu' ? 'selected' : ''; ?>>Ordu</option>
                <option value="Rize" <?php echo $ilver == 'Rize' ? 'selected' : ''; ?>>Rize</option>
                <option value="Sakarya" <?php echo $ilver == 'Sakarya' ? 'selected' : ''; ?>>Sakarya</option>
                <option value="Samsun" <?php echo $ilver == 'Samsun' ? 'selected' : ''; ?>>Samsun</option>
                <option value="Siirt" <?php echo $ilver == 'Siirt' ? 'selected' : ''; ?>>Siirt</option>
                <option value="Sinop" <?php echo $ilver == 'Sinop' ? 'selected' : ''; ?>>Sinop</option>
                <option value="Sivas" <?php echo $ilver == 'Sivas' ? 'selected' : ''; ?>>Sivas</option>
                <option value="Tekirdağ" <?php echo $ilver == 'Tekirdağ' ? 'selected' : ''; ?>>Tekirdağ</option>
                <option value="Tokat" <?php echo $ilver == 'Tokat' ? 'selected' : ''; ?>>Tokat</option>
                <option value="Trabzon" <?php echo $ilver == 'Trabzon' ? 'selected' : ''; ?>>Trabzon</option>
                <option value="Tunceli" <?php echo $ilver == 'Tunceli' ? 'selected' : ''; ?>>Tunceli</option>
                <option value="Şanlıurfa" <?php echo $ilver == 'Şanlıurfa' ? 'selected' : ''; ?>>Şanlıurfa</option>
                <option value="Uşak" <?php echo $ilver == 'Uşak' ? 'selected' : ''; ?>>Uşak</option>
                <option value="Van" <?php echo $ilver == 'Van' ? 'selected' : ''; ?>>Van</option>
                <option value="Yozgat" <?php echo $ilver == 'Yozgat' ? 'selected' : ''; ?>>Yozgat</option>
                <option value="Zonguldak" <?php echo $ilver == 'Zonguldak' ? 'selected' : ''; ?>>Zonguldak</option>
                <option value="Aksaray" <?php echo $ilver == 'Aksaray' ? 'selected' : ''; ?>>Aksaray</option>
                <option value="Bayburt" <?php echo $ilver == 'Bayburt' ? 'selected' : ''; ?>>Bayburt</option>
                <option value="Karaman" <?php echo $ilver == 'Karaman' ? 'selected' : ''; ?>>Karaman</option>
                <option value="Kırıkkale" <?php echo $ilver == 'Kırıkkale' ? 'selected' : ''; ?>>Kırıkkale</option>
                <option value="Batman" <?php echo $ilver == 'Batman' ? 'selected' : ''; ?>>Batman</option>
                <option value="Şırnak" <?php echo $ilver == 'Şırnak' ? 'selected' : ''; ?>>Şırnak</option>
                <option value="Bartın" <?php echo $ilver == 'Bartın' ? 'selected' : ''; ?>>Bartın</option>
                <option value="Ardahan" <?php echo $ilver == 'Ardahan' ? 'selected' : ''; ?>>Ardahan</option>
                <option value="Iğdır" <?php echo $ilver == 'Iğdır' ? 'selected' : ''; ?>>Iğdır</option>
                <option value="Yalova" <?php echo $ilver == 'Yalova' ? 'selected' : ''; ?>>Yalova</option>
                <option value="Karabük" <?php echo $ilver == 'Karabük' ? 'selected' : ''; ?>>Karabük</option>
                <option value="Kilis" <?php echo $ilver == 'Kilis' ? 'selected' : ''; ?>>Kilis</option>
                <option value="Osmaniye" <?php echo $ilver == 'Osmaniye' ? 'selected' : ''; ?>>Osmaniye</option>
                <option value="Düzce" <?php echo $ilver == 'Düzce' ? 'selected' : ''; ?>>Düzce</option>


            </select>


            <?php if (!empty($ilver)) { ?>
                <label for="district">İlçe:</label>
                <select id="district" name="ilcever">
                    <option value="">İlçe seçin</option>
                    <?php 
                    $gosterilecekIlceler = [];
                    
                    if (is_array($eczaneler)) {
                        foreach ($eczaneler as $eczanm) {
                            $verimk = $eczanm["ililce"];
                            $parcalar = explode(" - ", $verimk);
                            $verison = isset($parcalar[1]) ? $parcalar[1] : null;
                            $verison = htmlspecialchars($verison);
                            
                            if (!in_array($verison, $gosterilecekIlceler)) {
                                $gosterilecekIlceler[] = $verison; ?>
                                <option value="<?php echo $verison; ?>" <?php echo $ilcever == $verison ? 'selected' : ''; ?>><?php echo $verison; ?></option>
                            <?php }
                        }
                    }
                    ?>
                </select>
            <?php } ?>

            <button type="submit">Eczaneleri Göster</button>
        </form>

        <div class="pharmacy-list">
            <h2>Nöbetçi Eczaneler</h2>
            <ul>
                <?php
                if ($_SERVER['REQUEST_METHOD'] == 'POST' && is_array($eczaneler)) {
                    foreach ($eczaneler as $eczane) {
                        echo '<li>';
                        echo '<h3>' . htmlspecialchars($eczane['name']) . '</h3>';
                        echo '<p>İl/ilçe: ' . htmlspecialchars($eczane['ililce']) . '</p>';
                        echo '<p>Adres: ' . htmlspecialchars($eczane['adress']) . '</p>';
                        echo '<p>Telefon: ' . htmlspecialchars($eczane['phone']) . '</p>';
                        echo '<p><a href="' . htmlspecialchars($eczane['description']) . '" target="_blank">Harita</a></p>';
                        echo '</li>';
                    }
                }
                ?>
            </ul>
        </div>
        </div>
    </main>
</body>
</html>
