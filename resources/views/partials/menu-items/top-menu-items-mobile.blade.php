<div class="menu-links">
    @foreach($items as $item)
        <li><a href="{{$item->url}}" onclick="toggleMenu()">{{$item->title}}</a></li>
    @endforeach
</div>