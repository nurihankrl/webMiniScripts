<?php

if (!isset($_GET["ilver"])) {
    header('Content-Type: application/json');
    echo json_encode(['error' => 'Parameters "il" (city) and "ilce" (district) are required.'], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    exit;
}

$ilver = isset($_GET["ilver"]) ? $_GET["ilver"] : null;
$ilcever = isset($_GET["ilcever"]) ? $_GET["ilcever"] : null;

function fetchAndParseHtml($url) {
    $html = file_get_contents($url);
    if ($html === false) {
        header('Content-Type: application/json');
        echo json_encode(['error' => 'Failed to fetch HTML.'], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        exit;
    }

    $dom = new DOMDocument();
    @$dom->loadHTML($html);
    $xpath = new DOMXPath($dom);

    function removeElementByTagName($dom, $tagName) {
        $xpath = new DOMXPath($dom);
        $elements = $xpath->query("//" . $tagName);
        foreach ($elements as $element) {
            $element->parentNode->removeChild($element);
        }
    }

    function removeAttribute($dom, $attributeName) {
        foreach ($dom->getElementsByTagName('*') as $element) {
            if ($element->hasAttribute($attributeName)) {
                $element->removeAttribute($attributeName);
            }
        }
    }

    removeElementByTagName($dom, 'style');
    removeElementByTagName($dom, 'title');
    removeAttribute($dom, 'title');
    removeAttribute($dom, 'target');
    removeElementByTagName($dom, 'span');
    removeElementByTagName($dom, 'i');
    foreach ($dom->getElementsByTagName('*') as $element) {
        if ($element->hasAttribute('style')) {
            $element->removeAttribute('style');
        }
    }

    $nodes = $xpath->query("//ul[contains(@class, 'list-group')]");
    if ($nodes->length == 0) {
        header('Content-Type: application/json');
        echo json_encode(['error' => 'No list-group found.'], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        exit;
    }

    $data = [];
    foreach ($nodes as $node) {
        $listItems = $xpath->query('.//li', $node);

        $item = [
            'name' => '',
            'ililce' => '',
            'description' => '',
            'phone' => '',
			'adress' => ''
        ];

        foreach ($listItems as $index => $listItem) {
            $text = trim($listItem->textContent);
            $hrefs = $xpath->query('.//a', $listItem);
            $hrefValue = $hrefs->length > 0 ? $hrefs->item(0)->getAttribute('href') : '';

            if (strpos($text, 'Yol Tarifi') !== false) {
                $mapLink = $xpath->query('.//a[contains(@href, "https://www.google.com/maps")]', $listItem);
                if ($mapLink->length > 0) {
                    $item['description'] = '' . $mapLink->item(0)->getAttribute('href');
                }
            }
			

            if ($index == 0) {
                $item['name'] = strip_tags($text);
            } elseif ($index == 1) {
                $item['ililce'] = strip_tags($text);
            } elseif ($index == 3) {
                 $item['phone'] = trim($text);
            } elseif ($index == 2) {
                $item['adress'] = trim($text);
            }
			
        }

        $data[] = $item;
    }

    header('Content-Type: application/json');
    echo json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
}


if ($ilver) {
    if (!$ilcever) {
        $iframeUrl = "https://eczaneleri.net/api/new-iframe?type=default-iframe&city=".$ilver."&color1=00d2d3&color2=17a2b8";
    } 
    else {
        $iframeUrl = "https://eczaneleri.net/api/new-iframe?type=default-iframe&city=" . urlencode($ilver) . "&county=" . urlencode($ilcever) . "&color1=00d2d3&color2=17a2b8";
    }
}


fetchAndParseHtml($iframeUrl);
?>
