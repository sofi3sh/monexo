<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Home\News;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\SoftDeletes;

class NewsController extends Controller
{
    public function showNewsPage()
    {
        $news = News::all();

        return view('admin.news',['news'=>$news]);
    }

    public function showEditNewsPage($id)
    {
        $news = News::where('id',$id)->first();
        return view('admin.edit-news',['news'=>$news]);
    }

    public function createNews()
    {
        $news = new News();
        $news->header_ru = "Новая статья";
        $news->short_description_ru = '';
        $news->text_ru = '';
        $news->thumb = '';
        $news->created_at = Carbon::now();
        try{
            $news->save();
            return view('admin.edit-news',['news'=>$news]);
        } catch (Exception $ex) {
            return redirect()->back()>withErrors($ex->message());
        }
        
    }

    public function deleteNews($id)
    {
        News::where('id',$id)->delete();

        return back()->with('flash_success', 'Удалили.');
    }

    public function storeNews(Request $request)
    {
        try {
            DB::beginTransaction();
            $news = News::find($request->id);
            $header = $request->header;
            $short_description = $request->short_description;
            $text = $request->text;            
            $path = $news->thumb;
            if ($request->has('thumbnails')){
                $imageName = time().'.'.request()->thumbnails->getClientOriginalExtension();
                request()->thumbnails->move(public_path('news/thumbnails/'), $imageName);
                if(file_exists(public_path($path)) && !empty($path)) unlink(public_path($path));
                $path = 'news/thumbnails/'.$imageName;
            }
            $news['thumb'] = $path;
            $news->{'header_ru'} = $request->header;
            $news->{'short_description_ru'} = $short_description;
            $news->{'text_ru'} = $request->text;
            $news->save();;

            DB::commit();
            $msg_type = 'flash_success';
            $msg = 'Успешно.';
        } catch (\Exception $e) {
            DB::rollback();
            $msg_type = 'flash_danger';
            $msg = $e->getMessage();
        }

        return redirect(route('admin.newsEdit',['id'=>$news->id]))->with($msg_type, $msg);
    }
}
