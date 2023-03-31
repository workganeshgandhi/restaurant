<?php

namespace Modules\Manager\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Manager\Database\factories\CategoryTranslationFactory;

class CategoryTranslation extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['name'];
    protected static function newFactory()
    {
        return CategoryTranslationFactory::new();
    }
}
