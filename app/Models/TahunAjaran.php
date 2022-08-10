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
        'tahun'
    ];

    public function Kelas()
    {
        return $this->hasMany(Kelas::class);
    }
}
