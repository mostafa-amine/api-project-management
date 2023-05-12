<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'montant',
        'organization_id'
    ];

    public function phases(): HasMany
    {
        return $this->hasMany(Phase::class);
    }

    public function organisation(): BelongsTo
    {
        return $this->belongsTo(Organization::class);
    }
}
