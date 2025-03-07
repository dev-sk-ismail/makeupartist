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
