@extends('layouts.dashboard')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Laporan Pemasukan</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item">Laporan</li>
                    <li class="breadcrumb-item active">Pemasukan</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Filter Waktu</h3>
              </div>
              <div class="card-body">
                <select name="filter-date" class="form-control">
                  <option value="">Hari Ini</option>
                  <option value="">Kemarin</option>
                  <option value="">7 Hari Terakhir</option>
                  <option value="">30 Hari Terakhir</option>
                </select>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>150</h3>
    
                <p>Pesanan</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>300</h3>
                <p>Stok Terjual</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
            </div>
          </div>
          
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>Rp 200.000,00</h3>
                <p>Pemasukan</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>Rp 150.000,00</h3>
    
                <p>Keuntungan</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Pemasukan Selama 7 Hari Terakhir</h3>
                    </div>
                    <div class="card-body">
                        <canvas id="myChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Jumlah Produk yang Terjual Berdasarkan Kategori</h3>
                    </div>
                    <div class="card-body">
                        <canvas id="myChart2"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Riwayat Penjualan Produk</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="myTable table table-bordered table-hover">
                            <thead class="text-center">
                                <tr>
                                    <th style="width: 5%">No</th>
                                    <th>Tanggal</th>
                                    <th>Total Pesanan</th>
                                    <th>Jumlah</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                               
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <div class="col-lg-6">
              <div class="card">
                  <div class="card-header">
                      <h3 class="card-title">Riwayat Pemasukan Lain-lain</h3>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                      <table class="myTable table table-bordered table-hover">
                          <thead class="text-center">
                              <tr>
                                  <th style="width: 5%">No</th>
                                  <th>Tanggal</th>
                                  <th>Tipe Pemasukan</th>
                                  <th>Jumlah</th>
                                  <th>Action</th>
                              </tr>
                          </thead>
                          <tbody>
                             
                          </tbody>
                      </table>
                  </div>
                  <!-- /.card-body -->
              </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Pemasukan Per Produk</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table class="myTable table table-bordered table-hover">
                        <thead class="text-center">
                            <tr>
                                <th style="width: 5%">No</th>
                                <th>Tanggal</th>
                                <th>Nama Produk</th>
                                <th>Jumlah</th>
                                <th>Pemasukan</th>
                                <th>Total Modal</th>
                                <th>Keuntungan</th>
                            </tr>
                        </thead>
                        <tbody>
                           
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
      </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
  const ctx = document.getElementById('myChart').getContext('2d');
  const ctx2 = document.getElementById('myChart2').getContext('2d');

  const categories = @json($totalDataPie->pluck('category_name'));
  const productCounts = @json($totalDataPie->pluck('total_products'));
  const totalDataBar = @json($totalDataBar);

  // Prepare the labels (dates)
  const labels = totalDataBar.labels;

  // Prepare the datasets (each category's data)
  const datasets = totalDataBar.datasets.map((dataset) => ({
      label: dataset.label,
      data: dataset.data,
      backgroundColor: dataset.backgroundColor,
      borderColor: dataset.borderColor,
      borderWidth: 1
  }));

  const myChart = new Chart(ctx, {
    type: 'bar', // Bar chart
    data: {
      labels: labels,
      datasets: datasets
    },
    options: {
      responsive: true,
      plugins: {
        legend: {
          position: 'top' // Place legend above the chart
        }
      },
      scales: {
        y: {
          beginAtZero: true // Ensure y-axis starts at 0
        }
      }
    }
  });


  const myChart2 = new Chart(ctx2, {
    type: 'pie', // Bar chart
    data: {
      labels: categories, // X-axis labels
      datasets: [
        {
          label: 'Produk', // First set of bars
          data: productCounts,
          backgroundColor: [
          'rgba(255, 99, 132, 0.8)',  // Colors for the slices
          'rgba(54, 162, 235, 0.8)',
          'rgba(255, 206, 86, 0.8)'
          
        ],
        borderColor: [
          'rgba(255, 255, 255, 1)', // Border color for the slices
          'rgba(255, 255, 255, 1)',
          'rgba(255, 255, 255, 1)'
        ],
          borderWidth: 1
        },
        
      ]
    },
    options: {
      responsive: true,
      plugins: {
        legend: {
          position: 'top' // Place legend above the chart
        }
      },
      scales: {
        y: {
          beginAtZero: true // Ensure y-axis starts at 0
        }
      }
    }
  });
   

</script>

@endsection
