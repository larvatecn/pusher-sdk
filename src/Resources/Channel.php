<?php
/**
 * This is NOT a freeware, use is subject to license terms
 */
declare(strict_types=1);

namespace Larva\Pusher\Resources;

class Channel extends Resource
{
    /**
     * The channel name.
     *
     * @var string
     */
    public $channel;

    /**
     * The channel online user.
     *
     * @var int
     */
    public $online_users;

    /**
     * 向频道广播
     * @param string $event
     * @param array|string $data
     * @return mixed
     */
    public function trigger(string $event, array|string $data)
    {
        return $this->forge->trigger($this->channel, $event, $data);
    }
}