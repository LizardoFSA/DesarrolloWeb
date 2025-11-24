document.addEventListener('DOMContentLoaded', function() {
    console.log("DOM Cargado. Inicializando script.");

    // ============================================================
    // MEJORA 1: IntersectionObserver para animaciones eficientes
    // Se reemplaza el uso de eventos 'scroll' constantes por Observer
    // para mejorar el rendimiento del navegador.
    // ============================================================
    const sections = document.querySelectorAll('section');

    const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
                observer.unobserve(entry.target);
            }
        });
    }, {
        rootMargin: '0px 0px -100px 0px'
    });

    sections.forEach(section => {
        section.style.opacity = '0';
        section.style.transform = 'translateY(20px)';
        section.style.transition = 'opacity 1s ease-out, transform 0.8s ease-out';
        observer.observe(section);
    });

    // ============================================================
    // MEJORA 2: Smooth Scroll Nativo
    // Se mantiene lógica simple para navegación fluida
    // ============================================================
    const navLinks = document.querySelectorAll('.nav-link');
    navLinks.forEach(link => {
        link.addEventListener('click', function(event) {
            // Solo aplicamos esto si es un link interno (#)
            if (this.getAttribute('href').startsWith('#')) {
                event.preventDefault();
                const targetId = this.getAttribute('href');
                const targetSection = document.querySelector(targetId);
                if (targetSection) {
                    window.scrollTo({
                        top: targetSection.offsetTop - 70,
                        behavior: 'smooth'
                    });
                }
            }
        });
    });

    // ============================================================
    // MEJORA 3: Envío Asíncrono con Fetch API
    // REFACTORING: Se reemplazó el envío tradicional de formularios
    // por fetch() para evitar recargas de página innecesarias (SPA feel).
    // Corrección: Se usa getElementById para evitar conflicto con Logout.
    // ============================================================
    const contactForm = document.getElementById('contactForm'); // <--- CAMBIO CLAVE AQUÍ

    if (contactForm) {
        contactForm.addEventListener('submit', function(event) {
            event.preventDefault();
            console.log("Evento 'submit' interceptado. Enviando vía Fetch.");

            const formData = {
                name: document.getElementById('name').value,
                email: document.getElementById('email').value,
                message: document.getElementById('message').value
            };

            // Validación simple cliente-servidor
            if (!formData.name || !formData.email || !formData.message) {
                alert('Por favor, completa todos los campos.');
                return;
            }

            fetch('/api/guardar-contacto/', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(formData)
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    alert(data.message);
                    contactForm.reset();
                } else {
                    alert('Error: ' + data.message);
                }
            })
            .catch(error => console.error('Error en Fetch:', error));
        });
    }

    // ============================================================
    // MEJORA 4: Consumo de Datos Dinámicos
    // REFACTORING: Se reemplazó XMLHttpRequest antiguo por Fetch API
    // para obtener datos JSON del backend Django de forma limpia.
    // ============================================================
    const btnMostrarDatos = document.getElementById('mostrar-datos');
    const contenedorDatos = document.getElementById('contenedor-datos');

    if (btnMostrarDatos) {
        btnMostrarDatos.addEventListener('click', () => {
            contenedorDatos.innerHTML = '<p>Cargando datos desde el servidor...</p>';

            fetch('/api/listar-contactos/')
                .then(response => {
                    if (!response.ok) throw new Error(`Error HTTP: ${response.status}`);
                    return response.json();
                })
                .then(data => {
                    let html = '<h6>Últimos Contactos (Vía API Django)</h6>';

                    if (data.length > 0) {
                        html += '<ul class="list-group list-group-flush">';
                        data.forEach(item => {
                            const fecha = new Date(item.fecha_envio).toLocaleDateString();
                            html += `<li class="list-group-item small">
                                        <strong>${item.nombre}</strong> <span class="text-muted">(${item.email})</span><br>
                                        <i class="text-secondary">"${item.mensaje}"</i><br>
                                        <span class="text-muted" style="font-size:0.75em">${fecha}</span>
                                     </li>`;
                        });
                        html += '</ul>';
                    } else {
                        html += '<p class="small text-muted">No hay mensajes recientes.</p>';
                    }
                    contenedorDatos.innerHTML = html;
                })
                .catch(error => {
                    console.error('Error:', error);
                    contenedorDatos.innerHTML = `<p class="text-danger">Error de conexión.</p>`;
                });
        });
    }
});