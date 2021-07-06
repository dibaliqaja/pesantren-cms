@extends('layout-cms.home')
@section('title_page','Data Pembayaran Pendaftaran Santri Baru')
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
        <div class="col-md-8">
            <a href="{{ route('registration.create') }}" class="btn btn-primary">Bayar Pendaftaran</a><br><br>
        </div>
        <div class="col-md-4 mb-3">
            <form action="#" class="flex-sm">
                <div class="input-group">
                    <input type="text" name="keyword" class="form-control" placeholder="Search" value="{{ Request::get('keyword') }}">
                    <div class="input-group-append">
                        <button class="btn btn-primary mr-2 rounded-right" type="submit"><i class="fas fa-search"></i></button>
                        <button onclick="window.location.href='{{ route('registration.index') }}'" type="button" class="btn btn-md btn-secondary rounded"><i class="fas fa-sync-alt"></i></button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-hover table-bordered">
            <thead>
                <tr align="center">
                    <th width="5%">No</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th width="13%">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data as $regist => $result)
                    <tr>
                        <td>{{ $regist + $data->firstitem() }}</td>
                        <td><a href="{{ route('santri.show',$result->santris->id) }}" target="blank">{{ $result->santris->name }}</a></td>
                        <td>{{ $result->santris->address }}</td>
                        <td align="center">
                            <a href="{{ route('registration.print', $result->id) }}" type="button" class="btn btn-sm btn-warning"><i class="fas fa-print"></i></a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">Tidak ada data.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-2 float-left">
        <span class="ml-3">Data Keseluruhan: <span class="text-primary font-weight-bold">{{ DB::table('registration_costs')->count() }}</span> Pembayaran pendaftar baru telah terdaftar.</span>
    </div>
    <div class="mt-3 float-right">
        {{ $data->links() }}
    </div>

@endsection
