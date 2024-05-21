<?php

namespace App\Http\Controllers;

use App\Models\DetailPetisi;
use App\Models\Petisi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Locale;

class PetisiController extends Controller
{
    public function insertpetisi(Request $req){
        $rules = [
            'image' => 'nullable|mimes:jpg,png,jpeg',
            'title' => 'required|min:5',
            'detail' => 'required|min:100',
        ];

        if(app()->getLocale() == 'id'){
            $validator = Validator::make($req->all(), $rules, $messages = [
                'title.required' => 'Kolom Judul Petisi dibutuhkan untuk membuat petisi!',
                'detail.required' => 'Kolom Detail Petisi dibutuhkan untuk membuat petisi!',
                'title.min' => 'Judul petisi harus memiliki minimal :min karakter!',
                'title.max' => 'Judul petisi tidak boleh melebihi :max karakter!',
                'detail.min' => 'Detail petisi harus memiliki minimal :min karakter!',
                'mimes' => 'Gambar yang di upload harus memiliki tipe file .jpg/.png/.jpeg'
                ]
            );
        }

        if(app()->getLocale() == 'en'){
            $validator = Validator::make($req->all(), $rules, $messages = [
                'title.required' => 'Petition title field must be filled!',
                'detail.required' => 'Petition detail field must be filled!',
                'title.min' => 'Petition title should have at least :min characters!',
                'title.max' => 'Petition title can\'t exceed :max characters!',
                'detail.min' => 'Petition detail should have at least :min characters!',
                'mimes' => 'Uploaded image must have .jpg/.png/.jpeg file type'
                ]
            );
        }

        if ($validator->fails()){
            return back()->withErrors($validator)->withInput($req->input());
        }

        if ($req->image){
            $file = $req->file('image');

            $fileName = $file->getClientOriginalName();
            Storage::putFileAs('public/img/', $file, $fileName);
        } else{
            $fileName = 'petisi.png';
        }

        $slug = Str::random(40);

        Petisi::insert([
            'slugpet' => $slug.Auth::user()->id,
            'user_id' => Auth::user()->id,
            'judul' => $req->title,
            'sjudul' => Str::substr($req->title, 0, 16),
            'desc' => $req->detail,
            'sdesc' => Str::substr($req->detail, 0, 75),
            'img' => $fileName,
            'created_at' => Carbon::now()->addHours(7),
            'updated_at' => Carbon::now()->addHours(7)
        ]);

        $pet = Petisi::all()->last();

        DetailPetisi::insert([
            'user_id' => Auth::user()->id,
            'pet_id' => $pet->id,
            'petuser' => Auth::user()->id.$pet->id
        ]);
        $lang = app()->getLocale();
        return redirect("/$lang");
    }

    public function detailpetisi($locale, Petisi $petisi){
        // @dd($petisi);
        return view('detailpetisi', ['petisi' => $petisi]);
    }

    public function semuapetisi(Request $request){
        $query = $request->input('to_search');

        $petisi = DB::table('petisis')
          ->where('judul', 'like', "%{$query}%")
          ->orWhere('desc', 'like', "%{$query}%")
          ->orderByDesc('created_at')
          ->paginate(12);

        session()->flashInput($request->input());
        return view('semuapetisi', ['petisi' => $petisi]);
    }

    public function hapuspetisi($locale, $id){
        $petisi = Petisi::where('id', $id)->first();
        // @dd($item);
        Petisi::where('id', $id)->delete();
        return redirect("/$locale/petisisaya");
    }

    public function hapuspetisiadmin($locale, $id){
        $petisi = Petisi::where('id', $id)->first();
        // @dd($item);
        Petisi::where('id', $id)->delete();
        return redirect("/$locale/semuapetisi");
    }
}
