<?php

namespace Flash;

function getMessages() {
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }

    $messages = $_SESSION['flash'] ?? [];

    unset($_SESSION['flash']);

    return $messages;
}

function setMessage($message, $style = 'success') {
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }

    $_SESSION['flash'][] = [
        'message' => $message,
        'style' => $style,
    ];
}
