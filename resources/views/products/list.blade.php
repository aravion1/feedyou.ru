@section('title')
    {{$search ?? 'Накормим вас! список продуктов'}}
@endsection
@extends('layouts.main')

@section('search-value'){{$search ?? ''}}@endsection

@section('keywords')
    {{$seo['keywords']}}
@endsection
@section('description')
    {{$seo['description']}}
@endsection
@section('content')
    @if(count($list) > 0)
    <div class="container">
        <div class="row">
            <form method="GET" action="/products/search/1" class="form-inline d-flex flex-row mb-2">
                <input class="form-control mr-sm-2" minlength="3" type="search" name="search" value="{{$search ?? ''}}" style="border-bottom-right-radius: 0px; border-top-right-radius: 0px" placeholder="Поиск продуктов"
                       aria-label="Поиск продуктов">
                <button class="btn btn-outline-info my-sm-0" style="border-top-left-radius: 0px; border-bottom-left-radius: 0px;" type="submit">Поиск</button>
            </form>
        </div>
        @include('components.product_pagination')
        <div class="d-flex flex-row justify-content-center flex-wrap">
        @foreach(array_chunk($list, 5) as $row)
                @foreach($row as $item)
                    <div class="card p-1 mb-2" style="width: 16rem; margin-right: 2.5px; background-color: #9ecfff;">

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
        @endforeach
        </div>
        @include('components.product_pagination')

    </div>
    @else
        <div class="container d-flex justify-content-center">
            <p class="text-white">По вашему запросу ничего не найдено</p>
        </div>
    @endif
@endsection
