<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CustomTransaction;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CustomTransactionController extends Controller
{
    private function getCustomTransactionData() : Array
    {
        $transaction = CustomTransaction::select('commission', 'min', 'max')->first();
        return $transaction->getAttributes();
    }

    public function index() : View
    {
        return view('admin.customTransaction.main', $this->getCustomTransactionData());
    }

    public  function edit() : View
    {
        return view('admin.customTransaction.edit', $this->getCustomTransactionData());
    }

    public function update(Request $request) : RedirectResponse
    {

        $formValidate = $request->validate([
            'commission' => 'required',
            'min' => 'required',
            'max' => 'required',
        ]);

        CustomTransaction::find('1')
            ->update([
                'commission' => $formValidate['commission'],
                'min' => $formValidate['min'],
                'max' => $formValidate['max'],
            ]);

        return redirect()->route('admin.customTransaction.main');
    }
}
