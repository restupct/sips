<div>
    <li class="nav-item ms-3">
        <a href="{{ route('shop.cart') }}"
            class="nav-link {{ request()->routeIs('shop.cart') ? 'active' : '' }}">
            <div class="nav-icon">
                <div class="bi bi-cart-fill" style="font-size: 1.5rem"> {{ $cartTotal }}</div>
                <span>Keranjang</span>
            </div>
            </a>
    </li>
</div>
