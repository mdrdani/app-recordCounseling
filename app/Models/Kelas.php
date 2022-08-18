<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kelas extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
    ];

    public function TahunAjaran()
    {
        return $this->belongsTo(TahunAjaran::class, 'tahunajaran_id');
    }
    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function Siswa()
    {
        return $this->hasMany(Siswa::class);
    }
}
