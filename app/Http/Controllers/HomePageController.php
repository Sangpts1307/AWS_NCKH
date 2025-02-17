<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Models\File;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomePageController extends Controller
{
    public function postLogin(Request $request)
    {
        $param = $request->all();
        if ($param['email'] && $param['password']) {
            Auth::attempt([
                'email' => $param['email'],
                'password' => $param['password']
            ]);
            return redirect('homePage');
        }
    }
    public function homePage(Request $request)
    {   
        $param = $request->all();
        $files = File::select(
            'id', 'file_name', 'created_at'
        )->where(function($query) use($param) {
            if (isset($param['file_name'])) {
                $query = $query->where('file_name', 'LIKE', '%' . $param['file_name'] . '%'); 
            }
            if (isset($param['from_date'])) {
                $query = $query->where('created_at', '>=', $param['from_date']); 
            }
            if (isset($param['to_date'])) {
                $query = $query->where('created_at', '<=', $param['to_date']); 
            }
        })
        ->orderBy('created_at', 'desc')
        ->paginate(15);
        return view('homePage', compact('files', 'param'));
    }

    public function upload(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            // $originalName = $file->getClientOriginalName();
            // $timestamp = date('H:i:s');
            // $originalName = $timestamp.'_'. $file->getClientOriginalName();
            $originalName = time().'_'. $file->getClientOriginalName();
            try {
                DB::beginTransaction();
                // Storage::disk('s3')->put('uploads', $file);
                Storage::disk('s3')->putFileAs('uploads', $file, $originalName);
                $createFile = new File();
                $createFile->file_name = $originalName;
                $createFile->created_at = Carbon::now();
                $createFile->save();
                DB::commit();
            } catch(\Exception $e) {
                DB::rollBack();
                dd($e);
            }
            return redirect('homePage');
        }
    }

    public function download(Request $request, $id)
    {
        $file = File::find($id);
        if ($file) {
            return Storage::disk('s3')->download('uploads/' . $file->file_name);
        } else {
            return [
                'code'=>204,
                'message'=>'Cannot find data'
            ];
        }
    }

    public function delete(Request $request, $id)
    {
        $file = File::find($id);
        if ($file) {
            Storage::disk('s3')->delete('uploads/' . $file->file_name);
            $file->delete();
            return redirect('/homePage');
        } else {
            return [
                'code'=>204,
                'message'=>'Cannot find data'
            ];
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/login');
    }
}
