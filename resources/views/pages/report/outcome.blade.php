@extends('layouts.dashboard')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Laporan Pengeluaran</h1>
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
                <form action="{{ route('reportincome') }}" method="get">
                  <select name="range" class="form-control" onchange="this.form.submit()">
                    <option value="">Pilih filter waktu</option>
                    <option value="today" {{ request('range') == 'today' ? 'selected' : '' }}>Hari Ini</option>
                    <option value="yesterday" {{ request('range') == 'yesterday' ? 'selected' : '' }}>Kemarin</option>
                    <option value="7days" {{ request('range') == '7days' ? 'selected' : '' }}>7 Hari Terakhir</option>
                    <option value="30days" {{ request('range') == '30days' ? 'selected' : '' }}>30 Hari Terakhir</option>
                  </select>
                </form>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{ $totalOrder }}</h3>
    
                <p>Pembelian Stok</p>
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
                <h3>{{ $totalSales }}</h3>
                <p>Stok Terbeli</p>
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
                <h3>Rp {{ number_format($totalIncomes, 2, '.', ',') }}</h3>
                <p>Pengeluaran</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          {{-- <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                @if ($totalProfit > 0)
                    <h3>Rp {{ number_format($totalProfit, 2, '.', ',') }}</h3>
                @else
                    <h3>Rp 0</h3>
                @endif
    
                <p>Keuntungan</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
            </div>
          </div> --}}
          <!-- ./col -->
        </div>
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Pengeluaran Selama 7 Hari Terakhir</h3>
                    </div>
                    <div class="card-body">
                        <canvas id="myChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Jumlah Produk yang Terbeli Berdasarkan Kategori</h3>
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
                        <h3 class="card-title">Riwayat Pembelian Stok Produk</h3>
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
                              @foreach ($incomeHistories as $item)
                                <tr>
                                  <td>{{ $loop->iteration }}</td>
                                  <td>{{ \Carbon\Carbon::parse($item->created_at)->format('M d, Y') }}</td>
                                  <td>{{ $item->total_product }}</td>
                                  <td>Rp. {{ number_format($item->total_price, 2, '.', ',') }}</td>
                                  <td>
                                    <a href="#" class="btn btn-primary">Detail</a>
                                  </td>
                                </tr>
                              @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <div class="col-lg-6">
              <div class="card">
                  <div class="card-header">
                      <h3 class="card-title">Riwayat Pengeluaran Lain-lain</h3>
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
                              @foreach ($otherIncomes as $item)
                                <tr>
                                  <td>{{ $loop->iteration }}</td>
                                  <td>{{ \Carbon\Carbon::parse($item->created_at)->format('M d, Y') }}</td>
                                  <td>{{ $item->name }}</td>
                                  <td>Rp. {{ number_format($item->total, 2, '.', ',') }}</td>
                                  <td>
                                    <a href="#" class="btn btn-primary">Detail</a>
                                  </td>
                                </tr>
                              @endforeach
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
                    <h3 class="card-title">Pengeluran  Per Produk</h3>
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
                                <th>Pengeluaran</th>
                            </tr>
                        </thead>
                        <tbody>
                           @foreach ($revenueByProducts as $item)
                              <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->created_at)->format('M d, Y') }}</td>
                                <td>{{ $item->product_name }}</td>
                                <td>{{ $item->total }}</td>
                                <td>Rp. {{ number_format($item->revenue, 2, '.', ',') }}</td>
                              </tr>
                            @endforeach
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
