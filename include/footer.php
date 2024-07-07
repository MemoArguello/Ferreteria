<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="<?=APPURL?>/Frontend/dashboard/script.js"></script>
<script src="<?=APPURL?>/Frontend/datatable/datatables.js"></script>
<script src="<?=APPURL?>/Frontend/datatable/datatables.min.js"></script>

<script>
        $(document).ready(function() {
            new DataTable('#listado', {
                responsive: true,
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json',
                    paginate: {
                        first: 'Primero',
                        previous: 'Ant',
                        next: 'Sig',
                        last: 'Últ'
                    }
                }
            });
        });
</script>

    </body>
</html>