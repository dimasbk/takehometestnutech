@extends('layout')

@section('title', 'Update produk')

@section('content')

<div class="container-fluid">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#" style="color: grey;">Daftar Produk</a></li>
            <li class="breadcrumb-item active" aria-current="page" style="color: black;">Update Produk</li>
        </ol>
    </nav>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    <form method="POST" action="/product/update" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{$product->id}}">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="kategori">Kategori</label>
                <select id="kategori" class="form-control" name="kategori">
                    <option value="">Pilih Kategori</option>
                    @foreach ($categories as $category)
                    <option value="{{$category->id}}">{{$category->kategori}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="namaBarang">Nama Barang</label>
                <input type="text" class="form-control" id="namaBarang" name="nama_produk"
                    value="{{$product->nama_produk}}">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="hargaBeli">Harga Beli</label>
                <input type="number" class="form-control" id="hargaBeli" name="hargaBeli"
                    value="{{$product->harga_beli}}" onchange="calculateHargaJual()">
            </div>
            <div class="form-group col-md-4">
                <label for="hargaJual">Harga Jual</label>
                <input type="number" class="form-control" id="hargaJual" name="hargaJual"
                    value="{{$product->harga_jual}}" readonly>
            </div>
            <div class="form-group col-md-4">
                <label for="stokBarang">Stok Barang</label>
                <input type="number" class="form-control" id="stokBarang" name="stokBarang" value="{{$product->stok}}">
            </div>
        </div>

        <div class="form-group">
            <label for="uploadImage">Upload Image</label>

            <div class="card text-center mx-auto" style="height: 200px; border: 2px dashed #ccc; cursor: pointer;"
                onclick="triggerFileInput()">
                <img id="image-preview" src="{{ asset('storage/images/'. $product->image_name) }}" class="card-img-top"
                    alt="Preview" style="height: 180px; object-fit: contain">
                <input type="file" id="file-input" name="uploadImage" class="d-none" accept="image/*"
                    onchange="previewImage()">
                <h4 id="upload-btn" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
                    Upload Foto
                    Produk</h4>
            </div>
        </div>


        <div class="form-row">
            <div class="col-md-6">
                <button type="button" class="btn btn-secondary">Batalkan</button>
            </div>
            <div class="col-md-6 text-right">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </form>
</div>
<script>
    function triggerFileInput() {
      document.getElementById('file-input').click();
    }
  
    function previewImage() {
      var input = document.getElementById('file-input');
      var preview = document.getElementById('image-preview');
      var uploadBtn = document.getElementById('upload-btn');
  
      var file = input.files[0];
  
      if (file) {
        var reader = new FileReader();
  
        reader.onload = function (e) {
          preview.src = e.target.result;
          preview.style.display = 'block';
          uploadBtn.style.display = 'none';
        };
  
        reader.readAsDataURL(file);
      }
    }
    function calculateHargaJual() {
        var hargaBeli = parseFloat(document.getElementById('hargaBeli').value);
        var hargaJual = hargaBeli + (0.3 * hargaBeli);
        document.getElementById('hargaJual').value = hargaJual.toFixed(2);
    }
</script>
@endsection