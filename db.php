<?php

const PATH = '/home/aliaksei/sharks.db';
const TABLE_NAME = 'german_credit';

/** @var PDO $pdo */
$pdo = new PDO('sqlite:' . PATH);