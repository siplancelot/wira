@extends('layouts.dashboard')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Tambah Product</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item">Product</li>
                    <li class="breadcrumb-item active">Tambah Product</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Form Tambah Produk</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form action="#">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <label>Nama Produk</label>
                                <input type="text" class="form-control" name="nama" id="nama" placeholder="Masukkan Nama Produk">
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <label>Kategori Produk</label>
                                <select name="kategori" id="kategori" class="form-control">
                                  <option value="0">--Pilih Kategori--</option>
                                  <option value="1">Kategori 1</option>
                                  <option value="2">Kategori 2</option>
                                </select>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <label>Harga Produk</label>
                                <input type="text" class="form-control" name="harga" id="harga" placeholder="Masukkan Harga Produk">
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <label>Gambar Produk</label>
                                <input type="file" class="form-control" name="file" id="file">
                              </div>
                            </div>
                            <div class="col-md-12">
                              <div class="form-group">
                                <label>Deskripsi Produk</label>
                                <textarea name="description" id="description" cols="30" rows="5" class="form-control" placeholder="Masukkan Deskripsi Produk"></textarea>
                              </div>
                            </div>
                          </div>
                          <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>
@endsection
