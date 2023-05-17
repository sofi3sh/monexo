@extends('layouts.admin')

@section('css')
    <style>
        .modal-backdrop {
            display: none;
        }
    </style>
@endsection

@section('content')
    
    @if(Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{Session::get('success')}}
        </div>
    @endif

    <div class="container-fluid">
        <div class="d-flex mb-3">
            <a class="btn btn-primary ml-auto"   href="{{route('admin.partners-map.index')}}">Назад</a>
        </div>

        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="pills-posts-tab" data-toggle="pill" href="#pills-all" role="tab" aria-controls="pills-posts" aria-selected="true">Все</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" id="pills-categories-tab" data-toggle="pill" href="#pills-not-done" role="tab" aria-controls="pills-categories" aria-selected="false">Обработанные</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" id="pills-tags-tab" data-toggle="pill" href="#pills-done" role="tab" aria-controls="pills-tags" aria-selected="false">Не обработанные</a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link" id="pills-tags-tab" data-toggle="pill" href="#pills-end-of-sub" role="tab" aria-controls="pills-tags" aria-selected="false">
                    Закончилась подписка
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" id="pills-tags-tab" data-toggle="pill" href="#pills-settings" role="tab" aria-controls="pills-tags" aria-selected="false">К настройкам</a>
            </li>
        </ul>

        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-all" role="tabpanel" aria-labelledby="pills-posts-tab">
                <table class="table without-datatable w-100" id="all-table">
                    <thead>
                        <th>Id</th>
                        <th>Информация</th>
                        <th>Статус</th>
                        <th>Действие</th>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>

            <div class="tab-pane fade" id="pills-not-done" role="tabpanel" aria-labelledby="pills-categories-tab">
                <table class="table without-datatable w-100" id="not-done-table">
                    <thead class="text-center">
                        <th>Id</th>
                        <th>Информация</th>
                        <th>Статус</th>
                        <th>Действие</th>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>

            <div class="tab-pane fade" id="pills-done" role="tabpanel" aria-labelledby="pills-tags-tab">
                <table class="table without-datatable w-100" id="done-table">
                    <thead>
                        <th>Id</th>
                        <th>Информация</th>
                        <th>Статус</th>
                        <th>Действие</th>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            
            <div class="tab-pane fade" id="pills-end-of-sub" role="tabpanel" aria-labelledby="pills-tags-tab">
                <table class="table without-datatable w-100" id="end-of-sub-table">
                    <thead>
                        <th>Id</th>
                        <th>Информация</th>
                        <th>Статус</th>
                        <th>Действие</th>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>


            <div class="tab-pane fade" id="pills-settings" role="tabpanel" aria-labelledby="pills-tags-tab">
                <h2 class="h4">Настройки</h2>
                <div class="mb-3">
                    <h6><b>Заголовок:</b> {{$info->title}}</h6>
                    <h6><b>Описание:</b> {{$info->text_info}}</h6>
                    <h6><b>Цена:</b> {{$info->price}}</h6>
                    <h6><b>Доступно с уровня:</b> {{$info->level}}</h6>
                </div>
                <div class="mb-3">
                    <a href="/lang/ru" class="btn btn-secondary btn-sm">ru</a>
                    <a href="/lang/en" class="btn btn-secondary btn-sm">en</a>
                </div>
                <div class="mb-3">
                    <a class="btn btn-dark" href="{{route('admin.partners-map.buy.edit')}}">Редактировать</a>
                </div>
            </div>
            
        </div>
        


    <div class="modal fade" id="changeStatusModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" >Выберите статуc:</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('admin.partners-map.buy.change-status')}}" method="POST">
                    @csrf
                    @method('PATCH')
                    <input id="app-id" name="id" type="hidden" value="">
                    <div class="modal-body">
                        <input id="status0" name="status" type="radio" value="1">
                        <label for="status0">Обработана</label>
                        <input id="status1" name="status" type="radio" value="0">
                        <label for="status1">Не обработана</label>
                        <br>
                        <input id="status2" name="status" type="radio" value="2">
                        <label for="status2">Закончилась подписка (опционально)</label>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                        <button type="submit" class="btn btn-primary">Изменить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    
    <div class="modal fade" id="deleteAppModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Удаление заявки</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('admin.partners-map.buy.delete')}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <input id="app-id-delete" name="id" type="hidden" value="">
                    <div class="modal-body">
                        Прежде чем удалить заявку, необходимо убедиться, что вы удалили партнера из карты партнеров.
                        Вы действительно хотите удалить запись?
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Удалить</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="refuseModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Отказать в месте на карте</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('admin.partners-map.buy.refuse')}}" method="POST">
                    @csrf
                    <input id="app-id-refuse" name="id" type="hidden" value="">
                    <div class="modal-body">
                        Прежде чем отклонить заявку, необходимо убедиться, что человека нет на карте партнеров. Заявка будет удалена. Денежные средства - возвращены.
                        Вы действительно хотите отклонить заявку?
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Отклонить</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                    </div>
                </form>
            </div>
        </div>
    </div>




@endsection

@section('scripts')
    @include('admin.buy-partners-map.index-scripts')
@endsection

