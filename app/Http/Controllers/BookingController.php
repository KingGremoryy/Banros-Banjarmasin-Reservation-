<?php

namespace App\Http\Controllers;

use App\Models\Arena;
use App\Models\Booking;
use App\Rules\DateBetween;
use App\Rules\TimeBetween;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Enums\ArenaStatus;

class BookingController extends Controller
{
    public function dashboard() {
        return view('dashboard');    
    }

    public function index(Request $request)
    {
        $booking = Booking::all();
        $booking = new Booking;

        if($request->get('search')) {
            $booking = $booking->where('tamu', 'LIKE', '%'.$request->get('search').'%');
        }

        // $booking = $booking->get();
        $booking = $booking->simplePaginate(3);

        return view('booking.index', compact('booking', 'request'));
    }

    public function create()
    {
        // Ambil semua arena yang statusnya 'Tersedia'
        $arena = Arena::where('status', ArenaStatus::Tersedia->value)->get();

        return view('booking.create', compact('arena'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telepon' => 'required|numeric',
            'res_date' => 'required|date',
            'res_time' => 'required',
            'tamu' => 'required|string',
            'arena_id' => 'required|exists:arena,id',
        ]);

        Booking::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'telepon' => $request->telepon,
            'res_date' => $request->res_date,
            'res_time' => $request->res_time,
            'tamu' => $request->tamu,
            'arena_id' => $request->arena_id,
        ]);

        return redirect()->route('admin.booking.index')->with('success', 'Booking berhasil ditambahkan');
    }

    public function edit(Request $request, $id){
        $booking = Booking::findOrFail($id);
        $arena = Arena::all();

        return view('booking.edit', compact('booking', 'arena'));
    }

    public function update(Request $request, $id){
        $validatedData = $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email',
            'telepon' => 'required|string',
            'res_date' => 'required|date',
            'res_time' => 'required',
            'tamu' => 'required|string', // Pastikan guest_number tidak boleh kosong
            'arena_id' => 'required|exists:arena,id', // Pastikan arena_id valid dan ada di tabel arena
        ]); 
            
     // Ambil objek Arena dari basis data berdasarkan ID
     $booking = Booking::findOrFail($id);
    
     // Perbarui atribut Arena berdasarkan data yang divalidasi
     $booking->first_name = $validatedData['first_name'];
     $booking->last_name = $validatedData['last_name'];
     $booking->email = $validatedData['email']; 
     $booking->telepon = $validatedData['telepon']; 
     $booking->res_date = $validatedData['res_date']; 
     $booking->res_time = $validatedData['res_time']; 
     $booking->tamu = $validatedData['tamu']; 
     $booking->arena_id = $validatedData['arena_id']; 
     
     // Simpan perubahan ke basis data
     $booking->save();
 
     // Redirect dengan pesan sukses jika berhasil
     return redirect()->route('admin.booking.index')->with('success', 'booking berhasil Diperbarui.');
    }

    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);

        $booking->delete();

        return redirect()->route('admin.booking.index')->with('success', 'Data booking berhasil dihapus.');
    }

}
