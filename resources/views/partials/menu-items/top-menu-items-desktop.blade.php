<ul class="nav-links">
    @foreach($items as $item)
        <li><a href="{{$item->url}}">{{$item->title}}</a></li>
    @endforeach
</ul>