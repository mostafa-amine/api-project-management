<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livrable extends Model
{
    use HasFactory;

    protected $primaryKey = 'code';

    public $incrementing = false;

    protected $keyType = 'string';

    public $timestamps = false;

    public $fillable = [
        'libelle',
        'description',
        'documentPath',
        'phase_id'
    ];

    public function phase()
    {
        return $this->belongsTo(Phase::class);
    }
}
