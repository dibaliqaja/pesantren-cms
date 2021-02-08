@extends('layout_cms.home')
@section('title_page','Edit Data Santri')
@section('content')

    <form action="{{ route('santri.update', $santri->id) }}" method="post">
        @csrf
        @method('PATCH')
        <div class="form-group">
            <label for="santri_number">No. Induk Santri</label>
            <input type="text" class="form-control @error('santri_number') is-invalid @enderror" name="santri_number" value="{{ old('santri_number', $santri->santri_number) }}">

            @error('santri_number')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="santri_name">Nama Santri</label>
            <input type="text" class="form-control @error('santri_name') is-invalid @enderror" name="santri_name" value="{{ old('santri_name', $santri->santri_name) }}">

            @error('santri_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="santri_address">Alamat Santri</label>
            <textarea class="form-control @error('santri_address') is-invalid @enderror" name="santri_address">{{ old('santri_address', $santri->santri_address) }}</textarea>

            @error('santri_address')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="santri_birth_place">Tempat Lahir Santri</label>
            <input type="text" class="form-control @error('santri_birth_place') is-invalid @enderror" name="santri_birth_place" value="{{ old('santri_birth_place', $santri->santri_birth_place) }}">

            @error('santri_birth_place')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="santri_birth_date">Tanggal Lahir Santri</label>
            <input type="date" class="form-control @error('santri_birth_date') is-invalid @enderror" name="santri_birth_date" value="{{ old('santri_birth_date', $santri->santri_birth_date) }}">

            @error('santri_birth_date')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="santri_phone">No. HP Santri</label>
            <input type="tel" class="form-control @error('santri_phone') is-invalid @enderror" name="santri_phone" value="{{ old('santri_phone', $santri->santri_phone) }}">

            @error('santri_phone')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="santri_school_old">Asal Sekolah Santri</label>
            <input type="text" class="form-control @error('santri_school_old') is-invalid @enderror" name="santri_school_old" value="{{ old('santri_school_old', $santri->santri_school_old) }}">

            @error('santri_school_old')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="santri_school_address_old">Alamat Asal Sekolah Santri</label>
            <textarea class="form-control @error('santri_school_address_old') is-invalid @enderror" name="santri_school_address_old">{{ old('santri_school_address_old', $santri->santri_school_address_old) }}</textarea>

            @error('santri_school_address_old')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="santri_school_current">Sekolah Sekarang Santri</label>
            <input type="text" class="form-control @error('santri_school_current') is-invalid @enderror" name="santri_school_current" value="{{ old('santri_school_current', $santri->santri_school_current) }}">

            @error('santri_school_current')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="santri_school_address_current">Alamat Sekolah Sekarang Santri</label>
            <textarea class="form-control @error('santri_school_address_current') is-invalid @enderror" name="santri_school_address_current">{{ old('santri_school_address_current', $santri->santri_school_address_current) }}</textarea>

            @error('santri_school_address_current')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="santri_father_name">Nama Ayah Santri</label>
            <input type="text" class="form-control @error('santri_father_name') is-invalid @enderror" name="santri_father_name" value="{{ old('santri_father_name', $santri->santri_father_name) }}">

            @error('santri_father_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="santri_mother_name">Nama Ibu Santri</label>
            <input type="text" class="form-control @error('santri_mother_name') is-invalid @enderror" name="santri_mother_name" value="{{ old('santri_mother_name', $santri->santri_mother_name) }}">

            @error('santri_mother_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="santri_father_job">Pekerjaan Ayah Santri</label>
            <input type="text" class="form-control @error('santri_father_job') is-invalid @enderror" name="santri_father_job" value="{{ old('santri_father_job', $santri->santri_father_job) }}">

            @error('santri_father_job')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="santri_mother_job">Pekerjaan Ibu Santri</label>
            <input type="text" class="form-control @error('santri_mother_job') is-invalid @enderror" name="santri_mother_job" value="{{ old('santri_mother_job', $santri->santri_mother_job) }}">

            @error('santri_mother_job')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="santri_parent_phone">No. HP Orang Tua Santri</label>
            <input type="tel" class="form-control @error('santri_parent_phone') is-invalid @enderror" name="santri_parent_phone" value="{{ old('santri_parent_phone', $santri->santri_parent_phone) }}">

            @error('santri_parent_phone')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <button class="btn btn-primary">Update</button>
            <a href="{{ route('santri.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </form>

@endsection
