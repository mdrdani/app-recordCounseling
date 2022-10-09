<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogNote extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'siswa_id', 'method'
    ];
}
