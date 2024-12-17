@foreach ($categories as $category)
    @if (count($category->child) == 0)
        <li>
            <a class="dropdown-item" href="{{ route('productByCategory', $category->slug) }}">{{ $category->name }}</a>
        </li>
    @else
        <li class="nav-item">
            <div class="menu-item">
                <a class="nav-link dropdown-toggle" href="{{ route('productByCategory', $category->slug) }}">
                    {{ $category->name }}
                </a>
                <i class='bx bx-chevron-down'></i>
            </div>
            <ul class="dropdown-menu">
                @foreach ($category->child as $child)
                    <li><a class="dropdown-item"
                            href="{{ route('productByCategory', $child->slug) }}">{{ $child->name }}</a></li>
                @endforeach
            </ul>
        </li>
    @endif
@endforeach
