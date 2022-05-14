<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class chats extends Model
{
    protected $guarded = ['id'];

    public function chat_user(int $offer_id)
    {
        $chat = DB::table('chats')
            ->where('OfferId', $offer_id )
            ->join('users','users.id', '=',  'chats.UserId')
            ->get();
        return $chat;
    }
}
