@extends('layout.main')
  @section('content')
  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Lapangan</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Detail Lapangan</li>
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
              <a href="{{ route('admin.lapangan.create') }}" class="btn btn-primary mb-3">Tambah Data</a>
              
              <div class="card">
                <div class="card-header">

                  <div class="card-tools">
                    <form action="{{ route('admin.lapangan.index') }}" method="GET">
                    <div class="input-group input-group-sm" style="width: 150px;">
                      <input type="text" name="search" class="form-control float-right" placeholder="Search" value="{{ $request->get('search') }}">
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
                        <th>Nama Lapangan</th>
                        <th>Foto</th>
                        <th>Detail</th>
                        <th>Harga</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($lapangan as $key => $ld)
                      <tr>
                        <td>{{ $lapangan->firstItem() + $key }}</td>
                        <td>{{ $ld->lapangan }}</td>
                        <td><img src="{{ Storage::url($ld->image) }}" style="max-width: 70px; max-height: 100px;"></td>
                        <td>{{ $ld->detail }}</td>
                        <td>{{ $ld->harga }}</td>
                        <td>  
                          <a href="{{ route('admin.lapangan.edit', ['lapangan' => $ld->id]) }}" class="btn btn-primary"><i class="fas fa-pen"></i>Edit</a>
                          <a data-toggle="modal" data-target="#modal-hapus{{ $ld->id }}" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Hapus</a>
                        </td>
                    </tr>
                    
                    <!-- Modal Hapus -->
                    <div class="modal fade" id="modal-hapus{{ $ld->id }}">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Konfirmasi Hapus Data</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>Apakah kamu yakin ingin menghapus data <b>{{ $ld->lapangan }}</b>?</p>
                                </div>
                                <div class="modal-footer">
                                  <form action="{{ route('admin.lapangan.delete', ['lapangan' => $ld->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-primary">Ya, Hapus</button>
                                    </form>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
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
             
              <div class="d-flex justify-content-end mb-3 min-content-width">
                <div class="mr-2">
                  showing
                  {{ $lapangan->firstItem() }}
                  to
                  {{ $lapangan->lastItem() }}
                </div>
                  {{ $lapangan->links() }}
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