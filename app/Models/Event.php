<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
<<<<<<< HEAD
use Illuminate\Database\Eloquent\Relations\HasMany;

=======
use Illuminate\Database\Eloquent\SoftDeletes;
>>>>>>> 4359a13a18435f607635854855b0455a51b710cd

class Event extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class);
    }

}
