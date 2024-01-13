@extends('layout')

@section('title', 'Daftar Produk')

@section('content')
<div class="container mt-5">
    <div>
        <div class="position-relative d-inline-block">
            <img src="{{ asset('assets/dimas.png') }}" alt="Profile Image" class="rounded-circle"
                style="width: 150px; height: 150px; object-fit: cover;">
            <img src="{{ asset('assets/edit.png') }}" alt="Edit" class="edit-icon"
                style="position: absolute; bottom: 5px; right: 5px; width: 30px; height: 30px;">
        </div>
    </div>

    <div class="mt-3">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="namaKandidat">Nama Kandidat</label>
                <input type="text" value="Dimas Bagus Kurniawan" class="form-control" id="namaKandidat"
                    placeholder="Enter your name">
            </div>
            <div class="form-group col-md-6">
                <label for="posisiKandidat">Posisi Kandidat</label>
                <input type="text" value="Web Programmer" class="form-control" id="posisiKandidat"
                    placeholder="Enter your position">
            </div>
        </div>
    </div>
</div>

@endsection