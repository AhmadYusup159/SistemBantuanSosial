<script>
    $.getJSON('/api/provinces', function(provinces) {
        $.each(provinces.data, function(index, province) {
            $('#province').append(
                `<option value="${province.name}" data-code="${province.code}">${province.name}</option>`
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
                        `<option value="${regency.name}" data-code="${regency.code}">${regency.name}</option>`
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
                        `<option value="${district.name}" data-code="${district.code}">${district.name}</option>`
                    );
                });
            });
        }
    });

    $('#previewButton').on('click', function() {
        $('#previewProgram').text($('#program_name').val());
        $('#previewRecipientCount').text($('#recipient_count').val());
        $('#previewProvince').text($('#province').val());
        $('#previewDistrict').text($('#district').val());
        $('#previewSubDistrict').text($('#sub_district').val());
        $('#previewDistributionDate').text($('#distribution_date').val());
        $('#previewNotes').text($('#notes').val());

        $('#previewModal').modal('show');
    });
</script>

<script>
    let lastScrollTop = 0;
    const navbar = document.getElementById("navbar");

    window.addEventListener("scroll", function() {
        const scrollTop = window.pageYOffset || document.documentElement.scrollTop;

        if (scrollTop > lastScrollTop) {
            navbar.classList.add("hidden");
        } else {
            navbar.classList.remove("hidden");
        }

        lastScrollTop = scrollTop <= 0 ? 0 : scrollTop; // Untuk menghindari nilai negatif
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>
</body>

</html>
