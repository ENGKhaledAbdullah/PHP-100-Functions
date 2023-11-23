<?php
function convertToUppercase($string)
{
    $uppercaseString = '';
    for ($i = 0; $i < customStrlen($string); $i++) {
        $char = $string[$i];
        if ($char >= 'a' && $char <= 'z') {
            // Convert lowercase letter to uppercase
            $char = chr(ord($char) - 32);
        }
        $uppercaseString .= $char;
    }
    return $uppercaseString;
}
function convertToLowercase($string)
{
    $lowercaseString = '';
    for ($i = 0; $i < customStrlen($string); $i++) {
        $char = $string[$i];
        if ($char >= 'A' && $char <= 'Z') {
            // Convert uppercase letter to lowercase
            $char = chr(ord($char) + 32);
        }
        $lowercaseString .= $char;
    }
    return $lowercaseString;
}
function countInput($string)
{
    $count = 0;
    for ($i = 0; $i < customStrlen($string); $i++) {
        // Increment the count for each character
        $count++;
    } 
    return $count;
}
function arrayLength($arr)
{
    $count = 0;
    foreach ($arr as $element) {
        // Increment the count for each element in the array
        $count++;
    }
    return $count;
}
function objectLength($obj)
{
    $count = 0;
    foreach ($obj as $propertyValue) {
        // Increment the count for each property in the object
        $count++;
    }
    return $count;
}
function isWordCharacter($char) {
    // Define what characters are considered as word characters
    $wordCharacters = array('-', '_', '@', '#','=','+','*','/','$','%','^','&','!','?'); // Add more characters if needed

    // Check if the character is a word character
    return ctype_alnum($char) || in_array($char, $wordCharacters);
}
function wordCounter($string) {
    $wordCounter = 0;
    $wordInProgress = false;

    for ($i = 0; $i < customStrlen($string); $i++) {
        $char = $string[$i];

        if (isWordCharacter($char)) {
            if (!$wordInProgress) {
                $wordCounter++;
                $wordInProgress = true;
            }
        } else {
            $wordInProgress = false;
        }
    }

    return $wordCounter;
}

function custom_isset($string){
    if($string === null)  
        return false;
    return true;
}
function customStrlen($string) {
    $length = 0;
    $index = 0;
    
    while (custom_isset($string[$index])) {
        $length++;
        $index++;
    }
    
    return $length;
}

function gettype_custom($variable) {
    if ($variable === null) {
        return 'NULL';
    } elseif ($variable === true || $variable === false) {
        return 'boolean';
    } elseif (is_numeric($variable) && (int)$variable == $variable) {
        return 'integer';
    } elseif (is_numeric($variable) && (float)$variable == $variable) {
        return 'double';
    } elseif (is_string($variable)) {
        return 'string';
    } elseif (is_array($variable)) {
        return 'array';
    } elseif (is_object($variable)) {
        return 'object';
    } elseif (is_resource($variable)) {
        return 'resource';
    } else {
        return 'unknown type';
    }
}

// Custom type-checking 
function is_bool_custom_type($variable) {
    return gettype_custom($variable) === 'boolean';
}

function is_int_custom_type($variable) {
    return gettype_custom($variable) === 'integer';
}

function is_float_custom_type($variable) {
    return gettype_custom($variable) === 'double';
}

function is_string_custom_type($variable) {
    return gettype_custom($variable) === 'string';
}

function is_array_custom_type($variable) {
    return gettype_custom($variable) === 'array';
}

function is_object_custom_type($variable) {
    return gettype_custom($variable) === 'object';
}

function is_resource_custom_type($variable) {
    return gettype_custom($variable) === 'resource';
}

function is_bool_custom($variable) {
    return is_bool_custom_type($variable);
}

function is_int_custom($variable) {
    return is_int_custom_type($variable);
}

function is_float_custom($variable) {
    return is_float_custom_type($variable);
}

function is_string_custom($variable) {
    return is_string_custom_type($variable);
}

function is_array_custom($variable) {
    return is_array_custom_type($variable);
}

function is_object_custom($variable) {
    return is_object_custom_type($variable);
}

function is_resource_custom($variable) {
    return is_resource_custom_type($variable);
}

function empty_custom($variable) {
    if ($variable === null) {
        return true;
    }

    if (is_string_custom($variable) || is_array_custom($variable)) {
        return count($variable) === 0;
    }

    return empty($variable);
}

function max_custom(...$values) {
    if (empty_custom($values)) {
        return null;
    }

    $maxValue = $values[0];
    foreach ($values as $value) {
        if ($value > $maxValue) {
            $maxValue = $value;
        }
    }

    return $maxValue;
}

function min_custom(...$values) {
    if (empty_custom($values)) {
        return null;
    }

    $minValue = $values[0];
    foreach ($values as $value) {
        if ($value < $minValue) {
            $minValue = $value;
        }
    }

    return $minValue;
}

function custom_array_push(&$array, ...$elements) {
    foreach ($elements as $element) {
        $array[] = $element;
    }
    return countInput($array);
}
function custom_array_merge(...$arrays) {
    $result = [];
    foreach ($arrays as $array) {
        foreach ($array as $element) {
            $result[] = $element;
        }
    }
    return $result;
}
function custom_array_search($needle, $array) {
    foreach ($array as $key => $value) {
        if ($value === $needle) {
            return $key;
        }
    }
    return false;
}
function custom_in_array($needle, $array) {
    foreach ($array as $value) {
        if ($value === $needle) {
            return true;
        }
    }
    return false;
}
function custom_array_slice($array, $offset, $length = null, $preserveKeys = false) {
    $length = ($length === null) ? countInput($array) - $offset : $length;
    $sliced = [];

    for ($i = $offset; $i < $offset + $length; $i++) {
        if ($preserveKeys) {
            $sliced[$i] = $array[$i];
        } else {
            $sliced[] = $array[$i];
        }
    }

    return $sliced;
}

function custom_array_keys($array, $searchValue = null, $strict = false) {
    $keys = [];

    foreach ($array as $key => $value) {
        if ($searchValue !== null) {
            if ($strict && $value === $searchValue) {
                $keys[] = $key;
            } elseif (!$strict && $value == $searchValue) {
                $keys[] = $key;
            }
        } else {
            $keys[] = $key;
        }
    }

    return $keys;
}

function custom_array_values($array) {
    $values = [];

    foreach ($array as $value) {
        $values[] = $value;
    }

    return $values;
}

function custom_array_reverse($array, $preserveKeys = false) {
    $reversed = [];
    $keys = custom_array_keys($array);
    $numElements = count($array);

    if ($preserveKeys) {
        for ($i = $numElements - 1; $i >= 0; $i--) {
            $reversed[$keys[$i]] = $array[$keys[$i]];
        }
    } else {
        for ($i = $numElements - 1; $i >= 0; $i--) {
            $reversed[] = $array[$keys[$i]];
        }
    }

    return $reversed;
}
function custom_array_splice(&$array, $offset, $length = null, ...$replacement) {
    $length = ($length === null) ? countInput($array) - $offset : $length;
    $extracted = [];

    // Extract the elements to be removed
    for ($i = $offset; $i < $offset + $length; $i++) {
        $extracted[] = $array[$i];
    }

    // Remove the elements from the array
    for ($i = $offset; $i < $offset + $length; $i++) {
        unset($array[$i]);
    }

    // Insert the replacement elements into the array
    $array = custom_array_merge(
        custom_array_slice($array, 0, $offset),
        $replacement,
        custom_array_slice($array, $offset)
    );

    // Reset array keys
    $array = custom_array_values($array);

    return $extracted;
}
function custom_implode($delimiter, $content) {
    $result = '';

    $numPieces = countInput($content);
    for ($i = 0; $i < $numPieces; $i++) {
        $result .= $content[$i];

        if ($i < $numPieces - 1) {
            $result .= $delimiter;
        }
    }

    return $result;
}
function custom_strpos($haystack, $needle, $offset = 0) {
    $length = customStrlen($needle);
    $haystackLength = customStrlen($haystack);

    for ($i = $offset; $i <= $haystackLength - $length; $i++) {
        $found = true;

        for ($j = 0; $j < $length; $j++) {
            if ($haystack[$i + $j] !== $needle[$j]) {
                $found = false;
                break;
            }
        }

        if ($found) {
            return $i;
        }
    }

    return false;
}

function custom_substr($string, $start, $length = null) {
    $stringLength = customStrlen($string);
    
    // Handle negative start position
    if ($start < 0) {
        $start = max_custom($stringLength + $start, 0);
    }
    
    // Handle negative length
    if ($length !== null && $length < 0) {
        $length = max_custom($stringLength + $length - $start, 0);
    }
    
    $result = '';
    
    for ($i = $start; $i < $stringLength && ($length === null || $i - $start < $length); $i++) {
        $result .= $string[$i];
    }
    
    return $result;
}

function custom_substr_replace($string, $replacement, $start, $length = null) {
    if ($length === null) {
        $length = customStrlen($string) - $start;
    }

    $stringLength = customStrlen($string);
    $replacementLength = customStrlen($replacement);

    $result = '';

    // Copy characters before the replacement
    if ($start > 0) {
        $result .= custom_substr($string, 0, $start);
    }

    // Insert the replacement
    $result .= $replacement;

    // Copy characters after the replacement
    if ($start + $length < $stringLength) {
        $result .= custom_substr($string, $start + $length);
    }

    return $result;
}

function custom_str_replace($search, $replace, $subject, &$count = null) {
    $count = 0;

    if (!is_array_custom($search)) {
        $search = [$search];
        $replace = [$replace];
    }

    foreach ($search as $key => $value) {
        while (($pos = custom_strpos($subject, $value)) !== false) {
            $subject = custom_substr_replace($subject, $replace[$key], $pos, strlen($value));
            $count++;
        }
    }

    return $subject;
}


?>