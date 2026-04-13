<?php
// Site Configuration for Padua Bundal Transient House
define('SITE_NAME', 'Padua Bundal Transient House');
define('SITE_EMAIL', 'info@paduabundal.com');
define('ADMIN_EMAIL', 'paduabundal@gmail.com');

// Contact Information
define('PHONE_1', '094937352324');
define('PHONE_2', '09398230290');
define('LOCATION', 'Abagatanen Beach, Agno, Pangasinan');

// Optional Database (set your credentials if using DB)
$pdo = null;
if (file_exists(__DIR__ . '/db_config.php')) {
    @include __DIR__ . '/db_config.php';
}
?>