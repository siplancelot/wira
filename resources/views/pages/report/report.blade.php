@extends('layouts.dashboard')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Laporan</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Laporan</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-4">
                <a href="{{route('reportincome')}}">
                    <div class="card">
                        <div class="card-body">
                            <div style="display: flex; align-items: center;">
                                <i class="fas fa-file" style="font-size: 20px; margin-right: 20px;"></i>
                                <h4 style="margin: 0px;">Laporan Pemasukan</h4>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-4">
                <a href="{{ route('reportoutcome') }}">
                    <div class="card">
                        <div class="card-body">
                            <div style="display: flex; align-items: center;">
                                <i class="fas fa-file" style="font-size: 20px; margin-right: 20px;"></i>
                                <h4 style="margin: 0px;">Laporan Pengeluaran</h4>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-4">
                <a href="#">
                    <div class="card">
                        <div class="card-body">
                            <div style="display: flex; align-items: center;">
                                <i class="fas fa-file" style="font-size: 20px; margin-right: 20px;"></i>
                                <h4 style="margin: 0px;">Laporan Penjualan</h4>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-4">
                <a href="#">
                    <div class="card">
                        <div class="card-body">
                            <div style="display: flex; align-items: center;">
                                <i class="fas fa-file" style="font-size: 20px; margin-right: 20px;"></i>
                                <h4 style="margin: 0px;">Laporan Pembelian</h4>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
           

            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>
@endsection
