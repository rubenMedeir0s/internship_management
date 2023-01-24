<?php

function hashPassword($password) {
    $options = [
        'memory_cost' => 1<<17,
        'time_cost' => 4,
        'threads' => 3
    ];
    return password_hash($password, PASSWORD_ARGON2I, $options);
}

?>