<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Message extends Model
{
    protected $guarded = ['id'];

    /* Sent By User */
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    /* Sent To User */
    public function recipient()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    /* Get last message with contacts */
    public function getInbox()
    {
        $id = auth()->id();
        $inbox = DB::select("SELECT t1.* FROM messages AS t1 INNER JOIN(
            SELECT LEAST(sender_id, receiver_id) AS sender_id, GREATEST(sender_id, receiver_id) AS receiver_id,
            MAX(id) AS max_id FROM messages GROUP BY LEAST(sender_id, receiver_id), GREATEST(sender_id, receiver_id)
        ) AS t2 ON LEAST(t1.sender_id, t1.receiver_id) = t2.sender_id AND
               GREATEST(t1.sender_id, t1.receiver_id) = t2.receiver_id AND t1.id = t2.max_id
            WHERE t1.sender_id = $id OR t1.receiver_id = $id");
        dd($inbox);
    }

    /* Message Status */
    public function status()
    {
        return $this->belongsTo(Status::class);
    }
}
