<script src="../../assets/vendor/tinymce/tinymce.min.js"></script>
<script src="../../assets/vendor/php-email-form/validate.js"></script>
<script src="../../assets/vendor/purecounter/purecounter_vanilla.js"></script>
<script src="../../assets/vendor/aos/aos.js"></script>
<script src="../../assets/vendor/glightbox/js/glightbox.min.js"></script>
<script src="../../assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="../../assets/vendor/swiper/swiper-bundle.min.js"></script>
<script src="../../assets/vendor/php-email-form/validate.js"></script>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
<!-- Template Main JS File -->

<script src="../../assets/js/landingPage.js"></script>
<script src="../../assets/js/main.js"></script>

<!-- Template Main JS File -->
<script>
    $(document).ready(function() {
        $('#example').DataTable();
        $('#get-data').click(function() {
            $.ajax({
                url: '{{route("notifi")}}',
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    // tampilkan data pada halaman
                    $('#coba').html(data);
                },
                error: function(data) {
                    // tampilkan pesan error pada halaman
                    $('#coba').html('hemmm')
                }
            });
        });
    });
</script>
