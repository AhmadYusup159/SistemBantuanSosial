@include('template.header')


<div class="container">
    <h1>Data Reports</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Program</th>
                <th>Jumlah Penerima</th>
                <th>Provinsi</th>
                <th>Kabupaten</th>
                <th>Kecamatan</th>
                <th>Tanggal Penyaluran</th>
                <th>Bukti</th>
                <th>Catatan</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reports as $report)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $report->program_name }}</td>
                    <td>{{ $report->recipient_count }}</td>
                    <td>{{ $report->province }}</td>
                    <td>{{ $report->district }}</td>
                    <td>{{ $report->sub_district }}</td>
                    <td>{{ $report->distribution_date }}</td>
                    <td>
                        <a href="{{ asset('storage/' . $report->evidence_path) }}" target="_blank">View</a>
                    </td>
                    <td>{{ $report->notes }}</td>
                    <td>{{ $report->status ?? 'Pending' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>


@include('template.footer')
