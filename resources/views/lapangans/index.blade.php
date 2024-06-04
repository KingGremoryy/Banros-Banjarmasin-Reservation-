@extends('layout.guest')

@section('content')
    <div class="container mx-auto px-5 py-6">
        <h1 class="text-4xl font-bold mb-6 text-center text-green-600">Lapangan - Banros</h1>
        <div class="grid lg:grid-cols-4 md:grid-cols-2 gap-6">
            @foreach ($lapangans as $lapangan)
                <div class="max-w-xs mx-auto bg-white rounded-lg shadow-md overflow-hidden transition-transform transform hover:scale-105">
                    <img class="w-full h-48 object-cover" src="{{ Storage::url($lapangan->image) }}" alt="Image" />
                    <div class="p-6">
                        <h4 class="mb-3 text-2xl font-semibold tracking-tight text-green-600 uppercase">
                            {{ $lapangan->lapangan }}
                        </h4>
                        <p class="leading-normal text-gray-700 mb-4">{{ $lapangan->detail }}</p>
                        <div class="flex items-center justify-between">
                            <span class="text-xl font-bold text-green-600">Rp.{{ $lapangan->harga }}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
