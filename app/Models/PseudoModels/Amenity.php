<?php

namespace App\Models\PseudoModels;

use Codicagr\CmsCore\Models\Item;
use Illuminate\Database\Eloquent\Builder;

class Amenity extends Item
{

    protected $table = 'items';
    protected $translationForeignKey = 'item_id';

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('onlyAmenities', function (Builder $builder) {
            $builder->where('pseudo_model', 'Amenity');
        });
    }

    public function categories(){
        return $this->belongsToMany(AmenityCategory::class, 'category_item', 'item_id', 'category_id')
            ->withPivot('order','canonical');
    }

}
