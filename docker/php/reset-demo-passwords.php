<?php

/**
 * Waits for MariaDB then resets seeded account passwords.
 */
function parseDatabaseUrl(string $url): array
{
    $parts = parse_url($url);
    if ($parts === false || !isset($parts['host'], $parts['user'], $parts['path'])) {
        throw new RuntimeException('Invalid DATABASE_URL');
    }

    return [
        'dsn' => sprintf(
            'mysql:host=%s;port=%s;dbname=%s;charset=utf8mb4',
            $parts['host'],
            $parts['port'] ?? 3306,
            ltrim($parts['path'], '/')
        ),
        'user' => rawurldecode($parts['user']),
        'password' => rawurldecode($parts['pass'] ?? ''),
    ];
}

$url = getenv('DATABASE_URL');
if ($url === false || $url === '') {
    fwrite(STDERR, "DATABASE_URL is not set\n");
    exit(1);
}

$cfg = parseDatabaseUrl($url);
$password = getenv('DEMO_PASSWORD') ?: 'oculture';
$hash = password_hash($password, PASSWORD_BCRYPT, ['cost' => 13]);

$pdo = null;
for ($i = 0; $i < 60; $i++) {
    try {
        $pdo = new PDO($cfg['dsn'], $cfg['user'], $cfg['password'], [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ]);
        $pdo->query('SELECT 1 FROM app_user LIMIT 1');
        break;
    } catch (Throwable $e) {
        $pdo = null;
        sleep(1);
    }
}

if ($pdo === null) {
    fwrite(STDERR, "Database is not ready\n");
    exit(1);
}

$emails = [
    'admin@example.com',
    'moderator@example.com',
    'user@example.com',
    'artist@example.com',
    'organizer@example.com',
];
$stmt = $pdo->prepare('UPDATE app_user SET password = :hash WHERE email = :email');
$count = 0;
foreach ($emails as $email) {
    $stmt->execute(['hash' => $hash, 'email' => $email]);
    $count += $stmt->rowCount();
}
echo 'Demo passwords updated ('.$count.' users)'."\n";
