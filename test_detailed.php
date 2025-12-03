<?php
echo "=== Detailed PostgreSQL Debug ===\n";
echo "PHP Version: " . PHP_VERSION . "\n";
echo "PHP Path: " . PHP_BINARY . "\n";
echo "Extension Dir: " . ini_get('extension_dir') . "\n\n";

// Test loading each extension individually
echo "Testing pgsql extension:\n";
if (extension_loaded('pgsql')) {
    echo "✓ pgsql loaded successfully\n";
} else {
    echo "✗ pgsql failed to load\n";
    // Try to load manually
    if (dl('php_pgsql.dll')) {
        echo "✓ pgsql loaded manually\n";
    } else {
        echo "✗ pgsql manual load failed\n";
    }
}

echo "\nTesting pdo_pgsql extension:\n";
if (extension_loaded('pdo_pgsql')) {
    echo "✓ pdo_pgsql loaded successfully\n";
} else {
    echo "✗ pdo_pgsql failed to load\n";
    // Try to load manually
    if (dl('php_pdo_pgsql.dll')) {
        echo "✓ pdo_pgsql loaded manually\n";
    } else {
        echo "✗ pdo_pgsql manual load failed\n";
    }
}

echo "\nAll loaded extensions:\n";
$exts = get_loaded_extensions();
foreach ($exts as $ext) {
    if (strpos($ext, 'pgsql') !== false || strpos($ext, 'pdo') !== false) {
        echo "→ $ext\n";
    }
}
?>