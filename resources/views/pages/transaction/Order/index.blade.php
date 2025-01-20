@extends('layouts.dashboard')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Daftar Pemesanan</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Pemesanan</li>
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
                <form action="{{ route('orderDate') }}" method="get">
                  <select name="range" class="form-control" onchange="handleFilterChange(this)">
                    <option value="" >Pilih filter waktu</option>
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
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data Pemesanan</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        {{-- <a href="{{ route('admin.product.create') }}" class="btn btn-primary">
                        Tambah Data
                        </a> --}}
                        <table class="myTable table table-bordered table-hover">
                            <thead class="text-center">
                                <tr>
                                    <th style="width: 5%">No</th>
                                    <th>Title</th>
                                    <th>Atas Nama</th>
                                    <th>Total Produk</th>
                                    <th>Total Harga</th>
                                    <th>Tanggal</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orderhd as $item)
                                <tr class="order-detail">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->title }}</td>
                                    <td class="name-order">{{ $item->name }}</td>
                                    <td>{{ $item->total_product }}</td>
                                    <td>{{ $item->total_price }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->created_at)->format('M d, Y') }}</td>
                                    <td>
                                        <div class="btn btn-primary btn-order-detail" data-toggle="modal"
                                            data-target="#modalDetailOrder" id="{{$item->id}}">
                                            <i class="fas fa-eye"></i>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
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

<div class="modal fade" id="modalDetailOrder" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title fs-5" id="exampleModalLabel">Detail Order</h3>
            </div>
            <div class="modal-body">
                <label for="" class="title">Daftar Pesanan</label>
                <div class="item-checkout-list">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnModalClose" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script type="text/template" id="tmpItemCheckout">
    <div class="item-checkout mb-2">
    <div style="width: 100%; display: flex; justify-content: space-between; ">
        <input type="hidden" class="hdnProductID" value="" />
        <p class="title"> </p>
        <p class="price"></p>
    </div>
    <input type="hidden" class="hdnPriceItem" value="" />
    <p class="total"></p>
    <p class="note"></p>
  </div>
</script>

@endsection

@section('scripts')
<script>
    function handleFilterChange(select) {
        const selectedValue = select.value;

        if (selectedValue === "") {
            // Redirect to a specific page when "Pilih filter waktu" is selected
            window.location.href = "{{ route('orderview') }}"; // Replace 'specificPage' with the route name
        } else {
            // Submit the form for other options
            select.form.submit();
        }
    }

    $(document).ready(function () {
        $(".btn-order-detail").click(function () {
            $(".item-checkout-list").empty(); // Clear the container
            var id = $(this).attr("id"); // Get the ID of the clicked button

            $.ajax({
                url: "{{route('orderdetail')}}", // Replace with your actual route
                type: "GET",
                data: {
                    'query': id // Pass the ID as the query parameter
                },
                success: function (data) {// Extract products from the response

                    $.each(data, function (index, value) {
                        // Clone the template content
                        var divItem = $($('#tmpItemCheckout').html());

                        // Populate the cloned content with product data
                        divItem.find(".hdnProductID").val(value
                            .product.id); // For hidden input fields
                        divItem.find(".title").text(value
                            .product.product_name); // Set product name
                        divItem.find(".price").text(value.price); // Set price
                        divItem.find(".total").text("x" + value.total); // Set total

                        // Append the populated template to the list
                        $(".item-checkout-list").append(divItem);

                    });
                },
                error: function (error) {
                    console.error("Error fetching data:", error);
                    alert("Failed to load order details. Please try again.");
                }
            });
        });

    });

</script>
@endsection
