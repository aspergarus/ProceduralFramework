<?php

namespace DB;

use function \Utils\container;

function openStorage() {
    $path = container("STORAGE_DIR") . '/main.qdbm';
    $db = dba_open($path, 'c', 'qdbm');

    container('DB', $db);
}

function closeStorage() {
    $db = container('DB');
    dba_close($db);
}

function insert($key, $value) {
    openStorage();
    $db = container('DB');

    if (is_array($value)) {
        $value = serialize($value);
    }

    dba_replace($key, $value, $db);

    closeStorage();
}

function remove($key) {
    openStorage();
    $db = container('DB');
    dba_delete($key, $db);
    closeStorage();
}

function get($key, $default = null) {
    openStorage();
    $db = container('DB');

    $res = dba_fetch($key, $db);
    closeStorage();

    // expecting array
    if (is_array($default)) {
        $res = unserialize($res);
    }

    return $res ?? $default;
}
