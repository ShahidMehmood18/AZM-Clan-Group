<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomepageCard extends Model
{
    protected $fillable = [
        'homepage_section_id',
        'heading',
        'description',
        'image',
        'order_num',
        'is_active'
    ];

    public function section()
    {
        return $this->belongsTo(HomepageSection::class, 'homepage_section_id');
    }
}
