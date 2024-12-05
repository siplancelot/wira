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
  </div>
</section>
@endsection

@section('scripts')
<script>
  const ctx = document.getElementById('myChart').getContext('2d');
  const ctx2 = document.getElementById('myChart2').getContext('2d');

  const myChart = new Chart(ctx, {
    type: 'bar', // Bar chart
    data: {
      labels: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'], // X-axis labels
      datasets: [
        {
          label: 'Penjualan', // First set of bars
          data: [12, 19, 3, 5, 2, 3],
          backgroundColor: 'rgba(255, 99, 132, 0.2)', // Bars' fill color
          borderColor: 'rgba(255, 99, 132, 1)', // Bars' border color
          borderWidth: 1
        },
        {
          label: 'Lain-lain', // Second set of bars
          data: [8, 11, 7, 6, 8, 10],
          backgroundColor: 'rgba(54, 162, 235, 0.2)',
          borderColor: 'rgba(54, 162, 235, 1)',
          borderWidth: 1
        }
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


  const myChart2 = new Chart(ctx2, {
    type: 'pie', // Bar chart
    data: {
      labels: ['Makanan', 'Minuman', 'Lain-lain'], // X-axis labels
      datasets: [
        {
          label: 'Produk', // First set of bars
          data: [100, 40, 20],
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