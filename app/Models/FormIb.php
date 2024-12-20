<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class FormIb extends Model
{
    use HasFactory;

    protected $table = 'formsib'; // Specify the table name

    protected $fillable = [
        'user_id',
        'form_based_on_user',
        'username',
        'email',
        'user_country',
        'country',
        'expected_clients',
        'services',
        'trading_volume',
        'active_clients',
        'background_options',
        'selectable_options',
        'ib_status',
        'terms_agreement',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
}
