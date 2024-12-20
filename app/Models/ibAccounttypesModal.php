<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ibAccounttypesModal extends Model
{
    use HasFactory;

    // Define the table if it's not the plural form of the model name
    protected $table = 'ib_accounttypes';

    // Specify the fillable fields
    protected $fillable = [
        'title',
        'group',
        'badge',
        'status',
        'type',
    ];
}