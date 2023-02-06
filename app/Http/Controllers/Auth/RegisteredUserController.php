<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\FamilyGroup;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // バリデーション
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'group_id' => ['required', 'string', 'max:255'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // ラジオボタンのオンオフの条件判定のため
        $family_check = $request->family_check;
        
        // if (新規の家族グループを作成する) else (既存の家族グループに参加する)
        if($family_check === "2"){
            
            // 新規の家族グループを作成する場合にのみ、"family_groups"テーブルの"name"との重複排除
            $request->validate([
                'group_id' => ['required', 'string', 'max:255', 'unique:family_groups,name'],
            ]);
            
            // フォーム(家族グループID)に入力した値を"family_groups"テーブルの"name"に設定
            $familygroup = FamilyGroup::create([
                'name' => $request->group_id,
            ]);
            
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                // "family_groups"テーブルに新規追加したレコードの"id"を"users"テーブルの"group_id"に設定
                'group_id' => $familygroup->id,
                'password' => Hash::make($request->password),
            ]);
            
        }else {
            
            // フォーム(家族グループID)に入力した値で、"family_groups"テーブルの"name"を検索し、
            // それに紐づく"id"を取得
            $select_record = FamilyGroup::where('name', $request->group_id)->first();
            
            // if (既存のグループIDがレコードに存在するとき)
            if(isset($select_record)){
                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    // フォーム(家族グループID)に入力した値で、"family_groups"テーブルの"name"を検索し、
                    // それに紐づく"id"を"users"テーブルの"group_id"に設定
                    'group_id' => $select_record->id,
                    'password' => Hash::make($request->password),
                ]);
            }
            
            // 既存のグループIDがレコードに存在しないときバリデーションエラー
            $request->validate([
                'group_id' => [
                    'required',
                    Rule::exists('family_groups', 'name')->where(function ($query) use ($request) {
                        $query->where('name', $request->group_id);
                    }),
                ],
            ]);

        }
        
        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
