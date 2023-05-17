<?php

namespace App\Models\Home\CompanyMaterials;

use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

/**
 * @property int $id ID
 * @property string $name Название презентационного материала
 * @property string $pdf Путь до pdf файла
 * @property string $describe Описание презентационного материала
 * @property Carbon $created_at Событие создано
 * @property Carbon $updated_at Событие обновлено
 *
 */

class CompanyMaterial extends Model
{
    use HasTranslations;

    /** @var string[] Переводимые колонки */
    public $translatable = ['name', 'describe'];

    /** @inheritDoc */
    protected $table = 'company_materials';

    /** @inheritDoc */
    protected $guarded = ['id'];

    /** @inheritDoc */
    protected $fillable = [
        'name',
        'pdf',
        'describe'
    ];

    /**
     * Получить полный путь к pdf
     *
     * @param $value
     * @return string|null
     */
    public function getPdfAttribute($value): ? string
    {
        return $value ? url(Storage::url($value)) : "1";
    }
}
