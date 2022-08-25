<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Note extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'siswa_id',
        'user_id',
        'tanggal',
        'masalah',
        'penanganan',
        'foto',
    ];

    public function Siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }

    public function User()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
