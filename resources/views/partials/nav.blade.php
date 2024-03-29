{{-- <header>
    <div class = "top-nav container">
    <div class = "logo"><a href = "/">Laravel Ecommerce</a></div>
        @if (! request()->is('checkout'))
        
        <ul>
            @foreach($items as $menu_item)
                <li>
                    <a href = "{{ $menu_item->link() }}">
                        {{ $menu_item->title }}
                        @if ($menu_item->title =='Cart')
                             @if (Cart::instance('default')->count() > 0)
                                <span class = "cart-count"><span>{{ Cart::instance('default')->count() }}</span></span>
                            @endif
                        @endif
                    </a>
                </li>
            @endforeach
        </ul>
        @endif
    </div> <!-- end top-nav -->
</header> --}}
<header>
    <div class="top-nav container">
      <div class="top-nav-left">
          <div class="logo"><a href="/">Ecommerce</a></div>
          @if (! (request()->is('checkout') || request()->is('guestCheckout')))
          {{ menu('main', 'partials.menus.main') }}
          @endif
      </div>
      <div class="top-nav-right">
          @if (! (request()->is('checkout') || request()->is('guestCheckout')))
          @include('partials.menus.main-right')
          @endif
      </div>
    </div> <!-- end top-nav -->
</header>