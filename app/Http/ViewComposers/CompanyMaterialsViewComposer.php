<?php

namespace App\Http\ViewComposers;

use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use App\Models\Home\CompanyMaterials\CompanyMaterial;
/**
 * Connect Http Request class
 */
use Illuminate\Http\Request;

class CompanyMaterialsViewComposer
{
    private $request;

    /**
     * Pass $request
     */
    public function __construct(Request $request)
    {
       $this->request = $request;
    }

    public function compose(View $view)
    {

        $companyMaterials = CompanyMaterial::all('name', 'describe', 'pdf');
        
        $view->with(compact('companyMaterials'));
    }
}
