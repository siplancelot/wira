@extends('layouts.dashboard')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Stok</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Stok</li>
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
                        <h3 class="card-title">Daftar Stok Produk</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body" id="dataStock1">
                        <div class="btn btn-success" id="btnUpdateStock">
                            Update Stok
                        </div>
                        <table class="myTable table table-bordered table-hover">
                            <thead class="text-center">
                                <tr>
                                    <th style="width: 5%">No</th>
                                    <th>Nama</th>
                                    <th style="width: 10%;">Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($stocks as $stock)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <input type="hidden" class="hdnProductID" value="{{$stock->product_id}}">
                                        {{ $stock->product->product_name }}
                                    </td>
                                    <td>{{ $stock->stock }}</td>

                                </tr>
                                @endforeach

                            </tbody>

                        </table>
                    </div>


                    <div class="card-body" id="dataStock2" style="display: none">
                        <div class="btn btn-primary mb-2" id="btnSaveStock">
                            Simpan Stok
                        </div>
                        <table class="table table-bordered table-hover">
                            <thead class="text-center">
                                <tr>
                                    <th style="width: 5%">No</th>
                                    <th style="width: 40%">Nama</th>
                                    <th style="width: 10%">Stok Saat Ini</th>
                                    <th style="width: 10%">Stok Penambahan</th>
                                    <th style="width: 10%">Total Stock</th>
                                    <th>Biaya</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($stocks as $item)
                                <tr class="product-item">
                                    <td>
                                        <input type="hidden" class="hdnStockId" value="{{$item->id}}">
                                        {{ $loop->iteration }}</td>
                                    <td class="name">
                                        <input type="hidden" class="hdnProductId" value="{{$item->product_id}}">
                                        {{ $item->product->product_name }}
                                    </td>
                                    <td class="stock-product">{{ $item->stock }}</td>
                                    <td>
                                        <input type="number" class="form-control txtStock" value="">
                                    </td>
                                    <td class="total-stock">
                                        {{ $item->stock }}
                                    </td>
                                    <td>
                                        <input type="hidden" id="hdnPriceBuy" value="{{ $item->product->buy_price}}">
                                        <p class="cost-product">-</p>
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
@endsection

@section('scripts')
<script>
    $(document).ready(function () {
        $("#btnUpdateStock").click(function () {
            $("#dataStock1").hide();
            $("#dataStock2").fadeIn();
            $(".txtStock").val("");
        });

        $("#btnSaveStock").click(function () {

            var totalStockBuy = 0;
            var totalPriceBuy = 0;

            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            $(".product-item").each(function () {
                var stockInput = $(this).find(".txtStock").val();
                var stockPrice = $(this).find(".cost-product").html();

                if (stockInput != "") {
                    totalStockBuy += parseInt(stockInput);
                }

                if (stockPrice != "-") {
                    totalPriceBuy += parseInt(stockPrice);
                }

            });


            $.ajax({
                url: "{{ route('transactionHD') }}", // Pastikan URL ini benar
                type: "POST",
                data: {
                    '_token': csrfToken,
                    'title': "Pembelian Stok Produk",
                    'total': totalStockBuy,
                    'price': totalPriceBuy
                },
                success: function (data) {
                    var stockBuyHDID = data.id;

                    alert(stockBuyHDID);

                    $.ajax({
                        url: "{{route('outcome')}}",
                        type: "POST",
                        data: {
                            '_token': csrfToken,
                            'outcome_category_id': 1,
                            'total': totalPriceBuy,
                            'description': "--",
                            'no_reference': stockBuyHDID
                        },
                        success: function (data) {
                            console.log('success');
                        },
                        error: function (data) {
                            console.log("gagal");
                        }
                    })


                    $(".product-item").each(function () {
                        var productID = $(this).find(".hdnProductId").val();
                        var totalProductBuy = $(this).find(".txtStock").val();
                        var totalProductPrice = $(this).find(".cost-product")
                            .html();

                        if (totalProductBuy != "" && totalProductPrice != "-") {
                            $.ajax({
                                url: "{{route('transactionDT')}}",
                                type: "POST",
                                data: {
                                    '_token': csrfToken,
                                    'transaction_stock_hd_id': stockBuyHDID,
                                    'product_id': productID,
                                    'total': totalProductBuy,
                                    'price': totalProductPrice,
                                },
                                success: function (data) {
                                    console.log("sukses masuk ke db stock dt");
                                },
                                error: function (data) {
                                    console.log("gagal masuk ke db stock dt");
                                }
                            });
                        }
                    });
                },
                error: function (xhr, status, error) {
                    console.log("Error:", status, error); // Debug jika gagal
                }
            });

            $(".product-item").each(function () {
                var totalStock = $(this).find(".total-stock").html();
                var productID = $(this).find(".hdnProductId").val();
                var stockID = $(this).find(".hdnStockId").val();

                var stockInput = $(this).find(".txtStock").val();

                if (stockInput != "") {

                    $.ajax({
                        url: "{{route('admin.stock.update', ':id')}}".replace(':id',
                            stockID),
                        type: "PATCH",
                        data: {
                            '_token': csrfToken,
                            'product_id': productID,
                            'stock': totalStock,
                        },
                        success: function (data) {

                            console.log("sukses");
                        },
                        error: function (data) {
                            console.log("gagal");
                        }
                    });


                }
            });
            alert("Berhasil di update");
            location.reload();
        });



        $(".txtStock").on("keyup", function () {

            var divProduct = $(this).closest(".product-item");

            var data = $(this).val();

            if (data == "") {

                var dataStockNow = divProduct.find(".stock-product").html();

                divProduct.find('.total-stock').html(parseInt(dataStockNow));

                divProduct.find('.cost-product').html("-");
            } else {

                var dataStockNow = divProduct.find(".stock-product").html();

                var totalStock = parseInt(data) + parseInt(dataStockNow);

                divProduct.find('.total-stock').html(totalStock);

                var priceProduct = divProduct.find("#hdnPriceBuy").val();

                var costBuy = parseInt(data) * parseInt(priceProduct);

                divProduct.find('.cost-product').html(costBuy);
            }


        });

    });

</script>
@endsection
