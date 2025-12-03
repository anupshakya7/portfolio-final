<ul class="nav-links">
    @foreach($items as $item)
    <?php 
    if(!empty($item->url)){
        $url = $item->url;
        $href = !empty($item->url) ? "href=$url" : '';
    }else{
        $href = '';
    }
    ?>
        <li class={{ count($item->children) > 0 ? 'has-dropdown':'' }}> <a  {{ $href }}>{{$item->title}}</a>
        @if(count($item->children) > 0)
        <ul class="dropdown-menu" id="{{ Str::slug($item->title) }}-menu">
            @foreach($item->children as $child)
                <li><a href="{{$child->url}}">{{$child->title}}</a></li>
            @endforeach
        </ul>
        @endif
        </li>
    @endforeach
</ul>