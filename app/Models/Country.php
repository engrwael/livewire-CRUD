<?php

namespace App\Models;

use App\Models\Continent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Country extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function continent()
    {
        return $this->belongsTo(Continent::class);
    }

    public function scopeSearch($query, $search)
    {
        $query->where('country_name', 'like', '%' . $search . '%')
            ->orWhere('capital_city', 'like', '%' . $search . '%');
    }
}