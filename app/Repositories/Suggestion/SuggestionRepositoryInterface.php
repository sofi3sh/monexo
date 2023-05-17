<?php


namespace App\Repositories\Suggestion;


use App\Models\Admin\SuggestionType;
use App\Models\Suggestion;

interface SuggestionRepositoryInterface
{
    public function __construct(Suggestion $model);
}
