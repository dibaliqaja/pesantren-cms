@extends('layout-cms.home')
@section('title_page','Tambah Data Santri')
@section('content')

    <div class="form-group">
        <a href="{{ route('santri.index') }}" class="btn btn-danger">Kembali</a>
    </div>
    <div class="form-group">
        <label for="santri_number">No. Induk Santri</label>
        <input type="text" class="form-control" name="santri_number" value="{{ $santri->santri_number }}" disabled>
    </div>
    <div class="form-group">
        <label for="santri_name">Nama Santri</label>
        <input type="text" class="form-control"  name="santri_name" value="{{ $santri->santri_name }}" disabled>
    </div>
    <div class="form-group">
        <label for="santri_address">Alamat Santri</label>
        <textarea class="form-control" name="santri_address" readonly>{{ $santri->santri_address }}</textarea>
    </div>
    <div class="form-group">
        <label for="santri_birth_place">Tempat Lahir Santri</label>
        <input type="text" class="form-control" name="santri_birth_place" value="{{ $santri->santri_birth_place }}" disabled>
    </div>
    <div class="form-group">
        <label for="santri_birth_date">Tanggal Lahir Santri</label>
        <input type="date" class="form-control" name="santri_birth_date" value="{{ $santri->santri_birth_date }}" disabled>
    </div>
    <div class="form-group">
        <label for="santri_phone">No. HP Santri</label>
        <input type="tel" class="form-control" name="santri_phone" value="{{ $santri->santri_phone }}" disabled>
    </div>
    <div class="form-group">
        <label for="santri_school_old">Asal Sekolah Santri</label>
        <input type="text" class="form-control" name="santri_school_old" value="{{ $santri->santri_school_old }}" disabled>
    </div>
    <div class="form-group">
        <label for="santri_school_address_old">Alamat Asal Sekolah Santri</label>
        <textarea class="form-control" name="santri_school_address_old" readonly>{{ $santri->santri_school_address_old }}</textarea>
    </div>
    <div class="form-group">
        <label for="santri_school_current">Sekolah Sekarang Santri</label>
        <input type="text" class="form-control" name="santri_school_current" value="{{ $santri->santri_school_current }}" disabled>
    </div>
    <div class="form-group">
        <label for="santri_school_address_current">Alamat Sekolah Sekarang Santri</label>
        <textarea class="form-control" name="santri_school_address_current" readonly>{{ $santri->santri_school_address_current }}</textarea>
    </div>
    <div class="form-group">
        <label for="santri_father_name">Nama Ayah Santri</label>
        <input type="text" class="form-control" name="santri_father_name" value="{{ $santri->santri_father_name }}" disabled>
    </div>
    <div class="form-group">
        <label for="santri_mother_name">Nama Ibu Santri</label>
        <input type="text" class="form-control" name="santri_mother_name" value="{{ $santri->santri_mother_name }}" disabled>
    </div>
    <div class="form-group">
        <label for="santri_father_job">Pekerjaan Ayah Santri</label>
        <input type="text" class="form-control" name="santri_father_job" value="{{ $santri->santri_father_job }}" disabled>
    </div>
    <div class="form-group">
        <label for="santri_mother_job">Pekerjaan Ibu Santri</label>
        <input type="text" class="form-control" name="santri_mother_job" value="{{ $santri->santri_mother_job }}" disabled>
    </div>
    <div class="form-group">
        <label for="santri_parent_phone">No. HP Orang Tua Santri</label>
        <input type="tel" class="form-control" name="santri_parent_phone" value="{{ $santri->santri_parent_phone }}" disabled>
    </div>

@endsection
