SQL Enjeksiyon Testi Aracı
Bu araç, verilen URL üzerinde SQL enjeksiyonu açıklarını tespit etmeye yardımcı olan basit bir test aracıdır. Aracın, farklı SQL enjeksiyon payload'ları kullanarak hedef siteyi test etmesine olanak tanır. Kullanıcılar, herhangi bir hedef URL'yi belirterek potansiyel güvenlik açıklarını hızlı bir şekilde kontrol edebilirler.

Özellikler:
SQL Enjeksiyon Testi: Verilen URL üzerinde farklı SQL enjeksiyonu payload'larını test eder.

Proxy Desteği: Bağlantılarınızı bir proxy üzerinden geçirebilirsiniz.

Çeşitli Hata Algoritmaları: MySQL, PostgreSQL, MSSQL, Oracle gibi farklı veritabanı sistemlerini test edebilir.

Zaman Tabanlı SQL Enjeksiyon Testi: Veritabanı yanıtlarını izleyerek zaman tabanlı SQL enjeksiyonu testleri yapar.

Kurulum ve Kullanım:
Gerekli Bağımlılıklar:

PHP 7.0 ve üzeri yüklü olmalıdır.

cURL PHP uzantısı yüklü olmalıdır.

Kodun Çalıştırılması:

Bu dosyayı bir PHP sunucusuna yükleyin veya yerel olarak çalıştırın.

Aşağıdaki gibi bir GET isteği göndererek aracı kullanabilirsiniz.

Örnek GET İsteği:
php-template
Kopyala
Düzenle
http://<sunucu_adresi>/sql_injection_tester.php?url=<hedef_sitenin_url>
Eğer proxy kullanmak isterseniz, proxy parametresi ekleyebilirsiniz:

php-template
Kopyala
Düzenle
http://<sunucu_adresi>/sql_injection_tester.php?url=<hedef_sitenin_url>&proxy=<proxy_adresi>
Parametreler:
url: Test etmek istediğiniz hedef web sitesi URL'si. Bu parametre zorunludur.

proxy: İsteği göndermek için kullanmak istediğiniz proxy sunucu adresi. (Opsiyonel)

Yanıt:
Aracın cevabı JSON formatında dönecektir. Yanıt, aşağıdaki bilgileri içerir:

status: İşlem durumu ("başarılı" veya "hata").

results: Test edilen payload'lar ve yanıtlar hakkında detaylı bilgiler.

vulnerabilities: Bulunan SQL enjeksiyonu açıkları.

http_code: HTTP yanıt kodu.

elapsed_time: Test süresi.

Örnek Yanıt:
json
Kopyala
Düzenle
{
    "status": "başarılı",
    "url": "http://example.com",
    "results": [
        {
            "payload": "' OR 1=1 --",
            "status": "Açık bulundu: MySQL hatası",
            "http_code": 200,
            "elapsed_time": 1.23,
            "db_type": "MySQL",
            "vulnerable_url": "http://example.com?page=' OR 1=1 --",
            "vulnerability_type": "SQL Enjeksiyonu",
            "confidence": 95
        }
    ],
    "vulnerability_count": 1
}
Uyarılar:
Bu araç, yalnızca güvenli ve etik kullanım için tasarlanmıştır. Başka kişilere ait web sitelerinde izinsiz testler yapmanız yasalara aykırıdır.

Gerçek bir web sitesinde test yapmadan önce, test yapacağınız site sahiplerinden izin aldığınızdan emin olun.