<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Follower;
use App\Models\Toko;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class StoreController extends Controller
{
    public function detail(){
        if(Auth::check()){
            $user = Auth::user();
            $data = Toko::where('user_id',$user->id)->first();
            $nama = explode(" ",strval($user->nama));
            $has_toko = Toko::where('user_id',$user->id)->first();
            if($user->role == '2' || $has_toko){
                return view('info_toko_admin', compact('nama', 'data','has_toko'));
            }elseif($user->role == '1'){
                return view('info_toko_admin', compact('nama','has_toko'));
            }
            return redirect()->back();
        }
    }
    public function storeToko(Request $request){
        $cektoko = Toko::where('user_id',Auth::user()->id)->first();
        $cek_nama_toko = Toko::where('nama_toko',$request->nama_toko)->where('user_id','!=',Auth::user()->id)->first();
        if($cek_nama_toko){
            return response()->json(['error'=>'Nama toko sudah terdaftar!','status' => false]);
        }
        if($cektoko){
            if($request->file('gambar_toko')){
                $gambar = $request->file('gambar_toko');
                $name_picture= time(). "_". $gambar->getClientOriginalName();
                $get_toko = Toko::where('user_id',Auth::user()->id)->first();
                $gambar->storeAs('public/images/toko/'.$get_toko->nama_toko.'/logo'.'/',$name_picture);

                Storage::delete('public/images/toko/'.$cektoko->logo_toko);
                $rename = rename(public_path().'/storage/images/toko/'.$get_toko->nama_toko, public_path().'/storage/images/toko/'.$request->nama_toko);
                Toko::where('user_id',Auth::user()->id)->update([
                    'nama_toko' => $request->nama_toko,
                    'logo_toko' => $name_picture,
                    'kotakabupaten' => $request->kotakabupaten,
                    'no_rek' => $request->no_rek,
                    'provider_rek' => $request->provider_rek,
                    'nama_rek' => $request->nama_rek,
                    'alamat' => $request->alamat,
                    'kontak' => $request->kontak,
                    'url_gmaps' => $request->url_gmaps
                ]);
                return response()->json(['data' => $cektoko,'message'=>'Update Succesfully','status' => true]);
            } else {
                $get_toko = Toko::where('user_id',Auth::user()->id)->first();
                $rename = rename(public_path().'/storage/images/toko/'.$get_toko->nama_toko, public_path().'/storage/images/toko/'.$request->nama_toko);
                Toko::where('user_id',Auth::user()->id)->update([
                    'nama_toko' => $request->nama_toko,
                    'kotakabupaten' => $request->kotakabupaten,
                    'no_rek' => $request->no_rek,
                    'provider_rek' => $request->provider_rek,
                    'nama_rek' => $request->nama_rek,
                    'alamat' => $request->alamat,
                    'kontak' => $request->kontak,
                    'url_gmaps' => $request->url_gmaps
                ]);
                
                return response()->json(['data' => $cektoko,'message'=>'Update Succesfully','status' => true]);
            }
        } else {
            if($request->file('gambar_toko')){
                $gambar = $request->file('gambar_toko');
                $name_picture= time(). "_". $gambar->getClientOriginalName();
                $path = public_path().'/storage/images/toko/'.$request->nama_toko;
                if (!mkdir($path, 0, true)) {
                    // die('Gagal membuat folder...');
                }
                $gambar->storeAs('public/images/toko/'.$request->nama_toko.'/logo'.'/',$name_picture);
                Toko::create([
                    'user_id' => Auth::user()->id,
                    'nama_toko' => $request->nama_toko,
                    'logo_toko' => $name_picture,
                    'kotakabupaten' => $request->kotakabupaten,
                    'no_rek' => $request->no_rek,
                    'provider_rek' => $request->provider_rek,
                    'nama_rek' => $request->nama_rek,
                    'alamat' => $request->alamat,
                    'kontak' => $request->kontak,
                    'url_gmaps' => $request->url_gmaps,
                    'rating' => 0,
                    'follower' => 0
                ]);
                $update_alamat_user = User::where('id',Auth::user()->id)->update([
                    'alamat' => $request->alamat
                ]);
                $user = Auth::user();
                if($user->role == '1'){
                    $update_status = User::where('id',$user->id)->update([
                        'role' => '2'
                    ]);
                }
                return response()->json(['data' => $cektoko,'message'=>'Create Succesfully','status' => true]);
            }
        }
    }
    public function storeBarang(Request $request){
        $cektoko = Toko::where('user_id',Auth::user()->id)->first();
        if($request->id_barang){
            $cekbarang = Barang::where('id', $request->id_barang)->first();
            if($cekbarang){
                if($request->file('gambar_barang')){
                    $gambar = $request->file('gambar_barang');
                    $name_picture= time(). "_". $gambar->getClientOriginalName();
                    $gambar->storeAs('public/images/toko/'.$cektoko->nama_toko.'/barang',$name_picture);
                    Storage::delete('public/images/toko/'.$cektoko->nama_toko.'/barang'.'/'.$cekbarang->gambar_barang);
                    Barang::where('id',$request->id_barang)->update([
                        'nama_barang' => $request->nama_barang,
                        'gambar_barang' => $name_picture,
                        'harga' => $request->harga,
                        'interval' => $request->interval,
                        'interval_number' => $request->interval_number,
                        'deskripsi' => $request->deskripsi
                    ]);
                    return response()->json(['data' => $cektoko,'message'=>'Berhasil mengedit barang','status' => true]);
                } else {
                    Barang::where('id',$request->id_barang)->update([
                        'nama_barang' => $request->nama_barang,
                        'harga' => $request->harga,
                        'interval' => $request->interval,
                        'interval_number' => $request->interval_number,
                        'deskripsi' => $request->deskripsi
                    ]);
                    
                    return response()->json(['data' => $cektoko,'message'=>'Berhasil mengedit barang','status' => true]);
                }
                return response()->json(['data' => NULL,'error'=>'Gagal mengedit barang','status' => false]);
            }
            return response()->json(['data' => NULL,'error'=>'Gagal store barang','status' => false]);
        } else {
            if($request->file('gambar_barang')){
                $gambar = $request->file('gambar_barang');
                $name_picture= time(). "_". $gambar->getClientOriginalName();
                $gambar->storeAs('public/images/toko/'.$cektoko->nama_toko.'/barang',$name_picture);
                Barang::create([
                    'toko_id' => $cektoko->id,
                    'nama_barang' => $request->nama_barang,
                    'gambar_barang' => $name_picture,
                    'harga' => $request->harga,
                    'interval' => $request->interval,
                    'interval_number' => $request->interval_number,
                    'deskripsi' => $request->deskripsi
                ]);
                return response()->json(['data' => $cektoko,'message'=>'Berhasil menambahkan barang','status' => true]);
            }
            return response()->json(['data' => NULL,'error'=>'Gagal menambahkan barang','status' => false]);
        }
    }
    public function followUnfollow(Request $request){
        if(Auth::check()){
            $user = Auth::user();
            $cekfollow = Follower::where('user_id',$user->id)->where('toko_id',$request->toko_id)->first();
            if($cekfollow){
                $delete = Follower::where('user_id',$user->id)->where('toko_id',$request->toko_id)->delete();

                $jumlah_followers = Follower::where('toko_id',$request->toko_id)->get();

                $addfollower = Toko::where('id',$request->toko_id)->update([
                    'follower' => $jumlah_followers->count()
                ]);

                return response()->json(['data' => $jumlah_followers->count(),'html'=>'<i class="fas fa-plus"></i> Ikuti','message'=>'Unfollowed','status' => true]);
            }else{
                $addfollower = Follower::create([
                    'user_id' => $user->id,
                    'toko_id' => $request->toko_id
                ]);

                $jumlah_followers = Follower::where('toko_id',$request->toko_id)->get();
                $addfollower = Toko::where('id',$request->toko_id)->update([
                    'follower' => $jumlah_followers->count()
                ]);

                return response()->json(['data' => $jumlah_followers->count(),'html' => '<i class="fas fa-user-check"></i> Mengikuti','message'=>'Followed','status' => true]);
            }
        }else{
            return redirect()->back();
        }
    }

    public function getBarang($id){
        $data = Barang::where('id', $id)->first();
        if($data){
            return response()->json($data);
        }else{
            return response()->json(['error'=>'Data not found!','status' => false]);
        }
    }
    public function detailBarang($id){
        $data = Barang::where('id', $id)->first();
        if($data){
            return response()->json(['data'=>$data,'nama_toko'=>$data->toko->nama_toko]);
        }else{
            return response()->json(['error'=>'Data not found!','status' => false]);
        }
    }
    public function destroyToko($id){
        $data = Toko::where('id', $id)->first();
        if($data && Auth::check()){
            $user = Auth::user();
            if($data->user_id == $user->id){
                Storage::delete('public/images/toko/'.$data->logo_toko);
                $delete_barang = Barang::where('toko_id',$data->id)->delete();
                $delete = Toko::where('id', $id)->delete();
                $update_status = User::where('id',$user->id)->update([
                    'role'=>'1',
                ]);
                if($delete && $update_status){
                    return response()->json(['message'=>'Berhasil hapus','status' => true]);
                }else{
                    return response()->json(['error'=>'Gagal hapus','status' => false]);
                }
            }
        }else{
            return response()->json(['error'=>'Tidak ada data!','status' => false]);
        }
    }
    public function destroyBarang($id){
        $data = Barang::where('id', $id)->first();
        if($data && Auth::check()){
            $user = Auth::user();
            if($data->toko->user->email == $user->email){
                Storage::delete('public/images/toko/'.$data->toko->nama_toko.'/barang'.'/'.$data->gambar_barang);
                $delete_barang = Barang::where('id',$id)->delete();
                if($delete_barang){
                    return response()->json(['message'=>'Berhasil hapus','status' => true]);
                }else{
                    return response()->json(['error'=>'Gagal hapus','status' => false]);
                }
            }
        }else{
            return response()->json(['error'=>'Tidak ada data!','status' => false]);
        }
    }
}
