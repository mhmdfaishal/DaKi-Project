<?php

namespace App\Http\Controllers;

use App\Models\Gunung;
use App\Models\Provinces;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class BasecampController extends Controller
{
    public function index(){
        if(Auth::check()){
            if(Auth::user()->role == "3"){
                $getgunung = Gunung::where('user_id',Auth::user()->id)->first();
                $provinces = Provinces::all();
                $nama = explode(" ",strval(Auth::user()->nama));
                return view('info_gunung',compact('getgunung','nama','provinces'));
            }
        }
    }

    public function storeGunung(Request $request){
        if($request->file('gambar_gunung')){
            $cekgunung = Gunung::where('nama_gunung',$request->nama_gunung)->first();
            if($cekgunung){
                if($request->id_gunung != "null"){
                    if(Auth::user()->id == $cekgunung->user_id){
                        $gambar = $request->file('gambar_gunung');
                        $name= $gambar->getClientOriginalName();
                        $namafile = uniqid();
                        $name= substr(md5($namafile), 6, 6) . '_' . time();
                        
                        $ext = $gambar->getClientOriginalExtension();
                        $gambar->storeAs('public/images/gunung/',"$name.$ext");
                        $data = Gunung::where('id', $request->id_gunung)->first();
                        Storage::delete('public/images/gunung/'.$data->gambar_gunung);
                        $data = Gunung::where('id',$request->id_gunung)->update([
                            'nama_gunung' => $request->nama_gunung,
                            'gambar_gunung' => $name.".".$ext,
                            'lokasi' => $request->lokasi,
                            'provinsi_id' => $request->provinsi_id,
                            'cuaca' => $request->cuaca,
                            'status' => $request->status,
                            'ketinggian' => $request->ketinggian,
                            'htm' => $request->htm,
                            'kuota_pendaki' => $request->kuota_pendaki,
                            'kontak' => $request->kontak,
                            'url_gmaps' => $request->url_gmaps,
                        ]);
                        return response()->json(['data' => $data,'message'=>'Berhasil melakukan perubahan','status' => true]);
                    }
                }
                return response()->json(['error'=>'Gagal melakukan perubahan!','status' => false]);
            }else{
                $gambar = $request->file('gambar_gunung');
                $name= $gambar->getClientOriginalName();
                $namafile = uniqid();
                $name= substr(md5($namafile), 6, 6) . '_' . time();
                $ext = $gambar->getClientOriginalExtension();
                $gambar->storeAs('public/images/gunung/',"$name.$ext");
                if($request->id_gunung != "null"){
                    $data = Gunung::where('id', $request->id_gunung)->first();
                    Storage::delete('public/images/gunung/'.$data->gambar_gunung);
                    if($request->provinsi_id == NULL){
                        $data = Gunung::where('id',$request->id_gunung)->update([
                            'nama_gunung' => $request->nama_gunung,
                            'gambar_gunung' => $name.".".$ext,
                            'lokasi' => $request->lokasi,
                            'cuaca' => $request->cuaca,
                            'status' => $request->status,
                            'ketinggian' => $request->ketinggian,
                            'htm' => $request->htm,
                            'kuota_pendaki' => $request->kuota_pendaki,
                            'kontak' => $request->kontak,
                            'url_gmaps' => $request->url_gmaps,
                        ]);
                    }else{
                        $data = Gunung::where('id',$request->id_gunung)->update([
                            'nama_gunung' => $request->nama_gunung,
                            'gambar_gunung' => $name.".".$ext,
                            'lokasi' => $request->lokasi,
                            'provinsi_id' => $request->provinsi_id,
                            'cuaca' => $request->cuaca,
                            'status' => $request->status,
                            'ketinggian' => $request->ketinggian,
                            'htm' => $request->htm,
                            'kuota_pendaki' => $request->kuota_pendaki,
                            'kontak' => $request->kontak,
                            'url_gmaps' => $request->url_gmaps,
                        ]);
                    }
                }else{
                    $data = Gunung::create([
                        'user_id' => Auth::user()->id,
                        'nama_gunung' => $request->nama_gunung,
                        'gambar_gunung' => $name.".".$ext,
                        'lokasi' => $request->lokasi,
                        'provinsi_id' => $request->provinsi_id,
                        'cuaca' => $request->cuaca,
                        'status' => $request->status,
                        'ketinggian' => $request->ketinggian,
                        'htm' => $request->htm,
                        'kuota_pendaki' => $request->kuota_pendaki,
                        'kontak' => $request->kontak,
                        'url_gmaps' => $request->url_gmaps,
                    ]);
                    $update_alamat_user = User::where('id',Auth::user()->id)->update([
                        'alamat' => $request->lokasi
                    ]);
                }
            }
                if($data){
                    return response()->json(['data' => $data,'message'=>'Created Succesfully','status' => true]);
                }else{
                    return response()->json(['data' => $data,'message'=>'Create Failed','status' => false]);
                }
        }else{
            $cekgunung = Gunung::where('nama_gunung',$request->nama_gunung)->first();
            if($cekgunung){
                if($request->id_gunung != "null"){
                    if(Auth::user()->id == $cekgunung->user_id){
                        if($request->provinsi_id == NULL ){
                            $data = Gunung::where('id',$request->id_gunung)->update([
                                'nama_gunung' => $request->nama_gunung,
                                'lokasi' => $request->lokasi,
                                'cuaca' => $request->cuaca,
                                'status' => $request->status,
                                'ketinggian' => $request->ketinggian,
                                'htm' => $request->htm,
                                'kuota_pendaki' => $request->kuota_pendaki,
                                'kontak' => $request->kontak,
                                'url_gmaps' => $request->url_gmaps,
                            ]);
                        }else{
                            $data = Gunung::where('id',$request->id_gunung)->update([
                                'nama_gunung' => $request->nama_gunung,
                                'lokasi' => $request->lokasi,
                                'provinsi_id' => $request->provinsi_id,
                                'cuaca' => $request->cuaca,
                                'status' => $request->status,
                                'ketinggian' => $request->ketinggian,
                                'htm' => $request->htm,
                                'kuota_pendaki' => $request->kuota_pendaki,
                                'kontak' => $request->kontak,
                                'url_gmaps' => $request->url_gmaps,
                            ]);
                        }
                        if($data){
                            return response()->json(['data' => $data,'message'=>'Berhasil melakukan perubahan','status' => true]);
                        }else{
                            return response()->json(['error'=>'Gagal melakukan perubahan','status' => false]);
                        }
                    }
                }
                return response()->json(['error'=>'Data sudah ada!','status' => false]);
            }else{
                if($request->id_gunung != "null"){
                    $data = Gunung::where('id', $request->id_gunung)->first();
                    Storage::delete('public/images/gunung/'.$data->gambar_gunung);
                    $data = Gunung::where('id',$request->id_gunung)->update([
                        'nama_gunung' => $request->nama_gunung,
                        'lokasi' => $request->lokasi,
                        'provinsi_id' => $request->provinsi_id,
                        'cuaca' => $request->cuaca,
                        'status' => $request->status,
                        'ketinggian' => $request->ketinggian,
                        'htm' => $request->htm,
                        'kuota_pendaki' => $request->kuota_pendaki,
                        'kontak' => $request->kontak,
                        'url_gmaps' => $request->url_gmaps,
                    ]);
                    if($data){
                        return response()->json(['data' => $data,'message'=>'Berhasil melakukan perubahan','status' => true]);
                    }else{
                        return response()->json(['error'=>'Gagal melakukan perubahan','status' => false]);
                    }
                }else{
                    return response()->json(['error'=>'Gambar gunung diperlukan!','status' => false]);
                }
            }
        }
    }

    public function destroyGunung($id){
        $data = Gunung::where('id', $id)->first();
        if($data){
            Storage::delete('public/images/gunung/'.$data->gambar_gunung);
            $delete = Gunung::where('id', $id)->delete();
            if($delete){
                return response()->json(['message'=>'Delete Succesfully','status' => true]);
            }else{
                return response()->json(['error'=>'Delete Failed','status' => false]);
            }
        }else{
            return response()->json(['error'=>'Data not found!','status' => false]);
        }
    }
}
