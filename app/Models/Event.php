<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'happening_at'
    ];

    protected $casts = [
        'happening_at' => 'datetime',
    ];

    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }
}
