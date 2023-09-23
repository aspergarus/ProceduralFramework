<?php

namespace Flash;

function getMessage() {
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }

    $message = $_SESSION['flash'] ?? '';

    unset($_SESSION['flash']);

    return $message;
}

function setMessage($message, $style = 'success') {
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }

    $_SESSION['flash'] = [
        'message' => $message,
        'style' => $style,
    ];
}
