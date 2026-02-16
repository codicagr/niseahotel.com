<?php

namespace App\Models\PseudoModels;

use Codicagr\CmsCore\Models\Item;
use Illuminate\Database\Eloquent\Builder;

class GeneralText extends Item
{

    protected $table = 'items';
    protected $translationForeignKey = 'item_id';

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('onlyGeneralTexts', function (Builder $builder) {
            $builder->where('pseudo_model', 'GeneralText');
        });
    }

    public function categories(){
        return $this->belongsToMany(GeneralTextCategory::class, 'category_item', 'item_id', 'category_id')
            ->withPivot('order','canonical');
    }

}
