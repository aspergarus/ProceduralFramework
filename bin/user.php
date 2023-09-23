<?php

if (empty($argv) || count($argv) < 2) {
    print <<<ECHO
Proper usage:\n
php ./bin/user.php <username> <password>\n

OR

php ./bin/user.php show
ECHO;
    exit();
}

require_once __DIR__ . "/../lib/utils.php";
require_once __DIR__ . "/../lib/db.php";

$userOrCommand = $argv[1];
$pass = password_hash($argv[2], PASSWORD_DEFAULT);

\Utils\container("STORAGE_DIR", __DIR__ . "/../storage");

$users = DB\get('users', []);

if ($userOrCommand === 'show') {
    print_r($users);
    exit();
}

$user = $userOrCommand;

$users[$user] = [
    'user' => $user,
    'pass' => $pass,
];

DB\insert('users', $users);

print "User $user was created\n";
