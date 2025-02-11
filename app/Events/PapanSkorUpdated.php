<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PapanSkorUpdated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $jenis_olahraga;
    public $skor_a;
    public $skor_b;
    public $babak;
    public $tipe;
    public $tipe_jumlah_a;
    public $tipe_jumlah_b;

    /**
     * Create a new event instance.
     */
    public function __construct($jenis_olahraga, $skor_a, $skor_b, $babak, $tipe, $tipe_jumlah_a, $tipe_jumlah_b)
    {
        $this->jenis_olahraga = $jenis_olahraga;
        $this->skor_a = $skor_a;
        $this->skor_b = $skor_b;
        $this->babak = $babak;
        $this->tipe = $tipe;
        $this->tipe_jumlah_a = $tipe_jumlah_a;
        $this->tipe_jumlah_b = $tipe_jumlah_b;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn()
    {
        return new Channel('papan');
        // return [
        // ];
    }

    public function broadcastAs()
    {
        return 'updateskor';
    }
}
