<?php
/**
 * Download media files from the live site based on DB references
 * Run inside the WordPress container
 */

// Bootstrap WordPress
define('ABSPATH', '/var/www/html/');
require_once ABSPATH . 'wp-load.php';

global $wpdb;

// Get all unique image URLs from post content and attachment metadata
$urls = [];

// 1. From post content
$contents = $wpdb->get_col("SELECT post_content FROM {$wpdb->posts} WHERE post_status = 'publish' AND post_content != ''");
foreach ($contents as $content) {
    // Match wp-content/uploads paths
    if (preg_match_all('#(?:https?://[^"\'>\s]*)?/wp-content/uploads/([^"\'>\s\)]+)#', $content, $matches)) {
        foreach ($matches[1] as $path) {
            $path = urldecode($path);
            $urls[$path] = true;
        }
    }
}

// 2. From attachment metadata (guid)
$attachments = $wpdb->get_col("SELECT guid FROM {$wpdb->posts} WHERE post_type = 'attachment'");
foreach ($attachments as $guid) {
    if (preg_match('#/wp-content/uploads/(.+)$#', $guid, $m)) {
        $path = urldecode($m[1]);
        $urls[$path] = true;
    }
}

// 3. From postmeta (_wp_attached_file)
$files = $wpdb->get_col("SELECT meta_value FROM {$wpdb->postmeta} WHERE meta_key = '_wp_attached_file'");
foreach ($files as $file) {
    $urls[$file] = true;
}

$upload_dir = wp_upload_dir()['basedir'];
$base_url = 'https://www.glory.org.tw/wp-content/uploads/';
$total = count($urls);
$downloaded = 0;
$skipped = 0;
$failed = 0;

echo "Found $total unique media files to download\n";

foreach (array_keys($urls) as $path) {
    $local_path = $upload_dir . '/' . $path;
    
    // Skip if already exists
    if (file_exists($local_path)) {
        $skipped++;
        continue;
    }
    
    // Create directory
    $dir = dirname($local_path);
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }
    
    // Download from live site
    $url = $base_url . rawurlencode(str_replace('/', '|||', $path));
    // Actually encode each path segment separately
    $segments = explode('/', $path);
    $encoded_segments = array_map('rawurlencode', $segments);
    $url = $base_url . implode('/', $encoded_segments);
    
    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_CONNECTTIMEOUT => 10,
        CURLOPT_USERAGENT => 'Mozilla/5.0 (compatible; GloryMigration/1.0)',
        CURLOPT_SSL_VERIFYPEER => false,
    ]);
    
    $data = curl_exec($ch);
    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    if ($code === 200 && $data && strlen($data) > 100) {
        file_put_contents($local_path, $data);
        $downloaded++;
        if ($downloaded % 20 === 0) {
            echo "Progress: $downloaded downloaded, $skipped skipped, $failed failed / $total total\n";
        }
    } else {
        $failed++;
    }
}

echo "\n=== COMPLETE ===\n";
echo "Downloaded: $downloaded\n";
echo "Skipped (exist): $skipped\n";
echo "Failed: $failed\n";
echo "Total: $total\n";
