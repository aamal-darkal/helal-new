<div class="search-wrapper">
    <a class="search open-modal"><i class="fas fa-search icon-search"></i></a>
    <div id="search-modal" class="search-modal hidden">
        <div class="modal-content">
            <form action="{{ route('home.search') }}">
                <button type="button" class="btn btn-outline-secondary close-modal">&times;</button>
                <input type="search" name="search">
                <button class="btn btn-secondary">search</button>
            </form>
        </div>
    </div>
</div>
