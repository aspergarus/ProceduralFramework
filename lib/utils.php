<?php

namespace Utils;

function container($key, $value = null) {
    static $innerData;

    if (empty($value)) {
        return $innerData[$key] ?? '';
    }

    $innerData[$key] = $value;
    return null;
}

function d($var, $name = '') {
    print "<pre>$name" . print_r($var, 1) . "</pre>";
}
