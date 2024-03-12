<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{
    use HasFactory;

    protected $fillab = ['name', 'email', 'numer', 'sosmed'];

    public function User()
    {
        return $this->belongsTo(User::class);
    }
}
