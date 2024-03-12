<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{
    use HasFactory;
    protected $table = "friend";
    protected $fillable = ['name', 'email', 'numer', 'sosmed'];

    public function User()
    {
        return $this->belongsTo(User::class);
    }
}
