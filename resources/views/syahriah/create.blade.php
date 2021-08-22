@extends('layouts.home')
@section('title_page','Bayar Syahriah/SPP Santri')
@section('content')

    @if (Session::has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ Session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <form action="{{ route('syahriah.store') }}" method="post">
        @csrf
        <div class="container">
            <div class="row">
                <div class="col-sm">
                    <div class="form-group">
                        <label for="santri_id">Nama Santri</label>
                        <select class="form-control select2 @error('santri_id') is-invalid @enderror" name="santri_id" required>
                            <option selected disabled>Pilih Santri</option>
                            @foreach ($data as $santri)
                                <option value="{{ $santri->id }}">{{ $santri->name }}</option>
                            @endforeach
                        </select>
            
                        @error('santri_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-sm">
                    <div class="form-group">
                        <label for="spp">Biaya Syahriah SPP/Bulan</label>
                        <h5>Rp. {{ number_format($cost->spp, 2, ',', '.') }}</h5>
                        <input type="text" hidden class="form-control" name="spp" value="{{ $cost->spp }}" readonly>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm">
                    <div class="form-group">
                        <label for="month">Bulan</label>
                        <select class="form-control select2 @error('month') is-invalid @enderror" name="month" required>
                            <option selected disabled>Pilih Bulan</option>
                            <option value="Jan">Januari</option>
                            <option value="Feb">Februari</option>
                            <option value="Mar">Maret</option>
                            <option value="Apr">April</option>
                            <option value="May">Mei</option>
                            <option value="Jun">Juni</option>
                            <option value="Jul">Juli</option>
                            <option value="Aug">Agustus</option>
                            <option value="Sep">September</option>
                            <option value="Oct">Oktober</option>
                            <option value="Nov">November</option>
                            <option value="Dec">Desember</option>
                        </select>
            
                        @error('month')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-sm">
                    <div class="form-group">
                        <label for="year">Tahun</label>
                        <select class="form-control select2 @error('year') is-invalid @enderror" name="year" required>
                            <option selected disabled>Pilih Tahun</option>
                            @for ($i = $now; $i >= 1900; $i--)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
            
                        @error('year')
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
                        <button class="btn btn-primary">Bayar</button>
                        <a href="{{ route('syahriah.index') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </form>

@endsection
