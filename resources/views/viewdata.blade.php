@include('template.header')

<div class="container">
    <h1>Data Laporan</h1>

    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('user.dashboard') }}" class="btn btn-secondary">Kembali</a>
    </div>

    <form action="{{ url()->current() }}" method="GET" class="mb-3">
        <div class="row">
            <div class="col-md-4">
                <input type="text" name="filter_region" class="form-control" placeholder="Filter Wilayah"
                    value="{{ request('filter_region') }}">
            </div>
            <div class="col-md-4">
                <input type="text" name="filter_program" class="form-control" placeholder="Filter Program"
                    value="{{ request('filter_program') }}">
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary">Filter</button>
                <a href="{{ url()->current() }}" class="btn btn-secondary">Reset</a>
            </div>
        </div>
    </form>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Program</th>
                <th>Jumlah Penerima</th>
                <th>Wilayah</th>
                <th>Tanggal Penyaluran</th>
                <th>Bukti</th>
                <th>Alasan Ditolak</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($reports as $report)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $report->program_name }}</td>
                    <td>{{ $report->recipient_count }}</td>
                    <td>{{ $report->district }}, {{ $report->sub_district }}, {{ $report->province }}</td>
                    <td>{{ $report->distribution_date }}</td>
                    <td>
                        <a href="{{ asset('storage/' . $report->evidence_path) }}" target="_blank">View</a>
                    </td>
                    <td>{{ $report->rejection_reason }}</td>
                    <td>
                        @if ($report->status === 'Pending' || $report->status === null)
                            <span class="badge bg-warning text-dark">Pending</span>
                        @elseif($report->status === 'Approved')
                            <span class="badge bg-success">Disetujui</span>
                        @elseif($report->status === 'Rejected')
                            <span class="badge bg-danger">Ditolak</span>
                        @else
                            <span class="badge bg-secondary">Status Tidak Diketahui</span>
                        @endif
                    </td>
                    <td>
                        @if ($report->status === 'Pending')
                            <a href="{{ route('reports.edit', $report->id) }}" class="btn btn-primary">Edit</a>
                            <form action="{{ route('reports.destroy', $report->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Are you sure you want to delete this report?');">Delete</button>
                            </form>
                        @else
                            <span class="text-muted">No Action</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="text-center">No data available</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@include('template.footer')
