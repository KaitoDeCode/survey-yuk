<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Flasher\Laravel\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PenggunaController extends Controller
{
    //
    protected function createUser(Request $request){

        $validator = Validator::make($request->all(),[
            // "fotoProfile" => "required|image|max:2048",
            "nama" => "required|string|max:50",
            "email" => "email|required|string|max:50|unique:users,email",
            "password" => "required|string"
        ]);

        if($validator->fails()){
            $errors = $validator->errors()->all();
            return response()->json([
                'message' => 'Validasi gagal',
                'errors' => $errors
            ], 422);
        }

        User::create([
            "nama" => $request->nama,
            "email" => $request->email,
            "password" => Hash::make($request->password),
            "role_id" => 1,
        ]);

        return response()->json(["message"=>"Berhasil membuat user"]);
    }

    protected function createSurveyor(Request $request)
    {

        $validator = Validator::make($request->all(),[
            // "fotoProfile" => "required|image|max:2048",
            "nama" => "required|string|max:50",
            "email" => "email|required|string|max:50|unique:users,email",
            "password" => "required|string"
        ]);

        if($validator->fails()){
            $errors = $validator->errors()->all();
            return response()->json([
                'message' => 'Validasi gagal',
                'errors' => $errors
            ], 422);
        }


        User::create([
            "nama" => $request->nama,
            "email" => $request->email,
            "password" => Hash::make($request->password),
            "role_id" => 2,
        ]);

        return response()->json(["message"=>"Berhasil membuat surveyor"]);
    }

    protected function changePermission(Request $request){
       if($request->status) {
            User::find($request->id)->update([
                "permission" => 0,
            ]);
        }else{
           User::find($request->id)->update([
               "permission" => 1,
           ]);
       }

       return response()->json(["message"=>"berhasil mengubah permission user"]);
    }

    protected function getDataUser()
    {
        $user = User::where("role_id",1)->get();
        return response()->json($user);
    }

    protected function getDataSurveyor()
    {
        $user = User::where("role_id",2)->get();
        return response()->json($user);
    }

    protected function deleteSurveyor($id)
    {
        try {
            User::where("role_id",2)->where('id',$id)->first()->delete();
            return response()->json(["message"=>"Berhasil menghapus surveyor"]);
        } catch (Exception $th) {
            return response()->json(["message"=>$th]);
        }
    }
}
