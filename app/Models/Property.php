<?php

namespace App\Models;

use App\Models\User;
use App\Models\PropertyImage;
use App\Models\PropertyCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Property extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'category_id', 'title', 'description', 'price', 'location', 'latitude', 'longitude', 'status'];

    // Une propriété appartient à un utilisateur
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Une propriété appartient à une catégorie
    public function category(): BelongsTo
    {
        return $this->belongsTo(PropertyCategory::class);
    }

    // Une propriété a plusieurs images
    public function images(): HasMany
    {
        return $this->hasMany(PropertyImage::class);
    }

    // Une propriété peut être ajoutée en favori par plusieurs utilisateurs
    public function favoritedBy(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'favorites');
    }
}