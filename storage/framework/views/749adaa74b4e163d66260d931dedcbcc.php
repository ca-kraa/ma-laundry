<footer class="main-footer">
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.2.0
    </div>
</footer>

<aside class="control-sidebar control-sidebar-dark">
</aside>
</div>
<script src="<?php echo e(asset('assets/AdminLTE')); ?>/plugins/jquery/jquery.min.js"></script>
<script src="<?php echo e(asset('assets/AdminLTE')); ?>/plugins/jquery-ui/jquery-ui.min.js"></script>
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<script src="<?php echo e(asset('assets/AdminLTE')); ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo e(asset('assets/AdminLTE')); ?>/plugins/chart.js/Chart.min.js"></script>
<script src="<?php echo e(asset('assets/AdminLTE')); ?>/plugins/sparklines/sparkline.js"></script>
<script src="<?php echo e(asset('assets/AdminLTE')); ?>/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="<?php echo e(asset('assets/AdminLTE')); ?>/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<script src="<?php echo e(asset('assets/AdminLTE')); ?>/plugins/jquery-knob/jquery.knob.min.js"></script>
<script src="<?php echo e(asset('assets/AdminLTE')); ?>/plugins/moment/moment.min.js"></script>
<script src="<?php echo e(asset('assets/AdminLTE')); ?>/plugins/daterangepicker/daterangepicker.js"></script>
<script src="<?php echo e(asset('assets/AdminLTE')); ?>/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<script src="<?php echo e(asset('assets/AdminLTE')); ?>/plugins/summernote/summernote-bs4.min.js"></script>
<script src="<?php echo e(asset('assets/AdminLTE')); ?>/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<script src="<?php echo e(asset('assets/AdminLTE')); ?>/dist/js/adminlte.js"></script>
<script src="<?php echo e(asset('assets/AdminLTE')); ?>/dist/js/demo.js"></script>
<script src="<?php echo e(asset('assets/AdminLTE')); ?>/dist/js/pages/dashboard.js"></script>
<script src="<?php echo e(asset('assets/AdminLTE')); ?>/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo e(asset('assets/AdminLTE')); ?>/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo e(asset('assets/AdminLTE')); ?>/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo e(asset('assets/AdminLTE')); ?>/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?php echo e(asset('assets/AdminLTE')); ?>/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?php echo e(asset('assets/AdminLTE')); ?>/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?php echo e(asset('assets/AdminLTE')); ?>/plugins/jszip/jszip.min.js"></script>
<script src="<?php echo e(asset('assets/AdminLTE')); ?>/plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?php echo e(asset('assets/AdminLTE')); ?>/plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?php echo e(asset('assets/AdminLTE')); ?>/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?php echo e(asset('assets/AdminLTE')); ?>/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?php echo e(asset('assets/AdminLTE')); ?>/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<script>
$(document).ready(function () {
    var table1 = $("#example1").DataTable({
        responsive: true,
        lengthChange: false,
        autoWidth: false,
        buttons: [
            {
                extend: 'excel',
                className: 'btn btn-success',
                text: '<i class="fas fa-file-excel"></i> Excel'
            },
            {
                extend: 'pdf',
                className: 'btn btn-danger',
                text: '<i class="fas fa-file-pdf"></i> PDF'
            }
        ]
    });

    table1.buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

    $('#example2').DataTable({
        paging: true,
        lengthChange: true,
        searching: false,
        ordering: true,
        lengthMenu: [10, 25, 50, 100],
        info: true,
        autoWidth: false,
        responsive: true
    });

    var satuanTable = $('#satuan').DataTable({
        paging: true,
        lengthChange: true,
        lengthMenu: [10, 25, 50, 100],
        searching: true,
        searching: true,
        ordering: true,
        info: true,
        autoWidth: false,
        responsive: true
    });
});

</script>





<script>
    document.addEventListener('DOMContentLoaded', function() {
        const konsumenSelect = document.getElementById('konsumen');
        const alamatInput = document.getElementById('alamat');

        konsumenSelect.addEventListener('change', function() {
            const selectedOption = konsumenSelect.options[konsumenSelect.selectedIndex];
            const alamat = selectedOption.getAttribute('data-alamat');
            alamatInput.value = alamat || '';
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const paketSelect = document.getElementById('paket_kuota');
        const beratInput = document.getElementById('berat');
        const hargaInput = document.getElementById('harga');
        const totalInput = document.getElementById('total');

        paketSelect.addEventListener('change', function() {
            const selectedOption = paketSelect.options[paketSelect.selectedIndex];
            const optionValue = selectedOption.value;

            if (optionValue) {
                const parts = optionValue.split(' => ');
                const hargaValue = parseInt(parts[1].replace(',', ''));
                const beratValue = parseInt(parts[0].split(', ')[1]);
                const totalValue = hargaValue * beratValue;

                beratInput.value = `${beratValue} Kg`;
                hargaInput.value = `Rp. ${parts[1]}`;
                totalInput.value = `Rp. ${totalValue.toLocaleString()}`;
            } else {
                beratInput.value = '';
                hargaInput.value = '';
                totalInput.value = '';
            }
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const konsumenSelect = document.getElementById('konsumen');
        const namaDepanInput = document.getElementById('nama_depan'); // Ganti dengan ID input nama depan di formulir
        const namaBelakangInput = document.getElementById('nama_belakang'); // Ganti dengan ID input nama belakang di formulir

        konsumenSelect.addEventListener('change', function() {
            const selectedOption = konsumenSelect.options[konsumenSelect.selectedIndex];
            const namaDepan = selectedOption.getAttribute('data-nama-depan');
            const namaBelakang = selectedOption.getAttribute('data-nama-belakang');

            namaDepanInput.value = namaDepan;
            namaBelakangInput.value = namaBelakang;
        });
    });
</script>

<script>
    function updateAlamat() {
        var konsumenSelect = document.getElementById("konsumen");
        var selectedOption = konsumenSelect.options[konsumenSelect.selectedIndex];
        var alamatField = document.getElementById("alamat");

        if (selectedOption && selectedOption.getAttribute("data-alamat")) {
            var alamat = selectedOption.getAttribute("data-alamat");
            alamatField.value = alamat;
        }
    }
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const filterForm = document.getElementById('filterForm');
        const fromDateInput = document.getElementById('fromDate');
        const toDateInput = document.getElementById('toDate');

        filterForm.addEventListener('submit', function(event) {
            event.preventDefault();

            const fromDateString = fromDateInput.value;
            const toDateString = toDateInput.value;

            const url = "<?php echo e(route('paket.filter')); ?>?start_date=" + fromDateString + "&end_date=" + toDateString;

            window.location.href = url;
        });
    });
</script>



</body>
</html>
<?php /**PATH D:\UdaCoding\Codingan\MALaundry\resources\views/atribut/footer.blade.php ENDPATH**/ ?>