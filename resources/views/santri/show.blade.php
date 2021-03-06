@extends('layout_cms.home')
@section('title_page','Tambah Data Santri')
@section('content')

    <div class="form-group">
        <a href="{{ route('santri.index') }}" class="btn btn-danger">Kembali</a>
    </div>
    <div class="form-group">
        <label for="name">Nama Santri</label>
        <input type="text" class="form-control"  name="name" value="{{ $santri->name }}" disabled>
    </div>
    <div class="form-group">
        <label for="address">Alamat Santri</label>
        <textarea class="form-control" name="address" readonly>{{ $santri->address }}</textarea>
    </div>
    <div class="form-group">
        <label for="birth_place">Tempat Lahir Santri</label>
        <input type="text" class="form-control" name="birth_place" value="{{ $santri->birth_place }}" disabled>
    </div>
    <div class="form-group">
        <label for="birth_date">Tanggal Lahir Santri</label>
        <input type="date" class="form-control" name="birth_date" value="{{ $santri->birth_date }}" disabled>
    </div>
    <div class="form-group">
        <label for="phone">No. HP Santri</label>
        <input type="tel" class="form-control" name="phone" value="{{ $santri->phone }}" disabled>
    </div>
    <div class="form-group">
        <label for="school_old">Asal Sekolah Santri</label>
        <input type="text" class="form-control" name="school_old" value="{{ $santri->school_old }}" disabled>
    </div>
    <div class="form-group">
        <label for="school_address_old">Alamat Asal Sekolah Santri</label>
        <textarea class="form-control" name="school_address_old" readonly>{{ $santri->school_address_old }}</textarea>
    </div>
    <div class="form-group">
        <label for="school_current">Sekolah Sekarang Santri</label>
        <input type="text" class="form-control" name="school_current" value="{{ $santri->school_current }}" disabled>
    </div>
    <div class="form-group">
        <label for="school_address_current">Alamat Sekolah Sekarang Santri</label>
        <textarea class="form-control" name="school_address_current" readonly>{{ $santri->school_address_current }}</textarea>
    </div>
    <div class="form-group">
        <label for="father_name">Nama Ayah Santri</label>
        <input type="text" class="form-control" name="father_name" value="{{ $santri->father_name }}" disabled>
    </div>
    <div class="form-group">
        <label for="mother_name">Nama Ibu Santri</label>
        <input type="text" class="form-control" name="mother_name" value="{{ $santri->mother_name }}" disabled>
    </div>
    <div class="form-group">
        <label for="father_job">Pekerjaan Ayah Santri</label>
        <input type="text" class="form-control" name="father_job" value="{{ $santri->father_job }}" disabled>
    </div>
    <div class="form-group">
        <label for="mother_job">Pekerjaan Ibu Santri</label>
        <input type="text" class="form-control" name="mother_job" value="{{ $santri->mother_job }}" disabled>
    </div>
    <div class="form-group">
        <label for="parent_phone">No. HP Orang Tua Santri</label>
        <input type="tel" class="form-control" name="parent_phone" value="{{ $santri->parent_phone }}" disabled>
    </div>
    <div class="form-group">
        <label for="entry_year">Tahun Masuk</label>
        <input type="text" class="form-control" name="entry_year" value="{{ $santri->entry_year }}" disabled>
    </div>
    <div class="form-group">
        <label for="year_out">Tahun Keluar</label>
        <input type="text" class="form-control" name="year_out" value="{{ $santri->year_out }}" disabled>
    </div>

@endsection
