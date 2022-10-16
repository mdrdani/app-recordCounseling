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
        'jenjang',
        'deleted_at'
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
        return $this->hasMany(Siswa::class, 'kelas_id', 'id');
    }

    public static function boot()
    {
        parent::boot();

        static::deleted(function ($kelas) {
            $kelas->Siswa()->each(function ($siswa) {
                $siswa->delete();
            });
        });

        static::restoring(function ($kelas) {
            $kelas->Siswa()->onlyTrashed()->where('deleted_at', '>=', $kelas->deleted_at)->get()->each(function ($siswa) {
                $siswa->restore();
            });
        });
    }
}
