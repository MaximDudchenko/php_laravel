<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('account.edit', Auth()->user()) }}">{{ __('Edit Profile') }}</a>
                </li>
{{--                <li class="nav-item">--}}
{{--                    <a class="nav-link" href="{{ route('accounts.wishlist') }}">{{ __('WishList') }}</a>--}}
{{--                </li>--}}
            </ul>
        </div>
    </div>
</nav>
