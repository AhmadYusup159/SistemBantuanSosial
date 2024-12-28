@include('template.header')
<div class="bg-gradient-primary">
    <div class="container">
        <div class="container d-flex align-items-center justify-content-center h-100">
            <div class="justify-content-center">
                <div class="col-xl-10 col-lg-12 col-md-9">
                    <div class="card o-hidden border-0 shadow-lg my-5"
                        style="width: 900px; height: auto; background-color: rgba(255, 255, 255, 0.8);">

                        <div class="container">
                            <h1 class="text-center">Edit Report</h1>
                            <form action="{{ route('reports.update', $report->id) }}" method="POST"
                                enctype="multipart/form-data" class="mt-5 p-4 border rounded shadow">
                                <div class="d-flex justify-content-end">
                                    <a href="{{ route('reports.show') }}" class="btn-close" aria-label="Close"></a>
                                </div>

                                @csrf
                                @method('PATCH')

                                <div class="mb-3">
                                    <label for="program_name" class="form-label">Program</label>
                                    <select name="program_name" id="program_name" class="form-select" required>
                                        <option value="" {{ !$report->program_name ? 'selected' : '' }}>Pilih
                                            Program</option>
                                        <option value="PKH" {{ $report->program_name === 'PKH' ? 'selected' : '' }}>
                                            PKH</option>
                                        <option value="BLT" {{ $report->program_name === 'BLT' ? 'selected' : '' }}>
                                            BLT</option>
                                        <option value="Bansos"
                                            {{ $report->program_name === 'Bansos' ? 'selected' : '' }}>Bansos</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="recipient_count" class="form-label">Jumlah Penerima</label>
                                    <input type="number" name="recipient_count" id="recipient_count"
                                        class="form-control" value="{{ $report->recipient_count }}" required>
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
                                    <input type="date" name="distribution_date" id="distribution_date"
                                        class="form-control" value="{{ $report->distribution_date }}" required>
                                </div>

                                <div class="mb-3">
                                    <label for="evidence" class="form-label">Bukti Penyaluran</label>
                                    <input type="file" name="evidence" id="evidence" class="form-control"
                                        accept="image/*,application/pdf">
                                </div>

                                <div class="mb-3">
                                    <label for="notes" class="form-label">Catatan Tambahan</label>
                                    <textarea name="notes" id="notes" class="form-control" rows="3">{{ $report->notes }}</textarea>
                                </div>

                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('reports.show') }}" class="btn btn-secondary">Cancel</a>
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>
</div>



@include('template.footer')
