<?php

namespace App\Http\Controllers;

use App\Models\Lapangan; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Termwind\Components\Dd;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use App\Enums\ArenaStatus;

class LapanganController extends Controller
{

    public function dashboard() {
        return view('dashboard');    
    }

    public function index(Request $request){

        $lapangan = Lapangan::all();
        $lapangan = new Lapangan;

        if($request->get('search')) {
            $lapangan = $lapangan->where('detail', 'LIKE', '%'.$request->get('search').'%');
        }

        // $lapangan = $lapangan->get();
        $lapangan = $lapangan->simplePaginate(3);

        return view('lapangan.index', compact('lapangan', 'request'));
    }

    public function create(){
        return view('lapangan.create');
    }

    public function store(Request $request)
    {   
        // Validasi input
        $validatedData = $request->validate([
            'lapangan' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Sesuaikan dengan kebutuhan Anda
            'detail' => 'required|string',
            'harga' => 'required|numeric'
        ]);
    
        // Mengambil file yang diunggah
        $image = $request->file('image');

        // Mendapatkan nama file asli dari input pengguna
        $originalName = $image->getClientOriginalName();

        // Membersihkan nama file dari karakter yang tidak diinginkan
        $cleanedName = preg_replace("/[^A-Za-z0-9\_\-\.]/", '_', $originalName);

        // Menyimpan gambar dengan nama asli yang telah dibersihkan
        // $imagePath = $image->storeAs('public/lapangan', $cleanedName);
        $imagePath = $request->file('image')->storeAs('lapangan', $cleanedName, 'public');
    
        Lapangan::create([
            'lapangan' => $validatedData['lapangan'],
            'image' => $imagePath,
            'detail' => $validatedData['detail'],
            'harga' => $validatedData['harga']
        ]);
    
        return redirect()->route('admin.lapangan.index');
    }      
    
    //dd($request->all());//

    public function edit(Request $request, $id) {
        $ld = Lapangan::findOrFail($id);
        return view('lapangan.edit', compact('ld'));
    }

    public function update(Request $request, $id){

        $lapangan = Lapangan::findOrFail($id);

        $request->validate([
            'lapangan' => 'required',
            'detail' => 'required',
            'harga' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $image = $lapangan->image;
        
        if ($request->hasFile('image')){
           
            // Dapatkan nama file asli yang diunggah oleh pengguna
            $uploadedImage = $request->file('image');
            $imageName = $uploadedImage->getClientOriginalName();
    
            // Simpan gambar dengan nama file asli
            $image = $uploadedImage->storeAs('public/lapangan', $imageName);
        }       
    
        $lapangan->update([
            'lapangan' => $request->lapangan,
            'image' => $image,
            'detail' => $request->detail,
            'harga' => $request->harga
        ]);
        
    
        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('admin.lapangan.index')->with('success', 'lapangan berhasil Diperbarui.');
    }
    
    
    public function destroy($id)
    {
        // Temukan data lapangan berdasarkan ID
        $lapangan = Lapangan::findOrFail($id);
        
        // Hapus data lapangan
        $lapangan->delete();
    
        // Redirect kembali dengan pesan sukses
        return redirect()->route('admin.lapangan.index')->with('success', 'Data lapangan berhasil dihapus.');
    }    

}
