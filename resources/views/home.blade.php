@extends('layout-cms.home')
@section('title_page','Dashboard')
@section('content')

<div class="row">
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-danger">
                <i class="fas fa-file-signature"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Total Santri</h4>
                </div>
                <div class="card-body">
                    {{ DB::table('santris')->count() }}
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-warning">
                <i class="fas fa-list-alt"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Total Surat Masuk</h4>
                </div>
                <div class="card-body">
                    {{ DB::table('in_mails')->count() }}
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-success">
                <i class="fas fa-tag"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Total Surat Keluar</h4>
                </div>
                <div class="card-body">
                    {{ DB::table('out_mails')->count() }}
                </div>
            </div>
        </div>
    </div>

@endsection


{{--
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}
