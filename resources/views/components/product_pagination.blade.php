@if(count($pagination) > 1)
<div class="row align-items-center">
    <nav aria-label="...">
        <ul class="pagination pagination-sm justify-content-end">
            @if(!empty($search))
                @foreach($pagination as $page => $fields)
                    <li class="page-item {{$fields['isActive'] ? 'disabled' : ''}}">
                        <a class="page-link" href="/products/search/{{$page . $fields['params']}}" tabindex="-1">{{$page}}</a>
                    </li>
                @endforeach
            @else
                @foreach($pagination as $page => $fields)
                    <li class="page-item {{$fields['isActive'] ? 'disabled' : ''}}">
                        <a class="page-link" href="/products/{{$page . $fields['params']}}" tabindex="-1">{{$page}}</a>
                    </li>
                @endforeach
            @endif
        </ul>
    </nav>
</div>
@endif
