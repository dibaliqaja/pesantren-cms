@extends('layout-cms.home')
@section('title_page','Biaya')
@section('content')

    @if (Session::has('alert'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {{ Session('alert') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="row">
        <div class="col-md-8 mb-3">
            <a href="{{ route('biaya.edit') }}" class="btn btn-primary">Edit Biaya</a><br><br>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-md-3 col-lg-3">
            <div class="pricing">
                <div class="pricing-title">
                    Biaya Syahriah/SPP
                </div>
                <div class="pricing-padding">
                    <div class="pricing-price">
                        <h3>Rp. {{ number_format($data->spp, 2, ',', '.') }}</h3>
                        <p>/bulan</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-3 col-lg-3">
            <div class="pricing">
                <div class="pricing-title">
                    Biaya Pembangunan
                </div>
                <div class="pricing-padding">
                    <div class="pricing-price">
                        <h3>Rp. {{ number_format($data->construction, 2, ',', '.') }}</h3>
                        <p>/pendaftar baru</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-3 col-lg-3">
            <div class="pricing">
                <div class="pricing-title">
                    Biaya Fasilitas
                </div>
                <div class="pricing-padding">
                    <div class="pricing-price">
                        <h3>Rp. {{ number_format($data->facilities, 2, ',', '.') }}</h3>
                        <p>/pendaftar baru</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-3 col-lg-3">
            <div class="pricing">
                <div class="pricing-title">
                    Biaya Alokasi Almari
                </div>
                <div class="pricing-padding">
                    <div class="pricing-price">
                        <h3>Rp. {{ number_format($data->wardrobe, 2, ',', '.') }}</h3>
                        <p>/pendaftar baru</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
