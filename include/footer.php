<script>
document.addEventListener("DOMContentLoaded", function() {
    const sidebarToggle = document.querySelector('.sidebar-toggle');
    const sidebar = document.querySelector('#sidebar');
    const switchMode = document.querySelector('#switch-mode');
    const body = document.querySelector('body');

    // Función para obtener el estado del sidebar desde localStorage
    function getSidebarState() {
        return localStorage.getItem('sidebarClosed') === 'true';
    }

    // Función para establecer el estado del sidebar en localStorage
    function setSidebarState(isClosed) {
        localStorage.setItem('sidebarClosed', isClosed);
    }

    // Función para obtener el estado del modo oscuro desde localStorage
    function getDarkModeState() {
        return localStorage.getItem('darkModeEnabled') === 'true';
    }

    // Función para establecer el estado del modo oscuro en localStorage
    function setDarkModeState(isEnabled) {
        localStorage.setItem('darkModeEnabled', isEnabled);
    }

    // Verifica el estado guardado del sidebar al cargar la página
    sidebar.classList.toggle('closed', getSidebarState());

    // Verifica el estado guardado del modo oscuro al cargar la página
    body.classList.toggle('dark-mode', getDarkModeState());

    // Evento para toggle del sidebar
    sidebarToggle.addEventListener('click', function() {
        sidebar.classList.toggle('closed');
        setSidebarState(sidebar.classList.contains('closed'));
    });

    // Evento para toggle del modo oscuro
    switchMode.addEventListener('change', function() {
        body.classList.toggle('dark-mode');
        setDarkModeState(body.classList.contains('dark-mode'));
    });
});
</script>

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