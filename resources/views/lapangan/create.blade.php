@extends('layout.main')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <i class="fas fa-arrow-alt-circle-left"></i>
            <a href="{{ route('admin.lapangan.index') }}" class="m-0 text-info">Kembali</a>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">Tambah Data</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
      <div class="container-fluid">
        <div class="row justify-content-center">
          <div class="col-md-12"> <!-- Mengubah lebar kolom menjadi 8 -->
            <div class="card">
              <!-- /.card-header -->
              <div class="card-body">
                <form action="{{ route('admin.lapangan.store') }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="form-group">
                    <label for="lapangan">Nama Lapangan</label>
                    <input type="text" class="form-control" id="lapangan" name="lapangan" placeholder="Masukkan Lapangan">
                    @error('lapangan')
                      <small class="text-danger">{{ $message }}</small>
                    @enderror    
                  </div>
                  <div class="form-group">
                    <label for="image">Foto</label>
                    <input type="file" class="form-control" id="image" name="image">
                    @error('image')
                      <small class="text-danger">{{ $message }}</small>
                    @enderror    
                  </div>
                  <div class="form-group">
                    <label for="detail">Detail</label>
                    <textarea name="detail" class="form-control" id="detail" placeholder="Masukkan Detail"></textarea>
                    @error('detail')
                      <small class="text-danger">{{ $message }}</small>
                    @enderror  
                  </div>
                  <div class="form-group">
                    <label for="harga">Harga</label>
                    <input type="number" name="harga" class="form-control" id="harga" placeholder="Masukkan Harga">
                    @error('harga')
                      <small class="text-danger">{{ $message }}</small>
                    @enderror  
                  </div>                  
                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </form>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
  </div>
@endsection
