@extends('layouts.home')
@section('title_page','Tampil Data Santri')
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-sm-10">
                <div class="form-group">
                    @if ($santri->photo != null)            
                        <img src="{{ '/storage/photo/' . $santri->photo }}" alt="Profile Image Santri" class="rounded-circle" width="200" 
                        style="position: relative;width: 200px;height: 200px;overflow: hidden;">
                    @else
                        <img alt="Profile Image Santri" src="{{ asset('assets/img/avatar/avatar-1.png') }}" class="rounded-circle" width="200">
                    @endif
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <a href="{{ route('santri.edit', $santri->id) }}" class="btn btn-info"><i class="fas fa-pen"></i>  &nbsp;&nbsp;Edit Profil</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm">
                <div class="form-group">
                    <label for="name">Nama Santri</label>
                    <h4>{{ $santri->name }}</h4>
                </div>
            </div>
            <div class="col-sm">
                <div class="form-group">
                    <label for="birth_place">Tempat Lahir Santri</label>
                    <h4>{{ $santri->birth_place }}</h4>
                </div>
            </div>
            <div class="col-sm">                   
                <div class="form-group">
                    <label for="birth_date">Tanggal Lahir Santri</label>
                    <h4>{{ \Carbon\Carbon::parse($santri->birth_date)->isoFormat('D MMMM Y') }}</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="phone">No. HP Santri</label>
                    <h4>{{ $santri->phone }}</h4>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="form-group">
                    <label for="address">Alamat Santri</label>
                    <h4>{{ $santri->address }}</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="school_old">Asal Sekolah Santri</label>
                    <h4>{{ $santri->school_old }}</h4>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="form-group">
                    <label for="school_address_old">Alamat Asal Sekolah Santri</label>
                    <h4>{{ $santri->school_address_old }}</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="school_current">Sekolah Sekarang Santri</label>
                    <h4>{{ $santri->school_current }}</h4>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="form-group">
                    <label for="school_address_current">Alamat Sekolah Sekarang Santri</label>
                    <h4>{{ $santri->school_address_current }}</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="father_name">Nama Ayah Santri</label>
                    <h4>{{ $santri->father_name }}</h4>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="form-group">
                    <label for="father_job">Pekerjaan Ayah Santri</label>
                    <h4>{{ $santri->father_job }}</h4>
                </div>
            </div>
        </div>
        <div class="row">            
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="mother_name">Nama Ibu Santri</label>
                    <h4>{{ $santri->mother_name }}</h4>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="form-group">
                    <label for="mother_job">Pekerjaan Ibu Santri</label>
                    <h4>{{ $santri->mother_job }}</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm">
                <div class="form-group">
                    <label for="parent_phone">No. HP Orang Tua Santri</label>
                    <h4>{{ $santri->parent_phone }}</h4>
                </div>
            </div>
            <div class="col-sm">
                <div class="form-group">
                    <label for="entry_year">Tahun Masuk</label>
                    <h4>{{ $santri->entry_year }}</h4>
                </div>
            </div>
            <div class="col-sm">
                <div class="form-group">
                    <label for="year_out">Tahun Keluar</label>
                    <h4>{{ $santri->year_out ?: "-" }}</h4>
                </div>
            </div>
        </div>
    </div>

    
 
    
    
    
    
    
    
    
    
    
    
    
    

@endsection
