
@extends('layouts.home')
@section('title_page','Log Aktivitas')

@section('content')

    <div class="row">
        <div class="col-md-8"></div>
        <div class="col-md-4 mb-3">
            <form action="#" class="flex-sm">
                <div class="input-group">
                    <input type="text" name="keyword" class="form-control" placeholder="Search" value="{{ Request::get('keyword') }}">
                    <div class="input-group-append">
                        <button class="btn btn-primary mr-2 rounded-right" type="submit"><i class="fas fa-search"></i></button>
                        <button onclick="window.location.href='{{ route('logs.index') }}'" type="button" class="btn btn-md btn-secondary rounded"><i class="fas fa-sync-alt"></i></button>
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
                    <th>Time</th>
                    <th>Subject</th>
                    <th>URL</th>
                    <th>Action By</th>
                </tr>
            </thead>
            <tbody>
                @forelse($data as $log => $result)
                    <tr align="center">
                        <td>{{ $log + $data->firstitem()  }}</td>
                        <td><small class="text-primary">{{ \Carbon\Carbon::parse($result->created_at)->diffForHumans() }}</small></td>
                        <td>{{ $result->subject }}</td>
                        <td><small class="text-warning">{{ $result->url }}</small></td>
                        <td>{{ $result->users->santris->name }} <br><small class="text-info">{{ $result->users->email }}</small> </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">Tidak ada data.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-3">
        {{ $data->links() }}
    </div>

@endsection
