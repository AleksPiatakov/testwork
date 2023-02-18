<?php

namespace App\Classes\Cache;

trait RetrievesMultipleKeys
{
    /**
     * Retrieve multiple items from the cache by key.
     * Items not found in the cache will have a null value.
     */
    public function many(array $keys): array
    {
        $return = [];

        foreach ($keys as $key) {
            $return[$key] = $this->get($key);
        }

        return $return;
    }

    /**
     * Store multiple items in the cache for a given number of seconds.
     * @param array $values
     * @param int $seconds
     * @return bool
     */
    public function putMany(array $values, $seconds)
    {
        $manyResult = null;

        foreach ($values as $key => $value) {
            $result = $this->put($key, $value, $seconds);

            $manyResult = is_null($manyResult) ? $result : $result && $manyResult;
        }

        return $manyResult ?: false;
    }
}