@extends('layouts.dashboard')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Tambah Produk</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item">Product</li>
                    <li class="breadcrumb-item active">Add Product</li>
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
                        <form action="{{ route('income') }}" method="POST">
                          @csrf
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="income_category_id">Kategori Pemasukan</label>
                                <select name="income_category_id" id="income_category_id" class="form-control">
                                  <option value="0">Pilih Kategori</option>
                                  @foreach ($incomeCategories as $category)
                                      <option value="{{ $category->id }}">{{ $category->name }}</option>
                                  @endforeach
                                </select>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="total">Total Pemasukan</label>
                                <input type="text" class="form-control" name="total" id="total" placeholder="Masukkan Total">
                              </div>
                            </div>
                            <div class="col-md-12">
                              <div class="form-group">
                                <label>Deskripsi</label>
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
