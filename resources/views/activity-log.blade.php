
@extends('layout-cms.home')
@section('title_page','Log Aktivitas')

@section('content')

    <div class="table-responsive">
        <table class="table table-hover table-bordered">
            <thead>
                <tr align="center">
                    <th width="5%">No</th>
                    <th>Date & Time</th>
                    <th>Subject</th>
                    <th>Method</th>
                    <th>Action By</th>
                </tr>
            </thead>
            <tbody>
                @forelse($data as $log => $result)
                    <tr align="center">
                        <td>{{ $log + $data->firstitem()  }}</td>
                        <td>{{ $result->created_at }} - {{ \Carbon\Carbon::parse($result->created_at)->diffForHumans() }}</td>
                        <td>{{ $result->subject }}</td>
                        <td><label class="badge badge-info">{{ $result->method }}</label></td>
                        <td>{{ $result->email }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">Tidak ada data.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-2 float-left">
        <span class="ml-3">Data Keseluruhan: <span class="text-primary font-weight-bold">{{ DB::table('activity_logs')->count() }}</span> Aktivitas pengguna telah terdaftar.</span>
    </div>
    <div class="mt-3 float-right">
        {{ $data->links() }}
    </div>

@endsection
