<?php

declare(strict_types=1);
// phpinfo();

require_once('../Transaction.php');


$transaction_1 = new Transaction(100, 'Firmware Extractor');
$transaction_2 = new Transaction(200, 'Firmware Extractor');

$transaction_1->addTax(18);
$transaction_2->applyDiscount(10);



echo "<pre>";
var_dump($transaction_1->getAmount());
echo "</pre>";
