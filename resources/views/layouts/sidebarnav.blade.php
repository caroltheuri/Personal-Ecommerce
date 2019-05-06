<ul class="list-group">
    @foreach($cateories as $category)
        <li class="list-group-item">
            <a href="/posts?month={{$item->month}}&year={{$item->year}}">
            {{$item->month}}
            {{$item->year}}
            ({{$item->published}})
            </a>
        </li>
    @endforeach
</ul>
