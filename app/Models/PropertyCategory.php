<?php

namespace App\Models;

use App\Models\Property;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PropertyCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    // Une catégorie peut contenir plusieurs propriétés
    public function properties(): HasMany
    {
        return $this->hasMany(Property::class);
    }
}
