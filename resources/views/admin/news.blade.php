@extends('layouts.admin')

@section('content')
    <div class="main-page">
        <div class="content--blocks-wrapper cbw-col main-last-news">
            {{-- Новость --}}
            <div style='margin:25px 5px;text-align:right;'>
                <a href="{{ route('admin.newsCreate') }}" class="btn btn-success">Создать новую статью</a>
            </div>
                <table class="table">
                        <thead class="thead-dark">
                          <tr>
                            <th scope="col">id</th>
                            <th scope="col">Заголовок</th>	      		      
                            <th scope="col" style='width:200px;'>Редактор</th>		           
                          </tr>
                        </thead>
                 <tbody>		           
                      @foreach($news as $item)
                      <tr> 
                              <td>{{ $item->id }}</td>
                              <td>{{ $item->header_ru }}</td>			
                              <td>
                                  <div style="display:grid;grid-template-columns:1fr 1fr;">
                                  <a href="{{ route('admin.newsEdit',['id'=>$item->id]) }}" class="btn btn-success">Именить</a>
                                  <form action="{{ route('admin.newsDelete',['id' => $item->id]) }}" method='post'>
                                      {{method_field('DELETE')}}
                                      @csrf
                                  <button type="submit" class="btn btn-danger">Удалить</a>    
                                  </form>
                                  </div>
                              </td>
                      </tr>		
                      @endforeach
                         </tbody>
                </table>
        </div>
    </div>
@endsection
