<header id="header-area" class="fixed-top container-fluid">
    <div class="d-flex justify-content-between align-items-center">
        <div class="logo-wrapper">
            <a href="{{ route('home.index') }}">
                <img class="logo" src="{{ getImgUrl($components['logo']) }}" alt="Logo">
            </a>
        </div>

        <div class="left-icons">
            <button class="menu-togggle btn btn-salmon btn-sm ms-2" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                {{-- <i class="fa-solid fa-square-caret-down"></i> --}}
                <i class="fa-solid fa-caret-down"></i>
                {{-- <i class="fa-solid fa-bars"></i> --}}
            </button>
            <form action="{{ route('language') }}" class="d-inline-block">
                <button class="btn btn-salmon ms-2">@lang('helal.lang')</button>
            </form>
        </div>
    </div>
</header>
