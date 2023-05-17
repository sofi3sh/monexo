@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <br>

                @if(session('status'))
                    <div class="alert alert-info">
                        {{ session('status') }}
                    </div>
                @endif

                @if($errors->any())
                    @foreach($errors->all() as $error)
                        <div class="alert alert-danger">{{ $error }}</div>
                    @endforeach
                @endif

                <div class="admin-content-block">
                    <h3 class="mb-3">Блог</h3>

                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="pills-posts-tab" data-toggle="pill" href="#pills-posts" role="tab" aria-controls="pills-posts" aria-selected="true">Посты</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="pills-categories-tab" data-toggle="pill" href="#pills-categories" role="tab" aria-controls="pills-categories" aria-selected="false">Категории</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="pills-tags-tab" data-toggle="pill" href="#pills-tags" role="tab" aria-controls="pills-tags" aria-selected="false">Теги</a>
                        </li>
                    </ul>

                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-posts" role="tabpanel" aria-labelledby="pills-posts-tab">
                            <a class="btn btn-primary btn-sm mb-4" href="{{ route('admin.blog.post.create') }}">Создать пост</a>

                            <table id="blog-posts-table" class="table without-datatable">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Семан. ид-тор</th>
                                        <th>Название</th>
                                        <th>Картинка</th>
                                        <th>Категория</th>
                                        <th>Автор</th>
                                        <th>Просмотры</th>
                                        <th>Метатеги</th>
                                        <th>Теги</th>
                                        <th>Опубликован</th>
                                        <th>Создан</th>
                                        <th>Изменен</th>
                                        <th>Действия</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>

                        <div class="tab-pane fade" id="pills-categories" role="tabpanel" aria-labelledby="pills-categories-tab">
                            <a class="btn btn-primary btn-sm mb-4" href="{{ route('admin.blog.category.create') }}">Создать категорию</a>

                            <table id="blog-categories-table" class="table without-datatable">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Семан. ид-тор</th>
                                        <th>Название</th>
                                        <th>Описание</th>
                                        <th>Цвет</th>
                                        <th>Создана</th>
                                        <th>Изменена</th>
                                        <th>Действия</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>

                        <div class="tab-pane fade" id="pills-tags" role="tabpanel" aria-labelledby="pills-tags-tab">
                            <a class="btn btn-primary btn-sm mb-4" href="{{ route('admin.blog.tag.create') }}">Создать тег</a>

                            <table id="blog-tags-table" class="table without-datatable">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Семан. ид-тор</th>
                                        <th>Название</th>
                                        <th>Создан</th>
                                        <th>Изменен</th>
                                        <th>Действия</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @include('admin.includes.partials.blog.scripts')
@endsection
