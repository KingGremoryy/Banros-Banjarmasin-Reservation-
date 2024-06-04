@extends('layout.main')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Booking</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Detail Booking</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      <div class="row">
          <div class="col-12">
            <a href="{{ route('admin.booking.create') }}" class="btn btn-primary mb-3">Tambah Data</a>
            <div class="card">
              <div class="card-header">

                <div class="card-tools">
                  <form action="{{ route('admin.booking.index') }}" method="GET">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="search" class="form-control float-right" placeholder="Search" value="{{ request()->get('search') }}">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default">
                        <i class="fas fa-search"></i>
                      </button>
                    </div>
                  </div>
                  </form>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama </th>
                      <th>Email</th>
                      <th>Tamu</th>
                      <th>Tanggal</th>
                      <th>Waktu</th>
                      <th>Arena</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($booking as $key => $bk)
                    <tr>
                      <td>{{ $booking->firstItem() + $key }}</td>
                      <td>{{ $bk->first_name }} {{ $bk->last_name }}</td>
                      <td>{{ $bk->email }}</td>
                      <td>{{ $bk->tamu }}</td>
                      <td>{{ \Carbon\Carbon::parse($bk->res_date)->format('d-m-Y') }}</td>
                      <td>{{ $bk->res_time }}</td>
                      <td>
                        @php
                        $arena = \App\Models\Arena::find($bk->arena_id);
                        $lapangan = $arena ? $arena->lapangan : 'Tidak Diketahui';
                        @endphp
                        {{ $lapangan }}
                      </td>
                      <td>
                        <a href="{{ route('admin.booking.edit', ['booking' => $bk->id]) }}" class="btn btn-primary"><i class="fas fa-pen"></i>Edit</a>
                        <a data-toggle="modal" data-target="#modal-hapus{{ $bk->id }}" class="btn btn-danger"><i class="fas fa-trash-alt"></i>Hapus</a>
                      </td>
                    </tr>
                    <div class="modal fade" id="modal-hapus{{ $bk->id }}">
                      <div class="modal-dialog">
                          <div class="modal-content">
                              <div class="modal-header">
                                  <h4 class="modal-title">Konfirmasi Hapus Data</h4>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                  </button>
                              </div>
                              <div class="modal-body">
                                  <p>Apakah kamu yakin ingin menghapus data <b>{{ $bk->first_name }} {{ $bk->last_name }}</b>?</p>
                              </div>
                              <div class="modal-footer">
                                  <form action="{{ route('admin.booking.delete', ['booking' => $bk->id]) }}" method="POST">
                                      @csrf
                                      @method('DELETE')
                                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                      <button type="submit" class="btn btn-primary">Ya, Hapus</button>
                                  </form>
                              </div>
                          </div>
                          <!-- /.modal-content -->
                      </div>
                      <!-- /.modal-dialog -->
                  </div>
                  
                      <!-- /.modal -->
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                  <!-- /.card-body -->
                </div>

                  <!-- Add Pagination here -->
                  <div class="d-flex justify-content-end mb-3 min-content-width">
                    <div class="mr-2">
                      showing
                      {{ $booking->firstItem() }}
                      to
                      {{ $booking->lastItem() }}
                    </div>
                      {{ $booking->links() }}
                  </div>

                <!-- /.card -->
              </div>
            </div>
            <!-- /.row (main row) -->
          </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
      </div>
    @endsection
