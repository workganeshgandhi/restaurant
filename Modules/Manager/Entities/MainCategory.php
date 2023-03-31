<?php

namespace Modules\Manager\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class MainCategory extends Model implements TranslatableContract
{
    use HasFactory, Translatable;
    public $translatedAttributes = ['name'];
    protected $fillable = ['name', 'images'];

    protected static function newFactory()
    {
        return \Modules\Manager\Database\factories\MainCategoryFactory::new();
    }
    public function categories()
    {
        return $this->hasMany(category::class);
    }
}
