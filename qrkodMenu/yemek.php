<?php

header('Content-Type: application/json');


$menu_items = [
    [
        'yemekid' => '1',
        'image' => 'pizza.webp',
        'alt' => 'Lezzetli Pizza',
        'title' => 'Lezzetli Pizza',
        'description' => 'İtalyan usulü taze domates, mozzarella ve fesleğenle hazırlanmış pizza.',
        'price' => '₺45.00',
        'icerik' => [
            'İtalyan Usulü Mozzarella Peyniri',
            'Taze Domates Sosu',
            'Fesleğen Yaprakları',
            'Özel Zeytinyağı Sosu',
            'Baharatlı Kekik'
        ],
        'benzer_urunler' => [
            ['title' => 'Sucuklu Pizza', 'image' => 'pizza.webp', 'price' => '₺00.00'],
            ['title' => 'Margarita Pizza', 'image' => 'pizza.webp', 'price' => '₺00.00']
        ]
    ],
    [
        'yemekid' => '2',
        'image' => '2cburger.png',
        'alt' => 'Çifte Peynirli Burger',
        'title' => 'Çifte Peynirli Burger',
        'description' => 'Yumuşak ekmek arası, iki kat peynir ve özel soslarla burger.',
        'price' => '₺30.00',
        'icerik' => [
            'Simit Ekmeği',
            'İki Kat Peynir',
            'Marullı',
            'İçinde Patates Kızartması',
            'Köfte'
        ],
        'benzer_urunler' => [
            ['title' => 'Sebzeli Burger', 'image' => '2cburger.png', 'price' => '₺00.00'],
            ['title' => 'Tavuklu Burger', 'image' => '2cburger.png', 'price' => '₺00.00']
        ]
    ],
    [
        'yemekid' => '3',
        'image' => 'cpasta.png',
        'alt' => 'Çikolatalı Pasta',
        'title' => 'Çikolatalı Pasta',
        'description' => 'Zengin çikolata sosu ve taze meyvelerle servis edilen tatlı.',
        'price' => '₺35.00',
        'icerik' => [
            'Çikolata Sosu',
            'Taze Çilek',
            'Beyaz Çikolata'
        ],
        'benzer_urunler' => [
            ['title' => 'Muzlu Pasta', 'image' => 'cpasta.png', 'price' => '₺00.00'],
            ['title' => 'Kremalı Çikolata', 'image' => 'cpasta.png', 'price' => '₺00.00']
        ]
    ],
    [
        'yemekid' => '4',
        'image' => 'akdeniz-salata.png',
        'alt' => 'Akdeniz Salatası',
        'title' => 'Akdeniz Salatası',
        'description' => 'Çeşitli yeşillikler, zeytinyağı ve limon sosuyla sağlıklı bir seçenek.',
        'price' => '₺20.00',
        'icerik' => [
            'Marulları',
            'Domates',
            'Salatalık',
            'Zeytinyağı ve Limon Sosu'
        ],
        'benzer_urunler' => [
            ['title' => 'Yunan Salatası', 'image' => 'akdeniz-salata.png', 'price' => '₺00.00'],
            ['title' => 'Çoban Salata', 'image' => 'akdeniz-salata.png', 'price' => '₺00.00']
        ]
    ],
    [
        'yemekid' => '5',
        'image' => 'tavuk-suyu-corbasi.png',
        'alt' => 'Soğuk Çorba',
        'title' => 'Çorba',
        'description' => 'Taze, Kemik Suyu ile yapılan çorba.',
        'price' => '₺15.00',
        'icerik' => [
            'Kemik Suyu',
            'Taze Sebzeler'
        ],
        'benzer_urunler' => [
            ['title' => 'Mercimek Çorbası', 'image' => 'tavuk-suyu-corbasi.png', 'price' => '₺00.00'],
            ['title' => 'Yayla Çorbası', 'image' => 'tavuk-suyu-corbasi.png', 'price' => '₺00.00']
        ]
    ]
];

echo json_encode($menu_items, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

?>
