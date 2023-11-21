<?php

namespace Larva\Pusher\Resources;

use Larva\Pusher\Forge;

#[\AllowDynamicProperties]
class Resource
{
    /**
     * The resource attributes.
     *
     * @var array
     */
    public array $attributes;

    /**
     * The Forge SDK instance.
     *
     * @var Forge|null
     */
    protected ?Forge $forge;

    /**
     * Create a new resource instance.
     *
     * @param  array  $attributes
     * @param Forge|null  $forge
     * @return void
     */
    public function __construct(array $attributes, Forge $forge = null)
    {
        $this->attributes = $attributes;
        $this->forge = $forge;

        $this->fill();
    }

    /**
     * Fill the resource with the array of attributes.
     *
     * @return void
     */
    protected function fill(): void
    {
        foreach ($this->attributes as $key => $value) {
            $key = $this->camelCase($key);

            $this->{$key} = $value;
        }
    }

    /**
     * Convert the key name to camel case.
     *
     * @param string $key
     * @return string
     */
    protected function camelCase(string $key): string
    {
        $parts = explode('_', $key);

        foreach ($parts as $i => $part) {
            if ($i !== 0) {
                $parts[$i] = ucfirst($part);
            }
        }

        return str_replace(' ', '', implode(' ', $parts));
    }

    /**
     * Transform the items of the collection to the given class.
     *
     * @param  array  $collection
     * @param string $class
     * @param  array  $extraData
     * @return array
     */
    protected function transformCollection(array $collection, string $class, array $extraData = []): array
    {
        return array_map(function ($data) use ($class, $extraData) {
            return new $class($data + $extraData, $this->forge);
        }, $collection);
    }

    /**
     * Transform the collection of tags to a string.
     *
     * @param  array  $tags
     * @param string|null $separator
     * @return string
     */
    protected function transformTags(array $tags, string $separator = null): string
    {
        $separator = $separator ?: ', ';

        return implode($separator, array_column($tags ?? [], 'name'));
    }
}
