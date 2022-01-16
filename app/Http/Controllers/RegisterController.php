<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /**
     * 新規登録画面を表示
     * 
     * @return view
     */
    public function showRegister()
    {
        return view('register.register');
    }

    /**
     * 新規登録処理
     * 
     * @return 
     */
    public function exeRegister(RegisterRequest $request) 
    {
        
        DB::beginTransaction();
        try{
            $user = new User();
            $user->user_name = $request->user_name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();  

            DB::commit();
        }catch(\Exception $e){
            DB::rollBack();
        }

        \Session::flash('success_msg', '登録が完了しました!');
        return redirect(route('login'));
    }
}
