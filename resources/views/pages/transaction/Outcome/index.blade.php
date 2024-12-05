@extends('layouts.dashboard')

@section('content')
<div class="content-header">
  <div class="container-fluid">
      <div class="row mb-2">
          <div class="col-sm-6">
              <h1 class="m-0">Daftar Pengeluaran</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                  <li class="breadcrumb-item active">Pengeluaran</li>
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
                      <h3 class="card-title">Data Pengeluaran</h3>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                      <a href="" class="btn btn-primary">
                          Tambah Data
                      </a>
                      <table class="myTable table table-bordered table-hover">
                          <thead class="text-center">
                              <tr>
                                  <th style="width: 5%">No</th>
                                  <th>Tipe Pemasukan</th>
                                  <th>Jumlah</th>
                                  <th>Action</th>
                              </tr>
                          </thead>
                          <tbody>
                              <tr>
                                  <td>1</td>
                                  <td>Pembelian Produk</td>
                                  <td>Rp 20.000,00</td>
                                  <td>
                                    <a href="#" class="btn btn-primary">
                                      <i class="fas fa-eye"></i>
                                    </a>
                                  </td>
                              </tr>
                          </tbody>
                      </table>
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