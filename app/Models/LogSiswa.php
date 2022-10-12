<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogSiswa extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'siswa_id', 'method'
    ];

    public function User()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function Siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id')->withTrashed();
    }
}
