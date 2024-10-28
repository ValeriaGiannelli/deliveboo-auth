<?php

$sales = [];

for ($i = 0; $i < 50; $i++) {
    // Generiamo una data casuale tra ottobre dell'anno scorso e questo ottobre
    $startTimestamp = strtotime('-1 year October');
    $endTimestamp = strtotime('October');
    $randomTimestamp = mt_rand($startTimestamp, $endTimestamp);
    $createdAt = date('Y-m-d H:i:s', $randomTimestamp);

    // Generiamo dati unici usando l'indice $i per evitare duplicazioni
    $sales[] = [
        'full_name' => "Cliente $i",
        'email' => "cliente$i@example.com",
        'address' => "Via Esempio $i, Città $i",
        'total_price' => rand(0, 100) + rand(0, 99) / 100, // Prezzo casuale tra 0 e 100 con decimali
        'phone_number' => "123-456-78" . str_pad($i, 2, '0', STR_PAD_LEFT),
        'created_at' => $createdAt,
    ];
}

return [
    'sales' => $sales,
];