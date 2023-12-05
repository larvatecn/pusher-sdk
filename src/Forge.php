<?php

namespace Larva\Pusher;

use GuzzleHttp\Client as HttpClient;
use Larva\Pusher\Resources\Channel;
use Larva\Pusher\Resources\OnlineUser;

class Forge
{
    use MakesHttpRequests;

    /**
     * The Pusher Server Url.
     *
     * @var string
     */
    protected $baseUrl;

    /**
     * The Pusher Server API Key.
     *
     * @var string
     */
    protected $apiKey;

    /**
     * The Guzzle HTTP Client instance.
     *
     * @var \GuzzleHttp\Client
     */
    public $guzzle;

    /**
     * Number of seconds a request is retried.
     *
     * @var int
     */
    public int $timeout = 30;

    /**
     * Create a new Forge instance.
     *
     * @param string $baseUrl
     * @param string|null $apiKey
     * @param \GuzzleHttp\Client|null $guzzle
     * @return void
     */
    public function __construct(string $baseUrl, $apiKey = null, HttpClient $guzzle = null)
    {
        $this->baseUrl = $baseUrl;
        if (!is_null($apiKey)) {
            $this->setApiKey($apiKey, $guzzle);
        }

        if (!is_null($guzzle)) {
            $this->guzzle = $guzzle;
        }
    }

    /**
     * Transform the items of the collection to the given class.
     *
     * @param array $collection
     * @param string $class
     * @param array $extraData
     * @return array
     */
    protected function transformCollection($collection, $class, $extraData = [])
    {
        return array_map(function ($data) use ($class, $extraData) {
            return new $class($data + $extraData, $this);
        }, $collection);
    }

    /**
     * Set the api key and setup the guzzle request object.
     *
     * @param string $apiKey
     * @param \GuzzleHttp\Client|null $guzzle
     * @return $this
     */
    public function setApiKey($apiKey, $guzzle = null)
    {
        $this->apiKey = $apiKey;

        $this->guzzle = $guzzle ?: new HttpClient([
            'base_uri' => $this->baseUrl,
            'http_errors' => false,
            'headers' => [
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
        ]);

        return $this;
    }

    /**
     * Set a new timeout.
     *
     * @param int $timeout
     * @return $this
     */
    public function setTimeout(int $timeout)
    {
        $this->timeout = $timeout;

        return $this;
    }

    /**
     * Get the timeout.
     *
     * @return int
     */
    public function getTimeout(): int
    {
        return $this->timeout;
    }

    /**
     * 获取 WS 地址
     * @return string
     * @author Tongle Xu <xutongle@msn.com>
     * @date 2023/12/5 18:19
     */
    public function getWsAddress(): string
    {
        return str_replace('http', 'ws', $this->baseUrl);
    }

    /**
     * 直接发布点对点事件
     * @param string $sid
     * @param string $event
     * @param string|array $data
     */
    public function publish(string $sid, string $event, $data)
    {
        return $this->post('/api/publish', [
            'sid' => $sid,
            'event' => $event,
            'data' => $data
        ]);
    }

    /**
     * 直接发布事件
     * @param string $channel
     * @param string $event
     * @param string|array $data
     * @return mixed
     */
    public function trigger(string $channel, string $event, $data)
    {
        return $this->post('/api/publish', [
            'channel' => $channel,
            'event' => $event,
            'data' => $data
        ]);
    }

    /**
     * 查询频道信息
     * @param string $channel
     */
    public function channel(string $channel): Channel
    {
        return new Channel($this->post('/api/channel', [
            'channel' => $channel,
        ]), $this);
    }
}
