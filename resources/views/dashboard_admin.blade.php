@include('template_admin.header')
@include('template_Admin.sidebar')

<main class="col-md-9 col-lg-10 content py-4 d-flex flex-column">
    <div class="container flex-grow-1">
        <h1>Data Laporan</h1>
        @if ($reports->isEmpty())
            <div class="alert alert-info text-center">
                Tidak ada data laporan untuk ditampilkan.
            </div>
        @else
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Program</th>
                        <th>Jumlah Penerima</th>
                        <th>Wilayah</th>
                        <th>Tanggal Penyaluran</th>
                        <th>Bukti</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reports as $report)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $report->program_name }}</td>
                            <td>{{ $report->recipient_count }}</td>
                            <td>{{ $report->district }}, {{ $report->sub_district }}, {{ $report->province }}</td>
                            <td>{{ $report->distribution_date }}</td>
                            <td>
                                <a href="{{ asset('storage/' . $report->evidence_path) }}" target="_blank">View</a> <br>
                                <a href="{{ asset('storage/' . $report->evidence_path) }}" target="_blank"
                                    download>Download</a>

                            </td>


                            <td>{{ $report->status ?? 'Pending' }}</td>
                            <td>
                                @if ($report->status == 'Pending' || $report->status == null)
                                    <form action="{{ route('reports.updateStatus', $report->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" name="status" value="Approved"
                                            class="btn btn-success">Terima</button>
                                    </form>

                                    <button type="button" class="btn btn-danger"
                                        onclick="rejectReport({{ $report->id }})">Tolak</button>
                                @elseif($report->status == 'Approved')
                                    <button type="button" class="btn btn-danger"
                                        onclick="rejectReport({{ $report->id }})">Tolak</button>
                                @else
                                    <button type="button" class="btn btn-secondary" disabled>Tolak</button>
                                    <button type="button" class="btn btn-secondary" disabled>Terima</button>
                                @endif

                                <form id="reject-form-{{ $report->id }}"
                                    action="{{ route('reports.updateStatus', $report->id) }}" method="POST"
                                    style="display:none;">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="Rejected">
                                    <input type="hidden" name="rejection_reason"
                                        id="rejection-reason-{{ $report->id }}">
                                </form>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</main>



<script>
    function rejectReport(reportId) {
        const reason = prompt('Masukkan alasan penolakan laporan:');
        if (reason) {
            document.getElementById(`rejection-reason-${reportId}`).value = reason;
            document.getElementById(`reject-form-${reportId}`).submit();
        } else {
            alert('Alasan wajib diisi untuk menolak laporan.');
        }
    }
</script>

@include('template_admin.footer')
