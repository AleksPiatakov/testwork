<?php

function lowerTags($matches)
{
    return strtolower($matches[1]);
}

function srcTrimSpaces($matches)
{
    return str_replace([' / ', '/ ', ' .'], ['/', '/', '.'], $matches[1]);
}
