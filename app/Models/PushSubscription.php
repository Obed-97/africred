<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PushSubscription extends Model
{

    protected $table = 'push_subscriptions';

    use HasFactory;

    protected $fillable = [
          'user_id',
          'subscribable_id',
          'endpoint',
          'public_key',
          'auth_token',
    ];
}
