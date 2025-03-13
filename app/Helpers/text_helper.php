<?php

function slugify($string)
{
    // Convert the string to lowercase
    $string = strtolower($string);

    // Remove special characters
    $string = preg_replace('/[^a-z0-9\s-]/', '', $string);

    // Replace spaces and multiple hyphens with a single hyphen
    $string = preg_replace('/[\s-]+/', '-', $string);

    // Trim hyphens from the beginning and end of the string
    $string = trim($string, '-');

    return $string;
}


function excerpt($text, $length = 100, $suffix = '...')
{
    // Remove any HTML tags
    $text = strip_tags($text);

    // Trim whitespace
    $text = trim($text);

    // If the text is already shorter than the max length, return it
    if (mb_strlen($text, 'UTF-8') <= $length) {
        return $text;
    }

    // Truncate the text
    $text = mb_substr($text, 0, $length, 'UTF-8');

    // Ensure we don't cut off in the middle of a word
    $position = mb_strrpos($text, ' ', 0, 'UTF-8');
    if ($position !== false) {
        $text = mb_substr($text, 0, $position, 'UTF-8');
    }

    // Add the suffix
    return $text . $suffix;
}
