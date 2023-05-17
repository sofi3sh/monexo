<?php


namespace App\Repositories\SuggestionType;


use App\Models\Admin\SuggestionType;
use App\Repositories\Repository;

class SuggestionTypeTypeRepository extends Repository implements SuggestionTypeRepositoryInterface
{
    /**
     * @var SuggestionType
     */
    protected $model;

    /**
     * UserIpRepository constructor.
     *
     * @param SuggestionType $model
     */
    public function __construct(SuggestionType $model)
    {
        parent::__construct($model);
    }
}
