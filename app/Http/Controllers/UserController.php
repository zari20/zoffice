<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin')->only(['index','destroy']);
        $this->middleware('auth')->only(['show','edit','update','change_password','change_password_form']);
    }

    public function index()
    {
        $users = User::paginate(30);
        return view('users.index',compact('users'));
    }

    public function show(User $user)
    {
        Helper::user_id_check($user);
        return view('users.show',compact('user'));
    }

    public function edit(User $user)
    {
        Helper::user_id_check($user);
        return view('users.edit',compact('user'));
    }

    public function update(Request $request, User $user)
    {
        //get validated data
        $data = UserController::validation($user->id,'nullable');

        //user id check and hacker proof
        Helper::user_id_check($user);
        if(isset($data['type'])) unset($data['type']);

        //update
        User::where('id',$user->id)->update($data);

        //redirection
        Helper::flash();
        return back();
    }

    public function destroy(User $user)
    {
        if ($user->type != 'admin') {
            //delete user instance
            $user->delete();

            //delete user's payment
            if($payment = $user->payment) $payment->delete();

            //redirection
            Helper::flash_delete_message();
            return redirect('users');
        }else {
            return back()->withErrors(['این کاربر ادمین است. ادمین را نمیتوان پاک کرد.']);
        }
    }

    public function change_password_form(User $user)
    {
        return view('users.change_password',compact('user'));
    }

    public function change_password(User $user)
    {
        //form validation
        $data = self::password_validation();

        //check access
        Helper::user_id_check($user);
        if(regular() && ! \Hash::check($data['current_password'], $user->password)){
            return back()->withErrors(["رمز عبور فعلی صحیح نیست"]);
        }

        //change password
        $user->password = bcrypt($data['password']);
        $user->save();

        //redirection
        Helper::message("رمز عبور با موفقیت تغییر یافت.");
        if (admin()) {
            return redirect("users");
        }else {
            //log current user out
            \Auth::logout();
            //redirect to login page
            return redirect("login");
        }
    }

    public static function password_validation()
    {
        $current_password = admin() ? "nullable" : "required";
        return request()->validate([
            "current_password" => "$current_password",
            "password" => "required|string|min:4|confirmed"
        ]);
    }

    public static function validation($id=0,$password_type='required')
    {
        return request()->validate([
            'username' => 'nullable|string|min:3|max:30|unique:users,username,'.$id,
            'email' => 'nullable|string|email|max:190|unique:users,email,'.$id,
            'mobile' => 'required|digits:11|unique:users,mobile,'.$id,
            'telephone' => 'nullable|digits:11|unique:users,telephone,'.$id,
            'city_id' => 'nullable|integer|exists:cities,id',
            'region' => 'nullable|string|max:190',
            'address' => 'nullable|string|max:300',
            'postal_code' => 'nullable|integer|digits:10|unique:users',
            'password' => $password_type.'|string|min:4|confirmed',
        ]);
    }
}
