<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Siswa extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'nis',
        'jenis_kelamin',
        'tanggal_lahir'
    ];

    public function Kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

    public function Notes()
    {
        return $this->hasMany(Note::class, 'siswa_id', 'id');
    }
}
