<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountType extends Model
{
    use HasFactory;

    protected $fillable = [
        'icon',
        'priority',
        'title',
        'leverage',
        'country',
        'badge',
        'status',
    ];

    // Optionally define any relationships or additional methods here
}
