<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function organizer() :BelongsTo
    {
        return $this->belongsTo(User::class, 'organizer_id');
    }

    public function subcategories() :BelongsToMany
    {
        return $this->belongsToMany(Subcategory::class);
    }

    public function tickets() :HasMany
    {
        return $this->hasMany(Ticket::class);
    }

    // public function venue() :BelongsTo
    // {
    //     return $this->belongsTo(Veneu::class);
    // }

    public function tickets(){
        return $this->hasMany(Ticket::class);
    }
}
