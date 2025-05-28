<div class="menu-links">
    @foreach($items as $item)
        <li class="{{ count($item->children) >0 ? 'has-dropdown':'' }}"><a href="{{ count($item->children) > 0 ? 'javascript:void(0)': $item->url}}" 
            onclick="{{ count($item->children) > 0 ? 'toggleDropdown(event)': 'toggleMenu()' }}">{{$item->title}}</a>
        @if(count($item->children) >0)
            <ul class="dropdown-menu active">
            @foreach($item->children as $child)
            <li>{{$child->title}}</li>
            @endforeach
        </ul>
        @endif
        </li>
    @endforeach
</div>