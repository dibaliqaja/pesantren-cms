
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
                    <th>URL</th>
                    <th>Action By</th>
                </tr>
            </thead>
            <tbody>
                @forelse($data as $log => $result)
                    <tr align="center">
                        <td>{{ $log + $data->firstitem()  }}</td>
                        <td>{{ $result->created_at }} - {{ \Carbon\Carbon::parse($result->created_at)->diffForHumans() }}</td>
                        <td>{{ $result->subject }}</td>
                        <td><p class="text-warning">{{ $result->url }}</p></td>
                        <td>{{ $result->name }} <br><small class="text-info">{{ $result->email }}</small> </td>
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
