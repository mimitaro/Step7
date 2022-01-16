<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Company;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * 商品一覧を表示する
     * 
     * @return view
     */
    public function showList(Request $request)
    {
        $products = Product::with('company');

        // セレクトボックスにメーカー名を取得して表示
        $companies = \DB::table('companies')->get();

        // 入力される値nameの定義
        $keyword = $request->input('keyword'); // 商品名
        $company_name = $request->input('company_name'); // メーカー名

        $query = Product::query()->with('company');

        if (!empty($keyword))
        {
            $products = \DB::table('companies')
            ->join('products','companies.id','=','products.company_id')
            ->where('product_name', 'LIKE', "%{$keyword}%")
            ->get();
        }
        elseif (isset($company_name))
        {
            $products = \DB::table('companies')
            ->join('products','companies.id','=','products.company_id')
            ->where('company_id', $company_name)
            ->get();
        }
        else {
            // INNAR JOIN
            $products = \DB::table('companies')
            ->join('products','companies.id','=','products.company_id')
            ->get();
        }

        if (Auth::check())
        {
            return view('product.list',
            [
            'products' => $products,
            'keyword' => $keyword,
            'companies' => $companies,
            'company_name' => $company_name,
            ]
        );
        } else {
            return view('login.login');
        }
    }

    /**
     * 商品詳細を表示する
     * @param int $id
     * @return view
     */
    public function showDetail($id)
    {
        $product = Product::with('company')->find($id);

        if (is_null($product)) {
            \Session::flash('err_msg', 'データがありません。');
            return redirect(route('products'));
        }
        if (Auth::check())
        {
        return view('detail.detail', ['product' => $product]);
        } else {
            return view('login.login');
        }
    }

    /**
     * 商品登録画面を表示する
     * 
     * @return view
     */
    public function showCreate()
    {
        $products = Company::all();
        
        if (Auth::check())
        {
            return view('create.create', ['products' => $products]);
        } else {
            return view('login.login');
        }
    }

    /**
     * 商品を登録する
     * 
     * @return view
     */
    public function exeStore(ProductRequest $request)
    {
        // 商品のデータを受け取る
        $inputs = $request->all();

        $image = $request->file('image');

        // // 画像がアップロードされていれば、storageに保存
        if ($request->hasFile('image'))
        {
            $path = \Storage::put('/public', $image);
            $path = explode('/', $path);
        } else {
            $path = null;
        }

        \DB::beginTransaction();
        try {
        // 商品を登録
        Product::create([
            'company_id' => $inputs['company_id'],
            'product_name' => $inputs['product_name'], 
            'price' => $inputs['price'],
            'stock' => $inputs['stock'],
            'comment' => $inputs['comment'],
            'image' => $path[1],
        ]);
        \DB::commit();
        } catch(\Throwable $e) {
            \DB::rollback();
            abort(500);
        }

        \Session::flash('err_msg', '商品を登録しました。');
        return redirect(route('products'));
    }

    /**
     * 商品編集フォームを表示する
     * @param int $id
     * @return view
     */
    public function showEdit($id)
    {
        $product = Product::find($id);

        $company_names = Company::all();

        if (is_null($product)) {
            \Session::flash('err_msg', 'データがありません。');
            return redirect(route('products'));
        }
        return view('edit.edit', ['product' => $product, 'company_names' => $company_names]);
    }

    /**
     * 商品を更新する
     * 
     * @return view
     */
    public function exeUpdate(Request $request, Product $product)
    {
        // 商品のデータを受け取る
        $inputs = $request->all();

         // 画像ファイルインスタンス取得
        $image = $request->file('image');

        // 現在の画像へのパスをセット
        $path = $product->image;

        if (isset($image))
        {
            // 現在の画像ファイルの削除
            \Storage::disk('public')->delete($path);
            
            // 選択された画像ファイルを保存してパスをセット
            $path = $image->store('products', 'public');
        }

        \DB::beginTransaction();
        try {
        // 商品を更新
        $product = Product::find($inputs['id']);

        $product->fill([
            'product_name' => $inputs['product_name'],
            'company_name' =>$inputs['company_name'],
            'price' => $inputs['price'],
            'stock' => $inputs['stock'],
            'comment' => $inputs['comment'],
            'image' => $path,
        ]);

        $product->save();

        \DB::commit();
        } catch(\Throwable $e) {
            \DB::rollback();
            abort(500);
        }

        \Session::flash('err_msg', '商品を更新しました。');
        return redirect(route('products'));
    }

    /**
     * 商品を削除する
     * @param int $id
     * @return view
     */
    public function exeDelete($id)
    {
        if (empty($id)) {
            \Session::flash('err_msg', 'データがありません。');
            return redirect(route('products'));
        }

        try {
            // 商品を削除
                Product::destroy($id);
            } catch(\Throwable $e) {
                abort(500);
            }
        
            \Session::flash('err_msg', '商品を削除しました。');
            if (Auth::check())
            {
                return redirect(route('products'));
            } else {
                return view('login.login');
            }
    }

    /**
     * ログアウト
     * 
     * @return view
     */
    public function getLogout(){
        Auth::logout();
        return redirect()->route('login');
        }
}