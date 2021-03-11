
@extends('layout-cms.home')
@section('title_page','Log Aktivitas')

@section('content')

    <div class="table-responsive">
        <table class="table table-hover table-bordered">
            <thead>
                <tr align="center">
                    <th width="5%">No</th>
                    <th>Subject</th>
                    <th>URL</th>
                    <th>Method</th>
                    {{-- <th>IP</th>
                    <th>User Agent</th> --}}
                    <th>Created at</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                @forelse($data as $log => $result)
                    <tr>
                        <td>{{ $log + $data->firstitem()  }}</td>
                        <td>{{ $result->subject }}</td>
                        <td class="text-success">{{ $result->url }}</td>
                        <td><label class="badge badge-info">{{ $result->method }}</label></td>
                        {{-- <td class="text-warning">{{ $result->ip }}</td>
                        <td class="text-danger">{{ $result->agent }}</td> --}}
                        <td>{{ $result->created_at }}</td>
                        <td>{{ $result->name }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">Tidak ada data.</td>
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
