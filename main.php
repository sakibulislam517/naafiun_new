<?php
ob_start();
session_start();
ini_set('max_execution_time', '3000');

$envPath = __DIR__ . DIRECTORY_SEPARATOR . '.env';
$env = [];
if (file_exists($envPath)) {
    $envLines = file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($envLines as $line) {
        $line = trim($line);
        if ($line === '' || strpos($line, '#') === 0 || strpos($line, '=') === false) {
            continue;
        }
        [$key, $value] = explode('=', $line, 2);
        $env[trim($key)] = trim($value);
    }
}

$host = isset($_SERVER['HTTP_HOST']) ? strtolower((string)$_SERVER['HTTP_HOST']) : '';
$isLocalHost = strpos($host, 'localhost') !== false || strpos($host, '127.0.0.1') !== false || strpos($host, '.test') !== false;

$domainValue = $isLocalHost
    ? ($env['LOCAL_DOMAIN'] ?? 'https://naafiun_new.test/')
    : ($env['DOMAIN'] ?? 'https://naafiun.hikmatech.com/demo/');

$dbNameValue = $isLocalHost
    ? ($env['LOCAL_DB_NAME'] ?? 'naafiun')
    : ($env['DB_NAME'] ?? 'naafiun');

$dbUserValue = $isLocalHost
    ? ($env['LOCAL_DB_USER'] ?? 'root')
    : ($env['DB_USER'] ?? 'root');

$dbPassValue = $isLocalHost
    ? ($env['LOCAL_DB_PASS'] ?? '')
    : ($env['DB_PASS'] ?? '');

$googleClientIdValue = $isLocalHost
    ? ($env['LOCAL_GOOGLE_CLIENT_ID'] ?? ($env['GOOGLE_CLIENT_ID'] ?? ''))
    : ($env['GOOGLE_CLIENT_ID'] ?? '');

define('domain', $domainValue);
define('DB_NAME', $dbNameValue);
define('DB_USER', $dbUserValue);
define('DB_PASS', $dbPassValue);
define('GOOGLE_CLIENT_ID', $googleClientIdValue);
define('FACEBOOK_APP_ID', $env['FACEBOOK_APP_ID'] ?? '');
define('FACEBOOK_APP_SECRET', $env['FACEBOOK_APP_SECRET'] ?? '');

spl_autoload_register(function($clsname){
    include_once 'config/'.$clsname.'.php';
});
$db = new Functions();
if (!isset($_SESSION['token'])) {
    $_SESSION['token'] = md5(time());
}
