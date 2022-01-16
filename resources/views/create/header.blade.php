<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <h3 class="navbar-brand">販売管理</h3>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
            <a class="nav-item nav-link" href="{{ route('products') }}">商品一覧 <span class="sr-only"></span></a>
            <a class="nav-item nav-link active" href="{{ route('create') }}">商品登録</a>
        </div>
    </div>
    @if(Auth::check())
    <a class="text-light navbar-right" href="{{ route('logout') }}">ログアウト</a>
    @endif
</nav>