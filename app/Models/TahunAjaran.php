<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TahunAjaran extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'tahun',
        'deleted_at'
    ];

    public function Kelas()
    {
        return $this->hasMany(Kelas::class, 'tahunajaran_id', 'id');
    }

    public static function boot()
    {
        parent::boot();

        static::deleted(function ($tahunajaran) {
            $tahunajaran->Kelas()->each(function ($kelas) {
                $kelas->delete();
            });
        });

        // static::restoring(function ($tahunajaran) {
        //     $tahunajaran->Kelas()->withTrashed()->where('deleted_at', '>=', $tahunajaran->deleted_at)->restore();
        // });

        static::restoring(function ($tahunajaran) {
            $tahunajaran->Kelas()->onlyTrashed()->where('deleted_at', '>=', $tahunajaran->deleted_at)->get()->each(function ($kelas) {
                $kelas->restore();
            });
        });

        // static::restoring(function ($tahunajaran) {
        //     $tahunajaran->Kelas()->each(function ($tahunajaran) {
        //         $tahunajaran->restore();
        //     });
        // });
    }
}
