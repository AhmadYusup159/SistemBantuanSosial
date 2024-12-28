@include('template_admin.header')
@include('template_Admin.sidebar')

<main class="col-md-9 col-lg-10 content py-4">
    <div class="container">
        <h1>Data Reports</h1>
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
                            <a href="{{ asset('storage/' . $report->evidence_path) }}" target="_blank">View</a>
                        </td>
                        <td>{{ $report->status ?? 'Pending' }}</td>
                        <td>
                            <form action="{{ route('updateStatus', $report->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PATCH')
                                <button type="submit" name="status" value="Approved"
                                    class="btn btn-success">Terima</button>
                            </form>

                            <button type="button" class="btn btn-danger"
                                onclick="rejectReport({{ $report->id }})">Tolak</button>

                            <form id="reject-form-{{ $report->id }}"
                                action="{{ route('updateStatus', $report->id) }}" method="POST" style="display:none;">
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
    </div>

</main>
</div>
</div>
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
