<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountTypeControllerModal extends Model
{
    use HasFactory;

     protected $table = 'account_types_controller';

     protected $fillable = [
        'icon',
        'priority',
        'title',
        'leverage',
        'country',
        'badge',
        'initial_deposit',
        'spread',
        'description',
        'commision',
        'status',
        'live_account',
        'demo_account',
        'live_islamic_input',
        'demo_islamic_input',
        'live_islamic',
        'demo_islamic',
    ];
}
