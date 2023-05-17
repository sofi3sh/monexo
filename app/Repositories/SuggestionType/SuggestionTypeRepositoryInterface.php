<?php


namespace App\Repositories\SuggestionType
;


use App\Models\Admin\SuggestionType;

interface SuggestionTypeRepositoryInterface
{
    public function __construct(SuggestionType $model);
}
