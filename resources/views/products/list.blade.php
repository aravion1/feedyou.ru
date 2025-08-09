@extends('layouts.main')

@section('title')
    Список продуктов
@endsection

@section('search-action')
    /products/search/1
@endsection
@section('search-value'){{$search ?? ''}}@endsection
@section('content')
    @if(count($list) > 0)
    <div class="container">
        <div class="row align-items-center">
            <nav aria-label="...">
                <ul class="pagination pagination-sm justify-content-end">
                    @foreach($pagination as $page => $fields)
                        <li class="page-item {{$fields['isActive'] ? 'disabled' : ''}}">
                            <a class="page-link" href="/products/{{$page . $fields['params']}}" tabindex="-1">{{$page}}</a>
                        </li>
                    @endforeach
                </ul>
            </nav>
        </div>
        @foreach(array_chunk($list, 5) as $row)
            <div class="row justify-content-evenly mb-2">
                @foreach($row as $item)
                    <div class="card bg-dark-subtle p-1" style="width: 16rem;">

                        <img class="card-img-top" width="200" height="200" src="{{!empty($item['img']) ? $item['img']['original'][0] : '/images/no-image.png'}}" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">{{$item['name']}}</h5>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Углеводы - {{$item['carbs']}}</li>
                            <li class="list-group-item">Белки - {{$item['proteins']}}</li>
                            <li class="list-group-item">Жиры - {{$item['fats']}}</li>
                            <li class="list-group-item">
                                Расход <b>{{$item['ccal']}} ккал</b> {{$item['measure_type'] != '-' ? 'На 100' . $item['measure_type'] : ''}}
                            </li>
                        </ul>
                    </div>
                @endforeach
            </div>
        @endforeach
        <div class="row align-items-center">
            <nav aria-label="...">
                <ul class="pagination pagination-sm justify-content-end">
                    @foreach($pagination as $page => $fields)
                        <li class="page-item {{$fields['isActive'] ? 'disabled' : ''}}">
                            <a class="page-link" href="/products/{{$page . $fields['params']}}" tabindex="-1">{{$page}}</a>
                        </li>
                    @endforeach
                </ul>
            </nav>
        </div>

    </div>
    @else
        <div class="container d-flex justify-content-center">
            <p class="text-white">По вашему запросу ничего не найдено</p>
        </div>
    @endif
@endsection
