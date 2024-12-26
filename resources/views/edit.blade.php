@include('template.header')

<div class="container">
    <h1>Edit Report</h1>
    <form action="{{ route('update', $report->id) }}" method="POST" enctype="multipart/form-data"
        class="mt-5 p-4 border rounded shadow">
        @csrf
        @method('PATCH')

        <div class="mb-3">
            <label for="program_name" class="form-label">Program</label>
            <select name="program_name" id="program_name" class="form-select" required>
                <option value="" {{ !$report->program_name ? 'selected' : '' }}>Pilih Program</option>
                <option value="PKH" {{ $report->program_name === 'PKH' ? 'selected' : '' }}>PKH</option>
                <option value="BLT" {{ $report->program_name === 'BLT' ? 'selected' : '' }}>BLT</option>
                <option value="Bansos" {{ $report->program_name === 'Bansos' ? 'selected' : '' }}>Bansos</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="recipient_count" class="form-label">Jumlah Penerima</label>
            <input type="number" name="recipient_count" id="recipient_count" class="form-control"
                value="{{ $report->recipient_count }}" required>
        </div>

        <div class="mb-3">
            <label for="province" class="form-label">Provinsi</label>
            <select class="form-select" id="province" name="province" required>
                <option value="" {{ !$report->province ? 'selected' : '' }}>Pilih Provinsi</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="district" class="form-label">Kabupaten/Kota</label>
            <select class="form-select" id="district" name="district" required>
                <option value="" {{ !$report->district ? 'selected' : '' }}>Pilih Kabupaten/Kota</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="sub_district" class="form-label">Kecamatan</label>
            <select class="form-select" id="sub_district" name="sub_district" required>
                <option value="" {{ !$report->sub_district ? 'selected' : '' }}>Pilih Kecamatan</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="distribution_date" class="form-label">Tanggal Penyaluran</label>
            <input type="date" name="distribution_date" id="distribution_date" class="form-control"
                value="{{ $report->distribution_date }}" required>
        </div>

        <div class="mb-3">
            <label for="evidence" class="form-label">Bukti Penyaluran</label>
            <input type="file" name="evidence" id="evidence" class="form-control" accept="image/*,application/pdf">
        </div>

        <div class="mb-3">
            <label for="notes" class="form-label">Catatan Tambahan</label>
            <textarea name="notes" id="notes" class="form-control" rows="3">{{ $report->notes }}</textarea>
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('show') }}" class="btn btn-secondary">Cancel</a>
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
</div>

<script>
    $.getJSON('/api/provinces', function(provinces) {
        $.each(provinces.data, function(index, province) {
            $('#province').append(
                `<option value="${province.name}" data-code="${province.code}" ${province.name === '{{ $report->province }}' ? 'selected' : ''}>${province.name}</option>`
            );
        });
    });

    $('#province').on('change', function() {
        const provinceCode = $(this).find(':selected').data('code');
        $('#district').empty().append('<option value="" selected>Pilih Kabupaten/Kota</option>');
        $('#sub_district').empty().append('<option value="" selected>Pilih Kecamatan</option>');
        if (provinceCode) {
            $.getJSON(`/api/regencies/${provinceCode}`, function(regencies) {
                $.each(regencies.data, function(index, regency) {
                    $('#district').append(
                        `<option value="${regency.name}" data-code="${regency.code}" ${regency.name === '{{ $report->district }}' ? 'selected' : ''}>${regency.name}</option>`
                    );
                });
            });
        }
    });

    $('#district').on('change', function() {
        const regencyCode = $(this).find(':selected').data('code');
        $('#sub_district').empty().append('<option value="" selected>Pilih Kecamatan</option>');
        if (regencyCode) {
            $.getJSON(`/api/districts/${regencyCode}`, function(districts) {
                $.each(districts.data, function(index, district) {
                    $('#sub_district').append(
                        `<option value="${district.name}" data-code="${district.code}" ${district.name === '{{ $report->sub_district }}' ? 'selected' : ''}>${district.name}</option>`
                    );
                });
            });
        }
    });
</script>

@include('template.footer')
