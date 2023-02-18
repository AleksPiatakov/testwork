<?php

/**
 * @param string $constantName
 * @param mixed $default
 * @return mixed|string
 */
function getConstantValue($constantName, $default = '')
{
    return defined($constantName) ? constant($constantName) : $default;
}
