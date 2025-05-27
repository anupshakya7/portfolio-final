<ul class="nav-links">
    @foreach($items as $item)
        <li class={{ count($item->children) > 0 ? 'has-dropdown':'' }}> <a href="{{$item->url}}">{{$item->title}}</a>
        @if(count($item->children) > 0)
        <ul class="dropdown-menu" id="{{ Str::slug($item->title) }}-menu">
            @foreach($item->children as $child)
                <li><a href="{{$child->url}}">{{$child->title}}</a></li>
                <li><a href="{{$child->url}}">{{$child->title}}</a></li>
                <li><a href="{{$child->url}}">{{$child->title}}</a></li>
                <li><a href="{{$child->url}}">{{$child->title}}</a></li>
                <li><a href="{{$child->url}}">{{$child->title}}</a></li>
            @endforeach
        </ul>
        @endif
        </li>
    @endforeach
</ul>