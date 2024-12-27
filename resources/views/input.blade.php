@include('template.header');

<form id="reportForm" method="POST" action="{{ url('api/reports') }}" enctype="multipart/form-data"
    class="container mt-2 p-4 border rounded shadow">
    <a href="{{ url('/') }}" class="btn-close ms-0" aria-label="Close"></a>
    @csrf
    <h2 class="mb-4 text-center">Formulir Laporan Penyaluran</h2>

    <div class="mb-3">
        <label for="program_name" class="form-label">Program</label>
        <select name="program_name" id="program_name" class="form-select" required>
            <option value="" selected>Pilih Program</option>
            <option value="PKH">PKH</option>
            <option value="BLT">BLT</option>
            <option value="Bansos">Bansos</option>
        </select>
    </div>

    <div class="mb-3">
        <label for="recipient_count" class="form-label">Jumlah Penerima</label>
        <input type="number" name="recipient_count" id="recipient_count" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="province" class="form-label">Provinsi</label>
        <select class="form-select" id="province" name="province" required>
            <option value="" selected>Pilih Provinsi</option>
        </select>
    </div>

    <div class="mb-3">
        <label for="district" class="form-label">Kabupaten/Kota</label>
        <select class="form-select" id="district" name="district" required>
            <option value="" selected>Pilih Kabupaten/Kota</option>
        </select>
    </div>

    <div class="mb-3">
        <label for="sub_district" class="form-label">Kecamatan</label>
        <select class="form-select" id="sub_district" name="sub_district" required>
            <option value="" selected>Pilih Kecamatan</option>
        </select>
    </div>

    <div class="mb-3">
        <label for="distribution_date" class="form-label">Tanggal Penyaluran</label>
        <input type="date" name="distribution_date" id="distribution_date" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="evidence" class="form-label">Bukti Penyaluran</label>
        <input type="file" name="evidence" id="evidence" class="form-control" accept="image/*,application/pdf"
            required>
    </div>

    <div class="mb-3">
        <label for="notes" class="form-label">Catatan Tambahan</label>
        <textarea name="notes" id="notes" class="form-control" rows="3"></textarea>
    </div>

    <div class="d-flex justify-content-start">
        <a href="{{ url('/') }}" class="btn btn-secondary ms-3">Kembali</a>
        <button type="button" id="previewButton" class="btn btn-secondary ms-3">Preview</button>
        <button type="submit" class="btn btn-primary ms-3">Submit</button>
    </div>
</form>

<!-- Modal for Preview -->
<div class="modal fade" id="previewModal" tabindex="-1" aria-labelledby="previewModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="previewModalLabel">Preview Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Program:</strong> <span id="previewProgram"></span></p>
                <p><strong>Jumlah Penerima:</strong> <span id="previewRecipientCount"></span></p>
                <p><strong>Provinsi:</strong> <span id="previewProvince"></span></p>
                <p><strong>Kabupaten/Kota:</strong> <span id="previewDistrict"></span></p>
                <p><strong>Kecamatan:</strong> <span id="previewSubDistrict"></span></p>
                <p><strong>Tanggal Penyaluran:</strong> <span id="previewDistributionDate"></span></p>
                <p><strong>Catatan Tambahan:</strong> <span id="previewNotes"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


@include('template.footer');
