<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class UserAccounts extends Model
{
    use HasFactory;
    protected $table = 'user_accounts';

    // This is the model that is used to store the users accounts that could be demo and real
    protected $fillable = [
        'User_Id',
        'Account',
        'Master_Password',
    ];


}