<script src="<?= $path_prefix ?>assets/js/jquery.min.js"></script>
<script src="<?= $path_prefix ?>assets/js/bootstrap.bundle.min.js"></script>
<script src="<?= $path_prefix ?>assets/js/metismenu.min.js"></script>
<script src="<?= $path_prefix ?>assets/js/waves.js"></script>
<script src="<?= $path_prefix ?>assets/js/simplebar.min.js"></script>

<!-- third party js -->
<script src="<?= $path_prefix ?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= $path_prefix ?>plugins/datatables/dataTables.bootstrap4.js"></script>
<script src="<?= $path_prefix ?>plugins/datatables/dataTables.responsive.min.js"></script>
<script src="<?= $path_prefix ?>plugins/datatables/responsive.bootstrap4.min.js"></script>
<script src="<?= $path_prefix ?>plugins/datatables/dataTables.buttons.min.js"></script>
<script src="<?= $path_prefix ?>plugins/datatables/buttons.bootstrap4.min.js"></script>
<script src="<?= $path_prefix ?>plugins/datatables/buttons.html5.min.js"></script>
<script src="<?= $path_prefix ?>plugins/datatables/buttons.flash.min.js"></script>
<script src="<?= $path_prefix ?>plugins/datatables/buttons.print.min.js"></script>
<script src="<?= $path_prefix ?>plugins/datatables/dataTables.keyTable.min.js"></script>
<script src="<?= $path_prefix ?>plugins/datatables/dataTables.select.min.js"></script>
<script src="<?= $path_prefix ?>plugins/datatables/pdfmake.min.js"></script>
<script src="<?= $path_prefix ?>plugins/datatables/vfs_fonts.js"></script>
<!-- third party js ends -->

<!-- Morris Js-->
<script src="<?= $path_prefix ?>plugins/morris-js/morris.min.js"></script>
<!-- Raphael Js-->
<script src="<?= $path_prefix ?>plugins/raphael/raphael.min.js"></script>

<!-- App js -->
<script src="<?= $path_prefix ?>assets/js/theme.js"></script>

<script>
    $(document).ready(function() {

        // Key Datatable
        $('#datatable-users').DataTable({
            keys: true,
            "language": {
                "paginate": {
                    "previous": "<i class='mdi mdi-chevron-left'>",
                    "next": "<i class='mdi mdi-chevron-right'>"
                }
            },
            "drawCallback": function() {
                $('.dataTables_paginate > .pagination').addClass('pagination-rounded');
            }
        });

    });
</script>