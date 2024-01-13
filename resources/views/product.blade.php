@extends('layout')

@section('title', 'Daftar Produk')

@section('content')
<div class="container-fluid">
    <h2 class="mt-4 mb-4">Daftar Produk</h2>
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    <div class="row mb-3">
        <div class="col-md-5">
            <form action="/products/search" method="get">
                <div class="input-group">
                    <input type="text" class="form-control form-control-sm" name="parameter"
                        placeholder="Cari produk...">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary btn-sm" type="submit">Cari</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="col-md-3">
            <form action="/products/filter" id="filterForm">
                <select class="form-control form-control-sm" name="filterProduct" onchange="submitForm()">
                    <option value="">Pilih Kategori</option>
                    @foreach ($categories as $category)
                    <option value="{{$category->id}}">{{$category->kategori}}</option>
                    @endforeach
                </select>
            </form>
        </div>

        <div class="col-md-4 text-right">
            <form action="/products/export" method="get" class="d-inline">
                <input type="hidden" name="filter" value="{{$filter}}">
                <input type="hidden" name="search" value="{{$search}}">
                <button type="submit" class="btn btn-success btn-sm ml-2">
                    <img src="{{ asset('assets/MicrosoftExcelLogo.png') }}" alt="excel" class="mr-2" width="20"
                        height="20">Export Excel
                </button>
            </form>
            <a href="/product/create" class="btn btn-danger btn-sm ml-2">
                <img src="{{ asset('assets/PlusCircle.png') }}" alt="tambah" class="mr-2" width="20" height="20">Tambah
                Produk
            </a>
        </div>
    </div>

    <!-- Product Table -->
    <table class="table">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Image</th>
                <th scope="col">Nama Produk</th>
                <th scope="col">Kategori Produk</th>
                <th scope="col">Harga Beli</th>
                <th scope="col">Harga Jual</th>
                <th scope="col">Stok Produk</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
            <tr>
                <th scope="row">{{$product->id}}</th>
                <td><img src="{{asset('storage/images/'.$product->image_name)}}" alt="Product Image"
                        class="img-thumbnail" width="50"></td>
                <td>{{$product->nama_produk}}</td>
                <td>{{$product->category->kategori}}</td>
                <td>{{$product->harga_beli}}</td>
                <td>{{$product->harga_jual}}</td>
                <td>{{$product->stok}}</td>
                <td>
                    <!-- Action buttons, e.g., Edit and Delete -->
                    <a href="/product/edit/{{$product->id}}"><img src="{{ asset('assets/edit.png') }}" alt="edit"
                            class="mr-2" width="20" height="20"></a>
                    <a href="#" class="delete-btn" data-toggle="modal" data-target="#confirmationModal"
                        data-id="{{$product->id}}">
                        <img src="{{ asset('assets/delete.png') }}" alt="delete" class="mr-2" width="20" height="20">
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $products->links() }}
    <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this product?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <a href="#" id="deleteProduct" class="btn btn-danger">Delete</a>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function submitForm() {
            document.getElementById("filterForm").submit();
        }

    document.addEventListener('DOMContentLoaded', function () {
        // Handle delete button click
        document.querySelectorAll('.delete-btn').forEach(function (deleteBtn) {
            deleteBtn.addEventListener('click', function () {
                var productId = this.getAttribute('data-id');
                var deleteLink = document.getElementById('deleteProduct');
                deleteLink.href = '/product/delete/' + productId; // Replace with your actual delete route
            });
        });
    });
</script>

@endsection