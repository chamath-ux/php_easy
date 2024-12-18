<?php

namespace Support\lib;

class Cache
{
    protected $cacheDir;

    public function __construct($cacheDir = __DIR__.'/cache')
    {
        $this->cacheDir = $cacheDir;

        if (!is_dir($this->cacheDir)) {
            mkdir($this->cacheDir, 0755, true);
        }
    }

    /**
     * Store a value in the cache.
     * 
     * @param string $key
     * @param mixed $value
     * @param int $ttl Time-to-live in seconds
     */

    public function set($key, $value, $ttl = 3600)
    {
        $data = [
            'value' => $value,
            'expires_at' => time() + $ttl,
        ];
        file_put_contents($this->getFilePath($key), serialize($data));
    }

        /**
     * Retrieve a value from the cache.
     *
     * @param string $key
     * @return mixed|null
     */
    public function get($key)
    {
        $filePath = $this->getFilePath($key);

        if (!file_exists($filePath)) {
            return null;
        }

        $data = unserialize(file_get_contents($filePath));

        // Check if cache has expired
        if (time() > $data['expires_at']) {
            unlink($filePath); // Delete expired cache
            return null;
        }

        return $data['value'];
    }

     /**
     * Get the file path for a cache key.
     *
     * @param string $key
     * @return string
     */
    protected function getFilePath($key)
    {
        return $this->cacheDir . '/' . md5($key) . '.cache';
    }

}