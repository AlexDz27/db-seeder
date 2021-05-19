<?php

require_once 'vendor/autoload.php';

require_once 'db.php';
/** @var PDO $pdo */

$faker = Faker\Factory::create();

$stmt1 = $pdo->query('SELECT COUNT(*) FROM ' . TABLE_NAME);
$rowsCount = (int) $stmt1->fetch()[0];

$errors = [];
for ($i = 1; $i <= $rowsCount; $i++) {
  $dateObj = $faker->dateTimeThisDecade();
  $date = $dateObj->format('Y-m-d H:i:s');

  $sql = "UPDATE " . TABLE_NAME . " SET contract_date = '{$date}' WHERE id = {$i}";
  // Should be 1, not 0
  $rowsAffected = $pdo->exec($sql);

  if ($rowsAffected === 0) {
    $error = "Failed to update row with iteration index {$i}. The value that needed to be inserted: {$date}" . PHP_EOL;

    $errors[] = $error;
  }
}

if (empty($errors)) {
  echo 'All is OK.' . PHP_EOL;
} else {
  echo 'Got errors:' . PHP_EOL;
  print_r($errors);
}