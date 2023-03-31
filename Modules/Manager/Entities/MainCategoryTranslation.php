<?php

namespace Modules\Manager\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Manager\Database\factories\MainCategoryTranslationFactory;

class MainCategoryTranslation extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['name'];
    protected static function newFactory()
    {
        return MainCategoryTranslationFactory::new();
    }
}
