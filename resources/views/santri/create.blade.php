@extends('layout_cms.home')
@section('title_page','Tambah Data Santri')
@section('content')

    <form action="{{ route('santri.store') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="name">Nama Santri</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}">

            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="address">Alamat Santri</label>
            <textarea class="form-control @error('address') is-invalid @enderror" name="address">{{ old('address') }}</textarea>

            @error('address')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="birth_place">Tempat Lahir Santri</label>
            <input type="text" class="form-control @error('birth_place') is-invalid @enderror" name="birth_place" value="{{ old('birth_place') }}">

            @error('birth_place')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="birth_date">Tanggal Lahir Santri</label>
            <input type="date" class="form-control @error('birth_date') is-invalid @enderror" name="birth_date" value="{{ old('birth_date') }}">

            @error('birth_date')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="phone">No. HP Santri</label>
            <input type="tel" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}">

            @error('phone')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="school_old">Asal Sekolah Santri</label>
            <input type="text" class="form-control @error('school_old') is-invalid @enderror" name="school_old" value="{{ old('school_old') }}">

            @error('school_old')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="school_address_old">Alamat Asal Sekolah Santri</label>
            <textarea class="form-control @error('school_address_old') is-invalid @enderror" name="school_address_old">{{ old('school_address_old') }}</textarea>

            @error('school_address_old')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="school_current">Sekolah Sekarang Santri</label>
            <input type="text" class="form-control @error('school_current') is-invalid @enderror" name="school_current" value="{{ old('school_current') }}">

            @error('school_current')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="school_address_current">Alamat Sekolah Sekarang Santri</label>
            <textarea class="form-control @error('school_address_current') is-invalid @enderror" name="school_address_current">{{ old('school_address_current') }}</textarea>

            @error('school_address_current')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="father_name">Nama Ayah Santri</label>
            <input type="text" class="form-control @error('father_name') is-invalid @enderror" name="father_name" value="{{ old('father_name') }}">

            @error('father_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="mother_name">Nama Ibu Santri</label>
            <input type="text" class="form-control @error('mother_name') is-invalid @enderror" name="mother_name" value="{{ old('mother_name') }}">

            @error('mother_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="father_job">Pekerjaan Ayah Santri</label>
            <input type="text" class="form-control @error('father_job') is-invalid @enderror" name="father_job" value="{{ old('father_job') }}">

            @error('father_job')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="mother_job">Pekerjaan Ibu Santri</label>
            <input type="text" class="form-control @error('mother_job') is-invalid @enderror" name="mother_job" value="{{ old('mother_job') }}">

            @error('mother_job')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="parent_phone">No. HP Orang Tua Santri</label>
            <input type="tel" class="form-control @error('parent_phone') is-invalid @enderror" name="parent_phone" value="{{ old('parent_phone') }}">

            @error('parent_phone')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <button class="btn btn-primary">Tambah</button>
            <a href="{{ route('santri.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </form>

@endsection
