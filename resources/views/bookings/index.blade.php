@extends('layout.guest')

@section('content')

@php
    \Carbon\Carbon::setLocale('id');
@endphp

<div class="container mx-auto px-2 py-4">
    <h1 class="text-2xl font-bold mb-4 text-center text-blue-500">Jadwal - Futsal</h1>
    <div class="overflow-x-auto">
        <div class="table-responsive">
            <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-md">
                <thead class="bg-blue-600 text-white text-xs sm:text-sm">
                    <tr>
                        <th class="py-2 px-2 sm:px-4 text-center border-r border-gray-200">Jam</th>
                        <th class="py-2 px-2 sm:px-4 text-center border-r border-gray-200">Tim</th>
                        <th class="py-2 px-2 sm:px-4 text-center border-r border-gray-200">Status</th>
                        <th class="py-2 px-2 sm:px-4 text-center border-r border-gray-200">Keterangan</th>
                        <th class="py-2 px-2 sm:px-4 text-center">Hubungi</th>
                    </tr>
                </thead>
                <tbody class="text-xs text-center sm:text-sm">
                    @foreach ($booking as $jadwal)
                        @if ($jadwal->arena)
                            <tr class="border-b border-gray-300 hover:bg-gray-100 transition duration-300 ease-in-out">
                                <td class="py-3 px-2 sm:px-4 text-gray-700 font-bold whitespace-nowrap">{{ \Carbon\Carbon::parse($jadwal->res_time)->isoFormat('HH:mm') }}</td>
                                <td class="py-3 px-2 sm:px-4 text-gray-700 font-bold whitespace-nowrap">{{ $jadwal->tamu }}</td>
                                <td class="py-3 px-2 sm:px-4">
                                    <span class="{{ $jadwal->arena->arenaStatus === 'Booked' ? 'text-red-500' : ($jadwal->arena->arenaStatus === 'Tersedia' ? 'text-green-500' : 'text-gray-500') }}">
                                        {{ $jadwal->arena->arenaStatus }}
                                    </span>
                                </td>
                                <td class="py-3 px-2 sm:px-4 text-gray-700 font-bold border-r border-gray-200 whitespace-nowrap">{{ $jadwal->arena->lapangan }}</td>
                                <td class="py-3 px-2 sm:px-4">
                                    <a href="https://wa.me/6282149016340" target="_blank" class="bg-green-500 hover:bg-green-600 text-white font-bold py-1 px-2 rounded-full shadow-md transition duration-300 ease-in-out transform hover:scale-105 no-underline hover:no-underline">
                                        <i class="fab fa-whatsapp w-4 h-4 inline-block mr-1"></i>
                                        Hubungi
                                    </a>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
