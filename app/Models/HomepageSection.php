<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomepageSection extends Model
{
    protected $fillable = [
        'heading',
        'description',
        'section_key',
        'order_num',
        'is_active'
    ];

    public function cards()
    {
        return $this->hasMany(HomepageCard::class)->orderBy('order_num');
    }
}
