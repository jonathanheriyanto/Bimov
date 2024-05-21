<?php

namespace App\Http\Controllers;

use App\Models\DetailPetisi;
use App\Models\Petisi;
use App\Models\User;
use App\Rules\BinusianValidation;
use App\Rules\MaxWordsRule;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //
    public function register(Request $req){
        $rules = [
            'name' => 'required|regex:/[a-zA-Z\s]+/',
            'nim' => 'required|numeric|digits:10|unique:users,nim',
            'email' => ['required','email','unique:users,email', new BinusianValidation],
            'password' => 'required|min:5|max:20',
            'cpassword' => 'required|min:5|max:20|same:password',
        ];

        if(app()->getLocale() == 'id'){
            $validator = Validator::make($req->all(), $rules, $messages = [
                'required' => 'Kolom :attribute dibutuhkan untuk pendaftaran!',
                'regex' => 'Kolom Nama hanya dapat diisi dengan karakter dan spasi!',
                'numeric' => 'Kolom NIM hanya dapat diisi dengan angka!',
                'unique' => ':attribute-mu sudah terdaftar dalam sistem!',
                'digits' => 'Kolom NIM wajib diisi dengan :digits digit!',
                'min' => 'Kata sandi harus memiliki minimal :min karakter!',
                'max' => 'Kata sandi tidak boleh melebihi :max karakter!',
                'same' => 'Kata sandi tidak sesuai!'
                ]
            );
        }

        if(app()->getLocale() == 'en'){
            $validator = Validator::make($req->all(), $rules, $messages = [
                'required' => 'The :attribute field is needed to register!',
                'regex' => 'The name field can only consists of characters and spaces!',
                'numeric' => 'The NIM field can only consists of digits!',
                'unique' => 'Your :attribute is already registered in our system!',
                'digits' => 'The NIM field must be exactly :digits digits!',
                'min' => 'Password must have a minimum character of :min characters!',
                'max' => 'Password cannot exceed :max characters!',
                'same' => 'Password doesn\'t match!'
                ]
            );
        }

        if ($validator->fails()){
            return back()->withErrors($validator)->withInput($req->input());
        }

        $name = $req->name;
        $arrfname = explode(' ',trim($name));
        $fname = $arrfname[0];

        User::insert([
            'nama' => $req->name,
            'fnama' => $fname,
            'nim' => $req->nim,
            'email' => $req->email,
            'password' => bcrypt($req->password),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        $lang = app()->getLocale();
        return redirect("/$lang/login");
    }

    public function login(Request $req){
        $rules = [
            'email' => 'required|email:rfc,dns',
            'password' => 'required|min:5|max:20',
        ];

        $validator = Validator::make($req->all(), $rules);

        if ($validator->fails()){
            return back()->withErrors($validator)
                         ->withInput($req->input());
        }

        $credentials = [
            'email' => $req->email,
            'password'=> $req->password
        ];

        if($req->remember){
            Cookie::queue('emailcookie', $req->email, 60);
            Cookie::queue('passcookie', $req->password, 60);
        }

        if(Auth::attempt($credentials, true)){
            $req->session()->regenerate();
            return redirect()->intended('/');
        }


        if(app()->getLocale() == 'id'){
            return back()->with('loginError', 'Akun anda tidak terdaftar atau data yang anda masukkan tidak sesuai!')->withInput($req->input());
        }

        if(app()->getLocale() == 'en'){
            return back()->with('loginError', 'Your account is not registered or does not match our record!')->withInput($req->input());
        }
    }

    public function logout(){
        Auth::logout();
        $lang = app()->getLocale();
        return redirect("/$lang/login");
    }

    public function dukungpetisi(Request $req){
        $rules = [
            'petuser' => 'unique:detail_petisis,petuser'
        ];

        if(app()->getLocale() == 'id'){
            $validator = Validator::make($req->all(), $rules, $messages = [
                'petuser.unique' => 'Kamu sudah mendukung petisi ini!',
            ]);
        }
        if(app()->getLocale() == 'en'){
            $validator = Validator::make($req->all(), $rules, $messages = [
                'petuser.unique' => 'You\'ve signed this petition!',
            ]);
        }


        if ($validator->fails()){
            return back()->withErrors($validator);
        }

        $pet = Petisi::firstwhere('id', '=', $req->petid);
        // $counter = $pet->counter + 1;
        // @dd($counter);

        Petisi::where('id', '=', $req->petid)->update([
            'counter' => $pet->counter + 1
        ]);

        DetailPetisi::insert([
            'user_id' => Auth::user()->id,
            'pet_id' => $req->petid,
            'petuser' => $req->petuser
        ]);


        if(app()->getLocale() == 'id'){
            return back()->with('success', 'Berhasil memberikan dukungan ke petisi ini!');
        }

        if(app()->getLocale() == 'en'){
            return back()->with('success', 'Successfully signed the petition!');
        }
    }

    public function mulaiview(){
        return view('mulaipetisi');
    }

    public function petisisaya(){
        $petisi = Petisi::where('user_id', '=', auth()->id())->get();
        $dukung = DetailPetisi::where('user_id', '=', auth()->id())->get();
        return view('petisisaya', ['petisi' => $petisi, 'dukung' => $dukung]);
    }

    public function viewprofil(){
        return view('editprofil');
    }

    public function editprofil(Request $req){
        $rules = [
            'name' => 'regex:/[a-zA-Z\s]+/',
            'fnama' => ['regex:/[a-zA-Z\s]+/', new MaxWordsRule],
            'pass' => 'current_password',
            'cpass' => 'min:5|max:20',
        ];

        if(app()->getLocale() == 'id'){
            $validator = Validator::make($req->all(), $rules, $messages = [
                'regex' => 'Kolom Nama hanya dapat diisi dengan karakter dan spasi!',
                'min' => 'Kata sandi baru harus memiliki minimal :min karakter!',
                'max' => 'Kata sandi baru tidak boleh melebihi :max karakter!',
                'current_password' => 'Kata sandi saat ini tidak sesuai dengan data yang ada!'
                ]
            );
        }

        if(app()->getLocale() == 'en'){
            $validator = Validator::make($req->all(), $rules, $messages = [
                'regex' => 'The name field can only consists of characters and spaces!',
                'min' => 'New Password must contains at least :min characters!',
                'max' => 'New Password cannot exceed :max characters!',
                'current_password' => 'Current Password doesn\'t match our records!'
                ]
            );
        }

        if ($validator->fails()){
            return back()->withErrors($validator)->withInput($req->input());
        }

        User::where('id', '=', auth()->id())->update([
            'nama' => $req->name,
            'fnama' => $req->fnama,
            'password' => bcrypt($req->cpass),
            'updated_at' => Carbon::now()
        ]);

        return back();
    }
}
