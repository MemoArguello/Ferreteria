document.addEventListener("DOMContentLoaded", () => {
    const allSideMenu = document.querySelectorAll('#sidebar .side-menu.top li a');
    const menuBar = document.querySelector('#content nav .bx.bx-menu');
    const sidebar = document.getElementById('sidebar');
    const searchButton = document.querySelector('#content nav form .form-input button');
    const searchButtonIcon = document.querySelector('#content nav form .form-input button .bx');
    const searchForm = document.querySelector('#content nav form');
    const switchMode = document.getElementById('switch-mode');

    // Función para cerrar el sidebar si está en modo 'hide'
    function closeSidebar() {
        sidebar.classList.add('hide');
        localStorage.setItem('sidebarState', 'closed'); // Guardar el estado del sidebar en localStorage
    }

    // Función para abrir el sidebar
    function openSidebar() {
        sidebar.classList.remove('hide');
        localStorage.setItem('sidebarState', 'open'); // Guardar el estado del sidebar en localStorage
    }

    // Restaurar el estado del sidebar desde el localStorage
    const sidebarState = localStorage.getItem('sidebarState');
    if (window.innerWidth < 768 || sidebarState === 'closed') {
        closeSidebar();
    } else {
        openSidebar();
    }

    // Escuchar clics en los elementos del menú lateral
    allSideMenu.forEach(item => {
        const li = item.parentElement;
        item.addEventListener('click', function () {
            allSideMenu.forEach(i => {
                i.parentElement.classList.remove('active');
            });
            li.classList.add('active');
            if (window.innerWidth < 768) {
                closeSidebar();
            }
        });
    });

    // Toggle para el sidebar desde el menú en la barra de navegación
    menuBar.addEventListener('click', function () {
        if (sidebar.classList.contains('hide')) {
            openSidebar();
        } else {
            closeSidebar();
        }
    });

    // Funcionalidad de búsqueda
    searchButton.addEventListener('click', function (e) {
        if (window.innerWidth < 576) {
            e.preventDefault();
            searchForm.classList.toggle('show');
            if (searchForm.classList.contains('show')) {
                searchButtonIcon.classList.replace('bx-search', 'bx-x');
            } else {
                searchButtonIcon.classList.replace('bx-x', 'bx-search');
            }
        }
    });

    // Ajustes adicionales para el modo oscuro
    switchMode.addEventListener('change', function () {
        if (this.checked) {
            document.body.classList.add('dark');
        } else {
            document.body.classList.remove('dark');
        }
    });

    // Evento de redimensionamiento de ventana
    window.addEventListener('resize', function () {
        if (this.innerWidth > 576) {
            searchButtonIcon.classList.replace('bx-x', 'bx-search');
            searchForm.classList.remove('show');
        }
    });
});

