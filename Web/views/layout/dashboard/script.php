<script src="<?= $path_prefix ?>assets/js/jquery.min.js"></script>
<script src="<?= $path_prefix ?>assets/js/bootstrap.bundle.min.js"></script>
<script src="<?= $path_prefix ?>assets/js/metismenu.min.js"></script>
<script src="<?= $path_prefix ?>assets/js/waves.js"></script>
<script src="<?= $path_prefix ?>assets/js/simplebar.min.js"></script>
<script src="<?= $path_prefix ?>assets/js/function.js"></script>
<script src="<?= $path_prefix ?>assets/js/masonry.js"></script>
<script src="<?= $path_prefix ?>assets/js/translation.js"></script>

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
<script src="<?= $path_prefix ?>plugins/autonumeric/autoNumeric-min.js"></script>
<script src="<?= $path_prefix ?>plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
<script src="<?= $path_prefix ?>plugins/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>
<script src="<?= $path_prefix ?>plugins/moment/moment.js"></script>
<script src="<?= $path_prefix ?>plugins/daterangepicker/daterangepicker.js"></script>
<script src="<?= $path_prefix ?>plugins/select2/select2.min.js"></script>
<script src="<?= $path_prefix ?>plugins/switchery/switchery.min.js"></script>
<script src="<?= $path_prefix ?>plugins/bootstrap-colorpicker/bootstrap-colorpicker.min.js"></script>
<script src="<?= $path_prefix ?>plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
<script src="<?= $path_prefix ?>plugins/dropify/dropify.min.js"></script>
<script src="<?= $path_prefix ?>plugins/sweetalert2/sweetalert2.min.js"></script>
<script src='<?= $path_prefix ?>plugins/fullcalendar/js/fullcalendar.min.js'></script>
<script src="<?= $path_prefix ?>plugins/chart-js/chart.min.js"></script>


<!-- Map -->
<script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js" integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw==" crossorigin=""></script>
<script type='text/javascript' src='https://unpkg.com/leaflet.markercluster@1.3.0/dist/leaflet.markercluster.js'></script>

<!-- PAGES JS -->
<script src="<?= $path_prefix ?>assets/pages/fontawesome.init.js"></script>
<script src="<?= $path_prefix ?>assets/js/theme.js"></script>

<?php
if (isset($newScript) && $newScript != "") {
    echo $newScript;
}
?>

<!-- Morris Js-->
<script src="<?= $path_prefix ?>plugins/morris-js/morris.min.js"></script>
<!-- Raphael Js-->
<script src="<?= $path_prefix ?>plugins/raphael/raphael.min.js"></script>

<script>
    $(document).ready(function() {
        $('#datatable').DataTable({
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

    // Switchery
    $('[data-toggle="switchery"]').each(function(idx, obj) {
        new Switchery($(this)[0], $(this).data());
    });

    // Select2
    $('[data-toggle="select2"]').select2();

    // Touchspin
    var defaultOptions = {
        min: 0,
        max: 1000,
        step: 0.1,
        decimals: 2,
        boostat: 5,
        maxboostedstep: 10,
    };
    $('[data-toggle="touchspin"]').each(function(idx, obj) {
        var objOptions = $.extend({}, defaultOptions, $(obj).data());
        $(obj).TouchSpin(objOptions);
    });


    // Date Range Picker
    var defaultOptions = {
        "cancelClass": "btn-light",
        "applyButtonClasses": "btn-success"
    };
    // date pickers
    $('[data-toggle="daterangepicker"]').each(function(idx, obj) {
        var objOptions = $.extend({}, defaultOptions, $(obj).data(), {
            "locale": {
                "format": "DD/MM/YYYY"
            }
        });
        $(obj).daterangepicker(objOptions);
    });

    //upload style
    $('.dropify').dropify({
        messages: {
            'default': 'Déposer un fichier',
            'replace': 'Déposer un fichier ou cliquer ici pour le remplacer',
            'remove': 'Enlever',
            'error': 'Ooops, quelque chose s\'est mal produit',
        },
        error: {
            'fileSize': 'La taille du fichier est trop volumineux (5M max).'
        }
    });

    // Popover
    var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
    var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
        return new bootstrap.Popover(popoverTriggerEl)
    })
</script>

<script>
    (adsbygoogle = window.adsbygoogle || []).push({});
</script>

<?php
// Display errors
if (isset($errors) && $errors != "") {
    echo $errors;
}
?>