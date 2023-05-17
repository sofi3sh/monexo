<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Home\Baunty;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Home\BauntyLink;

class BauntyController extends Controller
{
    public function showPage()
    {
        $baunty = Baunty::all();

        return view('admin.baunty',['baunty'=>$baunty]);
    }
    public function showEditPage($id)
    {
        $baunty = Baunty::where('id',$id)->first();
        return view('admin.edit-baunty',['baunty'=>$baunty]);
    }
    public function create()
    {
        $baunty = new Baunty();
        $baunty->title = "Новая статья";
        $baunty->text = '';
        $baunty->created_at = Carbon::now();
        try{
            $baunty->save();
            return view('admin.edit-baunty',['baunty'=>$baunty]);
        } catch (Exception $ex) {
            return redirect()->back()>withErrors($ex->message());
        }        
    }
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $baunty = Baunty::find($request->id);
            $baunty->{'title'} = $request->header;
            $baunty->{'text'} = $request->text;
            $baunty->save();;

            DB::commit();
            $msg_type = 'flash_success';
            $msg = 'Успешно.';
        } catch (\Exception $e) {
            DB::rollback();
            $msg_type = 'flash_danger';
            $msg = $e->getMessage();
        }

        return redirect(route('admin.bauntyEdit',['id'=>$baunty->id]))->with($msg_type, $msg);
    }
    public function delete($id)
    {
        Baunty::where('id',$id)->delete();

        return back()->with('flash_success', 'Удалили.');
    }

    public function showLinks(){
        $links = BauntyLink::withTrashed()->get();
        return view('admin.links', compact('links'));
    }
    public function confirmLinks(BauntyLink $id){
        $id->update(['status'=>'accepted']);
        $id->delete();
        return back()->with('flash_danger', 'Ссылка подтверждена');
    }
    public function cancelLinks(BauntyLink $id){
        $id->update(['status'=>'canceled']);
        $id->delete();
        return back()->with('flash_danger', 'Ссылка удалена');
    }

}
