@extends('product.layout')
@section('title', '商品一覧')
@section('content')
<div class="row">
    <!-- 検索バー -->
    <div class="input-group">
        <form class="form-inline">
                <!--入力-->
                    <input type="text" class="form-control input-lg" placeholder="商品名" name="keyword" value="{{ $keyword ?? '' }}">
            <!--プルダウンカテゴリ選択-->
                <select name="company_name" class="form-control">
                    <option selected disabled>メーカー名</option>
                        @foreach($companies as $company)
                        <option value="{{ $company->id }}">{{ $company->company_name }}</option>
                        @endforeach
                    </select>
                        <button type="submit" class="btn btn-primary">検索</button>
        </form>
    </div>

    <div class="mb-5 col-md-10 col-md-offset-2">
        <h2 class="text-secondary mt-3">商品一覧</h2>

        @if (session('err_msg'))
            <p class="text-danger">{{ session('err_msg') }}</p>
        @endif

        <table class="table table-striped text-secondary">
            <tr>
                <th>ID</th>
                <th>商品画像</th>
                <th>商品名</th>
                <th>価格</th>
                <th>在庫数</th>
                <th>メーカー名</th>
                <th></th>
                <th></th>
            </tr>
            @foreach($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td><img src="{{ Storage::url($product->image) }}" class="img-fluid" alt="{{ $product->image }}" width="200" height="200"></td>
                <td>{{ $product->product_name }}</td>
                <td>{{ $product->price }}</td>
                <td>{{ $product->stock }}</td>
                <td>{{ $product->company_name }}</td>
                <td><button type="button" class="btn btn-primary" onclick="location.href='/product/detail/{{ $product->id }}'">詳細</button></td>

                <form method="POST" action="{{ route('delete', $product->id) }}" onSubmit="return checkDelete()">
                    @csrf
                    <td><button type="submit" class="btn btn-secondary" onclick=>削除</button></td>
                </form>
            </tr>
            @endforeach
        </table>
    </div>
</div>
<script>
function checkDelete(){
if(window.confirm('削除してよろしいですか？')){
    return true;
} else {
    return false;
}
}
</script>
@endsection