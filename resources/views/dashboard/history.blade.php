@extends('dashboard.app')

@section('content')
        <div class="title">
            Последние операции
        </div>
        <div class="block">
            <div class="title">
                Последние операции
            </div>
            <div class="operation-container">
            <div class="operation-table__container">
                <div class="operation-table">
                    <div class="operation-thead">
                        <div class="operation-tr">
                            <div class="operation-th">Дата</div>
                            <div class="operation-th">Платежная система</div>
                            <div class="operation-th">Сумма</div>
                            <div class="operation-th">Операция</div>                            
                            <div class="operation-th">Статус</div>
                        </div>
                    </div>
                    @if(!is_null($payments))
                    @foreach($payments as $item)
                    @php $d=explode('#',$item->additional_data)@endphp
                    <div class="operation-tr">
                        <div class="operation-td">
                            {{$item->created_at}}
                        </div>
                        <div class="operation-td">
                            {{$item->currency->name}}
                        </div>
                        <div class="operation-td">
                            {{$d[1]}}{{isset($d[2])?$d[2]:''}}
                        </div>
                        <div class="operation-td">
                            {{$d[0]}} 
                        </div>                        
                        <div class="operation-td {{($item->address!='')?'operation-td__performed':'operation-td__rejected'}}">
                            {{($item->address=='')?'Не выполнено':'Выполнено'}}
                        </div>
                    </div>
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
        </div>
@endsection