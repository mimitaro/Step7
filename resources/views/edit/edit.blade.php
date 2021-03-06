@extends('edit.layout')
@section('title', '商品編集')
@section('edit.content')
<div class="row">
    <div class="mb-5 col-md-6 col-md-offset-2">
        <h2 class="text-secondary">商品編集フォーム</h2>
        <form method="POST" action="{{ route('update') }}" onSubmit="return checkSubmit()" enctype="multipart/form-data">
            @csrf

            <input type="hidden" name="id" value="{{ $product->id }}">

            <div class="form-group text-secondary">
                <label for="title">
                    商品名
                </label>
                <input
                    id="product_name"
                    name="product_name"
                    class="form-control col-md-6"
                    value="{{ $product->product_name }}"
                    type="text"
                >
                @if ($errors->has('product_name'))
                    <div class="text-danger">
                        {{ $errors->first('product_name') }}
                    </div>
                @endif
            </div>

            <div class="form-group text-secondary">
                <label for="company_name">
                    メーカー
                </label>
                <br>
                <select class="form-control col-md-3" name="company_name">
                @foreach($company_names as $company_name)
                <option
                    id="company_id"
                    name="product_name"
                    value="{{ $company_name->id }}"
                        @if ($company_name->id === $product->company_id)
                            selected
                        @endif
                >{{ $company_name->company_name }}
                </option>
                @endforeach
                </select>
                @if ($errors->has('company_name'))
                    <div class="text-danger">
                        {{ $errors->first('company_name') }}
                    </div>
                @endif
            </div>

            <div class="form-group text-secondary">
            <label for="price">
                    価格
                </label>
                <input
                    id="price"
                    name="price"
                    class="form-control col-md-3"
                    value="{{ $product->price }}"
                    type="text"
                >
                @if ($errors->has('price'))
                    <div class="text-danger">
                        {{ $errors->first('price') }}
                    </div>
                @endif
            </div>

            <div class="form-group text-secondary">
            <label for="stock">
                    在庫数
                </label>
                <input
                    id="stock"
                    name="stock"
                    class="form-control col-md-3"
                    value="{{ $product->stock }}"
                    type="text"
                >
                @if ($errors->has('stock'))
                    <div class="text-danger">
                        {{ $errors->first('stock') }}
                    </div>
                @endif
            </div>

            <div class="form-group text-secondary">
                <label for="comment">
                    コメント
                </label>
                <textarea
                    id="comment"
                    name="comment"
                    class="form-control"
                    rows="4"
                >{{ $product->comment }}</textarea>
                @if ($errors->has('comment'))
                    <div class="text-danger">
                        {{ $errors->first('comment') }}
                    </div>
                @endif
            </div>

            <div class="form-group text-secondary">
                <label for="image">
                    商品画像
                </label>
                <br>
                <img src="{{ asset('/storage/' . $product->image) }}" class="img-fluid" alt="{{ $product->image }}" width="200" height="200">
                <br>
                <br>
                <input type="file" class="form-control-file" name='image' id="image">
                @if ($errors->has('image'))
                    <div class="text-danger">
                        {{ $errors->first('image') }}
                    </div>
                @endif
            </div>

            <div class="mt-5">
                <button type="button" class="btn btn-secondary" onclick="location.href='/product/detail/{{ $product->id }}'">
                    戻る
                </button>

                <button type="submit" class="btn btn-primary">
                    更新する
                </button>
            </div>
        </form>
    </div>
</div>
<script>
function checkSubmit(){
if(window.confirm('更新してよろしいですか？')){
    return true;
} else {
    return false;
}
}
</script>
@endsection