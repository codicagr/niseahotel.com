<?php

namespace App\Models\PseudoModels;

use Codicagr\CmsCore\Models\Category;
use Codicagr\CmsCore\Models\Item;
use Illuminate\Database\Eloquent\Builder;

class GeneralTextCategory extends Category
{
    protected $table = 'categories';
    protected $translationForeignKey = 'category_id';

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('onlyGeneralTextCategories', function (Builder $builder) {
            $builder->where('pseudo_model', 'GeneralTextCategory');
        });
    }

    public function scopeExcludeCategoriesWithoutPermission($query, $permissionName = null)
    {
        if(is_null($permissionName)) {
            return $query;
        }
        $prefix = 'general-text-category.';
        $categories = $query->get();
        $excludedCategories = $categories->filter(function ($record, $key) use($prefix, $permissionName) {
            return !$this->hasPermissionTo($prefix . $record->id . '.' . $permissionName);
        })->pluck('id');
        return $query->whereNotIn('id', $excludedCategories);
    }

    public function items(){
        return $this->belongsToMany(Item::class, 'category_item', 'category_id', 'item_id')
            ->withPivot('order', 'canonical');
    }
}
