<?php

namespace App\Models\dashboard;

use Illuminate\Database\Eloquent\Model;


class Payment extends Model
{
    protected $table = 'backend_payment';

    protected $guarded = [];


    public function product(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(BackendProduct::class, 'backend_product_payment')->withTimestamps();
    }
}
