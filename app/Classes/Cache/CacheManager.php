<?php

declare(strict_types=1);

namespace App\Classes\Cache;

use App\Classes\Cache\Contracts\Store;
use App\Classes\Cache\Store\ArrayStore;
use App\Classes\Cache\Store\DatabaseStore;
use App\Classes\Cache\Store\FileStore;
use App\Classes\Cache\Store\MemcachedStore;
use App\Classes\Cache\Store\NullStore;
use App\Classes\Cache\Store\RedisStore;
use App\Classes\Filesystem\Filesystem;
use App\Services\Events\Event\SetCacheRepository;
use Closure;
use InvalidArgumentException;
use Memcached;

final class CacheManager
{
    private array $configs = [];

    /**
     * The array of resolved cache stores.
     */
    protected array $stores = [];

    /**
     * The registered custom driver creators.
     */
    protected array $customCreators = [];

    public function __construct()
    {
        $this->configs = require_once dirname(__DIR__, 3) . '/config/cache.php';
    }

    /**
     * @param $name
     * @return Store
     */
    public function store($name = null)
    {
        $name = $name ?: $this->getDefaultDriver();

        return $this->stores[$name] = $this->get($name);
    }

    public function driver($driver = null)
    {
        return $this->store($driver);
    }

    protected function get($name)
    {
        return $this->stores[$name] ?? $this->resolve($name);
    }

    protected function resolve($name)
    {
        $config = $this->getConfig($name);

        if (is_null($config)) {
            throw new InvalidArgumentException("Cache store [{$name}] is not defined.");
        }

        if (isset($this->customCreators[$config['driver']])) {
            return $this->callCustomCreator($config);
        } else {
            $driverMethod = 'create' . ucfirst($config['driver']) . 'Driver';

            if (method_exists($this, $driverMethod)) {
                return $this->{$driverMethod}($config);
            }
            throw new InvalidArgumentException("Driver [{$config['driver']}] is not supported.");
        }
    }

    protected function callCustomCreator(array $config)
    {
        return $this->customCreators[$config['driver']]($config);
    }

    protected function createArrayDriver(array $config)
    {
        return $this->repository(new ArrayStore($config['serialize'] ?? false));
    }

    protected function createFileDriver(array $config)
    {
        return $this->repository(new FileStore(new Filesystem(), $config['path'], $config['permission'] ?? null));
    }

    protected function createMemcachedDriver(array $config)
    {
        $prefix = $this->getPrefix($config);

        $servers = $config['servers'];
        $connectionId = $config['persistent_id'] ?? null;
        $options = $config['options'] ?? [];
        $credentials = array_filter($config['sasl'] ?? []);

        $memcached = empty($connectionId) ? new Memcached : new Memcached($connectionId);

        if (count($credentials) === 2) {
            [$username, $password] = $credentials;

            $memcached->setOption(Memcached::OPT_BINARY_PROTOCOL, true);

            $memcached->setSaslAuthData($username, $password);
        }

        if (count($options)) {
            $memcached->setOptions($options);
        }

        if (!$memcached->getServerList()) {
            // For each server in the array, we'll just extract the configuration and add
            // the server to the Memcached connection. Once we have added all of these
            // servers we'll verify the connection is successful and return it back.
            foreach ($servers as $server) {
                $memcached->addServer(
                    $server['host'],
                    $server['port'],
                    $server['weight'] ?? 0
                );
            }
        }

        return $this->repository(new MemcachedStore($memcached, $prefix));
    }

    protected function createNullDriver()
    {
        return $this->repository(new NullStore);
    }

    protected function createRedisDriver(array $config)
    {
        return $this->repository(new RedisStore());
    }

    protected function createDatabaseDriver(array $config)
    {
        return $this->repository(
            new DatabaseStore(
                $config['table'],
                $this->getPrefix($config),
            )
        );
    }

    /**
     * Create a new cache repository with the given implementation.
     */
    public function repository(Store $store)
    {
        return tap(new Repository($store), function (Repository $repository) {
            event(new SetCacheRepository($repository));
        });
    }

    /**
     * Get the cache prefix.
     */
    protected function getPrefix(array $config): string
    {
        return $config['prefix'] ?? $this->configs['prefix'];
    }

    /**
     * Get the cache connection configuration.
     */
    protected function getConfig(string $name): ?array
    {
        return $this->configs['stores'][$name] ?? null;
    }

    /**
     * Get the default cache driver name.
     */
    public function getDefaultDriver(): string
    {
        return $this->configs['default'];
    }

    /**
     * Set the default cache driver name.
     */
    public function setDefaultDriver(string $name): void
    {
        $this->configs['default'] = $name;
    }

    /**
     * Unset the given driver instances.
     * @param array|string|null $name
     */
    public function forgetDriver($name = null): self
    {
        $name = $name ?? $this->getDefaultDriver();

        foreach ((array)$name as $cacheName) {
            if (isset($this->stores[$cacheName])) {
                unset($this->stores[$cacheName]);
            }
        }

        return $this;
    }

    /**
     * Register a custom driver creator Closure.
     */
    public function extend(string $driver, Closure $callback): self
    {
        $this->customCreators[$driver] = $callback->bindTo($this, $this);

        return $this;
    }

    /**
     * Dynamically call the default driver instance.
     * @param string $method
     * @param array $parameters
     * @return mixed
     */
    public function __call(string $method, $parameters)
    {
        return $this->store()->$method(...$parameters);
    }
}