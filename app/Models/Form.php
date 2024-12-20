<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Form extends Model
{
    public $casts = [
        'form_data'=>'object'
    ];

    public function jsonData(): Attribute
    {
        return new Attribute(
            get: fn () => [
                'type'=>$this->type,
                'is_required'=>$this->is_required,
                'label'=>$this->name,
                'extensions'=>$this->extensions ?? 'null',
                'options'=>json_encode($this->options),
                'old_id'=>'',
            ],
        );
    }

    use HasFactory;
    public function user()
    {
        return $this->belongsTo(User::class);

    }
}
