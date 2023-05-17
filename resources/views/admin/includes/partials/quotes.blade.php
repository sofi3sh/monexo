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
                    <h3 class="mb-3">Цитаты</h3>

                    <div class="tab-content">
                        <div class="tab-pane fade show active">
                            <a class="btn btn-primary btn-sm mb-4" href="{{ route('admin.quote.create') }}">Создать цитату</a>

                            <table id="quotes-table" class="table without-datatable">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Текст</th>
                                        <th>Автор</th>
                                        <th>Создана</th>
                                        <th>Изменена</th>
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
    <script type="text/javascript">
        $(document).ready(function () {
            $('#quotes-table').DataTable({
                processing: true,
                serverSide: true,
                searching: true,
                bLengthChange: true,
                pageLength: 10,
                ajax: "{{ route('admin.datatable.quotes') }}",
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Russian.json'
                },
                columns: [
                    {data: 'id', id: 'id'},
                    {data: 'text', id: 'text'},
                    {data: 'author', id: 'author'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'updated_at', name: 'updated_at'},
                    {data: 'actions', name: 'actions'}
                ]
            });
        });
    </script>
@endsection
