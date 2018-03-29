<?php
/**
 * Created by PhpStorm.
 * User: JRokH
 * Date: 2018-03-29
 * Time: 오후 4:39
 */
$settings = [
    'host' => 'localhost',
    'port' => '3306',
    'name' => 'comen_test',
    'username' => 'test',
    'password' => 'test1234',
    'charset' => 'utf8'
];

$dsn = 'mysql:host='.$settings['host'].';dbname='.$settings['name'].';port='.$settings['port'].';charset='.$settings['charset'];
$db_user = $settings['username'];
$db_pwd = $settings['password'];

try {
    $pdo = new PDO($dsn,$db_user,$db_pwd);
} catch (PDOException $e) {
}