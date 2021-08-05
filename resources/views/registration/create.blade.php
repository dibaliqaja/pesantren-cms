@extends('layout-cms.home')
@section('title_page','Rincian Biaya Pendaftar Baru')
@section('content')

    <form action="{{ route('registration.store') }}" method="post">
        @csrf
        <div class="container">
            <div class="row">
                <div class="col-sm">
                    <div class="form-group">
                        <label for="santri_id">Nama Santri</label>
                        <select class="form-control select2 @error('santri_id') is-invalid @enderror" name="santri_id" required>
                            <option selected disabled>Pilih Santri</option>
                            @foreach ($data as $santri)
                                <option value="{{ $santri->id }}"
                                    @if (\App\Models\RegistrationCost::where('santri_id', $santri->id)->exists())
                                        disabled
                                    @endif>{{ $santri->name }}</option>
                            @endforeach
                        </select>
            
                        @error('santri_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm">
                    <div class="form-group">
                        <label for="construction">Biaya Pembangunan</label>
                        <input type="text" class="form-control" name="construction" value="{{ $cost->construction }}" readonly>
                    </div>
                </div>
                <div class="col-sm">
                    <div class="form-group">
                        <label for="facilities">Biaya Fasilitas</label>
                        <input type="text" class="form-control" name="facilities" value="{{ $cost->facilities }}" readonly>
                    </div>
                </div>
                <div class="col-sm">
                    <div class="form-group">
                        <label for="wardrobe">Biaya Alokasi Almari</label>
                        <input type="text" class="form-control" name="wardrobe" value="{{ $cost->wardrobe }}" readonly>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm">
                    <div class="form-group">
                        <button class="btn btn-primary">Bayar</button>
                        <a href="{{ route('registration.index') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </form>

@endsection
