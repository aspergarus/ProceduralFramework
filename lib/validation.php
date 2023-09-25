<?php

namespace Validation;

/**
 * @param $inputData
 * @param $rules
 * @return array
 *  First parameter is the validated data, second is the errors.
 */
function validate($inputData, $rules): array {
    $res = [
        'valid' => [],
        'errors' => []
    ];

    foreach ($inputData as $name => $value) {
        if (empty($rules[$name])) {
            $res['valid'][$name] = $value;
            continue;
        }

        [$valid, $error] = validateByRule($rules[$name], $value);
        if (!empty($error)) {
            $res['errors'][$name] = $error;
        } else {
            $res['valid'][$name] = $valid;
        }
    }

    return [$res['valid'], $res['errors']];
}

function validateByRule($rule, $data): array {
    $ruleParts = explode('|', $rule);
    if ($ruleParts[0] === 'str') {
        $data = filter_var($data, FILTER_SANITIZE_SPECIAL_CHARS);
        [$min, $max] = explode("..", $ruleParts[1]);

        if (strlen($data) < $min || strlen($data) > $max) {
            return [$data, 'string is out of range'];
        }

        return [$data, ''];
    }

    return [$data, 'unsupported rule'];
}
