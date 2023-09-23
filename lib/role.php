<?php

namespace Role;

use function Auth\getUser;

function isAdmin($userName = null): bool
{
    if ($userName === null) {
        $userName = getUser();
    }

    return $userName !== '';
}
