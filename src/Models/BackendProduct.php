<?php

namespace App\Models\dashboard;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BackendProduct extends Model
{
    use HasFactory;
    protected $table = 'backend_product';
    protected $guarded = [];
    protected $casts = [];

    public function payments(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Payment::class, 'backend_product_payment')->withTimestamps();
    }

    public function SearchByKeyword($keyword)
    {
        return $this->where("name", "LIKE", "%$keyword%")
            ->orWhere("description", "LIKE", "%$keyword%");
    }


    public function SearchByKeywordAndColumn($columns, $relationName = '', $getIDs = '')
    {
//        dd($getIDs);
        if (!empty($relationName)) {
            $data = $this::whereHas($relationName, function (Builder $query) use ($getIDs) {
                $query->whereIn('id', $getIDs);
            });
//            dd($data);
        } else {
            $data = $this->where('id', '0');
        }
        foreach ($columns as $columnKey => $columnValue) {
            if (!empty($columnValue) && is_string($columnValue)) {
                $data->orWhere($columnKey, "LIKE", "%$columnValue%");
            }
        }
        return $data;
    }
}
