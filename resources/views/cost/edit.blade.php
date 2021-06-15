@extends('layout-cms.home')
@section('title_page','Edit Biaya')
@section('content')

    <form action="{{ route('biaya.update') }}" method="post">
        @csrf
        @method('PATCH')
        <div class="form-group">
            <label for="spp">Biaya Syahriah/SPP</label>

            <div class="col-md-6">
                <input id="spp" type="number" class="form-control @error('spp') is-invalid @enderror" name="spp" value="{{ old('spp', $data->spp) }}" required autocomplete="spp" min=0>

                @error('spp')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="construction">Biaya Pembangunan</label>

            <div class="col-md-6">
                <input id="construction" type="number" class="form-control @error('construction') is-invalid @enderror" name="construction" value="{{ old('construction', $data->construction) }}" required autocomplete="construction" min=0>

                @error('construction')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="facilities">Biaya Fasilitas</label>

            <div class="col-md-6">
                <input id="facilities" type="number" class="form-control @error('facilities') is-invalid @enderror" name="facilities" value="{{ old('facilities', $data->facilities) }}" required autocomplete="facilities" min=0>

                @error('facilities')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="wardrobe">Biaya Alokasi Almari</label>

            <div class="col-md-6">
                <input id="wardrobe" type="number" class="form-control @error('wardrobe') is-invalid @enderror" name="wardrobe" value="{{ old('wardrobe', $data->wardrobe) }}" required autocomplete="wardrobe" min=0>

                @error('wardrobe')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <button class="btn btn-primary">Update</button>
            <a href="{{ route('biaya.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </form>

@endsection
