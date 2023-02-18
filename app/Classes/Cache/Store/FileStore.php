<?php

declare(strict_types=1);

namespace App\Classes\Cache\Store;

use App\Classes\Cache\Contracts\Store;
use App\Classes\Cache\InteractsWithTime;
use App\Classes\Cache\RetrievesMultipleKeys;
use App\Classes\Filesystem\Filesystem;
use Exception;

final class FileStore implements Store
{
    use InteractsWithTime;
    use RetrievesMultipleKeys;

    protected Filesystem $files;

    /**
     * The file cache directory.
     */
    protected string $directory;

    /**
     * Octal representation of the cache file permissions.
     */
    protected ?int $filePermission = null;

    /**
     * Create a new file cache store instance.
     */
    public function __construct(Filesystem $files, string $directory, ?int $filePermission = null)
    {
        $this->files = $files;
        $this->directory = $directory;
        $this->filePermission = $filePermission;
    }

    /**
     * Retrieve an item from the cache by key.
     * @param string|array $key
     */
    public function get($key)
    {
        return $this->getPayload($key)['data'] ?? null;
    }

    /**
     * Store an item in the cache for a given number of seconds.
     * @param string $key
     * @param mixed $value
     * @param int $seconds
     */
    public function put($key, $value, $seconds): bool
    {
        $this->ensureCacheDirectoryExists($path = $this->path($key));

        $result = $this->files->put(
            $path,
            $this->expiration($seconds) . serialize($value),
            true
        );

        if ($result !== false && $result > 0) {
            $this->ensureFileHasCorrectPermissions($path);

            return true;
        }

        return false;
    }

    /**
     * Create the file cache directory if necessary.
     */
    protected function ensureCacheDirectoryExists(string $path): void
    {
        if (!$this->files->exists(dirname($path))) {
            $this->files->makeDirectory(dirname($path), 0777, true, true);
        }
    }

    /**
     * Ensure the cache file has the correct permissions.
     */
    protected function ensureFileHasCorrectPermissions(string $path): void
    {
        if (is_null($this->filePermission) ||
            intval($this->files->chmod($path), 8) == $this->filePermission) {
            return;
        }

        $this->files->chmod($path, $this->filePermission);
    }

    /**
     * Increment the value of an item in the cache.
     * @param string $key
     * @param mixed $value
     */
    public function increment($key, $value = 1): int
    {
        $raw = $this->getPayload($key);

        return tap(((int)$raw['data']) + $value, function ($newValue) use ($key, $raw) {
            $this->put($key, $newValue, $raw['time'] ?? 0);
        });
    }

    /**
     * Decrement the value of an item in the cache.
     * @param string $key
     * @param mixed $value
     */
    public function decrement($key, $value = 1): int
    {
        return $this->increment($key, $value * -1);
    }

    /**
     * Store an item in the cache indefinitely.
     * @param string $key
     * @param mixed $value
     * @return bool
     */
    public function forever($key, $value): bool
    {
        return $this->put($key, $value, 0);
    }

    /**
     * Remove an item from the cache.
     * @param string $key
     */
    public function forget($key): bool
    {
        if ($this->files->exists($file = $this->path($key))) {
            return $this->files->delete($file);
        }

        return false;
    }

    /**
     * Remove all items from the cache.
     */
    public function flush(): bool
    {
        if (!$this->files->isDirectory($this->directory)) {
            return false;
        }

        foreach ($this->files->directories($this->directory) as $directory) {
            $deleted = $this->files->deleteDirectory($directory);

            if (!$deleted || $this->files->exists($directory)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Retrieve an item and expiry time from the cache by key.
     */
    protected function getPayload(string $key): array
    {
        $path = $this->path($key);

        // If the file doesn't exist, we obviously cannot return the cache so we will
        // just return null. Otherwise, we'll get the contents of the file and get
        // the expiration UNIX timestamps from the start of the file's contents.
        try {
            $expire = substr(
                $contents = $this->files->get($path, true),
                0,
                10
            );
        } catch (Exception $e) {
            return $this->emptyPayload();
        }

        // If the current time is greater than expiration timestamps we will delete
        // the file and return null. This helps clean up the old files and keeps
        // this directory much cleaner for us as old files aren't hanging out.
        if ($this->currentTime() >= $expire) {
            $this->forget($key);

            return $this->emptyPayload();
        }

        try {
            $data = unserialize(substr($contents, 10));
        } catch (Exception $e) {
            $this->forget($key);

            return $this->emptyPayload();
        }

        // Next, we'll extract the number of seconds that are remaining for a cache
        // so that we can properly retain the time for things like the increment
        // operation that may be performed on this cache on a later operation.
        $time = $expire - $this->currentTime();

        return compact('data', 'time');
    }

    /**
     * Get a default empty payload for the cache.
     */
    protected function emptyPayload(): array
    {
        return ['data' => null, 'time' => null];
    }

    /**
     * Get the full path for the given cache key.
     */
    protected function path(string $key): string
    {
        $parts = array_slice(str_split($hash = sha1($key), 2), 0, 2);

        return $this->directory . '/' . implode('/', $parts) . '/' . $hash;
    }

    /**
     * Get the expiration time based on the given seconds.
     */
    protected function expiration(int $seconds): int
    {
        $time = $this->availableAt($seconds);

        return $seconds === 0 || $time > 9999999999 ? 9999999999 : $time;
    }

    /**
     * Get the Filesystem instance.
     */
    public function getFilesystem(): Filesystem
    {
        return $this->files;
    }

    /**
     * Get the working directory of the cache.
     * @return string
     */
    public function getDirectory(): string
    {
        return $this->directory;
    }

    /**
     * Get the cache key prefix.
     * @return string
     */
    public function getPrefix(): string
    {
        return '';
    }
}