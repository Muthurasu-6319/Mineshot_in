<?php
// admin/migrate.php - Safe database schema migration utility
header('Content-Type: text/plain; charset=utf-8');

require_once __DIR__ . '/auth.php';
requireAdminAuth();

echo "=== Mineshot Database Migration ===\n\n";

$pdo = getDBConnection();
if (!$pdo) {
    echo "ERROR: Failed to connect to database. Please check your DB credentials in .env\n";
    exit(1);
}

echo "Database connection established.\n";
echo "Applying database schema definitions...\n";

try {
    ensureDatabaseSchema($pdo);
    echo "SUCCESS: Database schema and tables verified.\n";

    // Verify tables
    $tables = ['admin_users', 'projects_gallery'];
    foreach ($tables as $t) {
        $stmt = $pdo->query("SELECT COUNT(*) FROM {$t}");
        $count = $stmt->fetchColumn();
        echo " - Table '{$t}': OK ({$count} records)\n";
    }
    echo "\nMigration completed successfully!\n";
} catch (Throwable $e) {
    echo "ERROR during migration: " . $e->getMessage() . "\n";
    exit(1);
}
