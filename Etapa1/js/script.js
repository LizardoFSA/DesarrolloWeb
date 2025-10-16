document.addEventListener('DOMContentLoaded', function() { // Función Principal
    console.log("DOM Cargado. Inicializando script.");
    const navLinks = document.querySelectorAll('.nav__link');

    // FUNCIONALIDAD 1: Smooth Scroll 
    navLinks.forEach(link => {
        // Evento 2: Click en enlaces de navegación
        link.addEventListener('click', function(event) {
            console.log("Evento 'click' detectado en un enlace de navegación.");
            
            // USO DE THIS
            handleNavClick(event, this); 
        });
    });


    function handleNavClick(event, clickedElement) {
        event.preventDefault();
        
        console.log("Función handleNavClick ejecutada con elemento:", clickedElement);
        const targetId = clickedElement.getAttribute('href');
        const targetSection = document.querySelector(targetId);
        if (targetSection) {
            window.scrollTo({
                top: targetSection.offsetTop - 70,
                behavior: 'smooth'
            });
        }
    }
    
    // FUNCIONALIDAD 2: Animación con Intersection Observer
    const sections = document.querySelectorAll('section');
    const observer = new IntersectionObserver((entries, observer) => { // Evento 3: Intersection Observer
        console.log("IntersectionObserver callback ejecutado.");
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

    sections.forEach(section => { // Evento 4: Observación de cada sección
        section.style.opacity = '0';
        section.style.transform = 'translateY(20px)';
        section.style.transition = 'opacity 1s ease-out, transform 0.8s ease-out';
        observer.observe(section);
    });


    // FUNCIONALIDAD 3: Validación de Formulario
    const contactForm = document.querySelector('.contact__form');
    if (contactForm) {
        // Evento 5: Submit del Formulario
        contactForm.addEventListener('submit', function(event) {
            console.log("Evento 'submit' detectado en el formulario de contacto.");
            
            // USO DE THIS: Se pasa el formulario como formElement
            validateForm(event, this); 
        });
    }


    function validateForm(event, formElement) {
        const nameInput = formElement.querySelector('#name');
        const emailInput = formElement.querySelector('#email');
        const messageInput = formElement.querySelector('#message');
        
        console.log("Ejecutando validación para el formulario:", formElement);
        
        if (nameInput.value.trim() === '' || emailInput.value.trim() === '' || messageInput.value.trim() === '') {
            alert('Por favor, completa todos los campos obligatorios.');
            event.preventDefault();
        }
    }

    // FUNCIONALIDAD 4: FETCH para Listar Datos (Requisito BD/JSON)
    const btnMostrarDatos = document.getElementById('mostrar-datos');
    const contenedorDatos = document.getElementById('contenedor-datos');

    if (btnMostrarDatos) {
        // Evento 6: Click para FETCH
        btnMostrarDatos.addEventListener('click', () => {
            console.log("Evento 'click' detectado en el botón FETCH. Iniciando solicitud a php/list.php");
            contenedorDatos.innerHTML = '<p>Cargando datos...</p>';
            
            // Requisito FETCH: Trae JSON desde la BD
            fetch('php/list.php') 
                .then(response => {
                    console.log("Respuesta de FETCH recibida. Estado:", response.status);
                    if (!response.ok) {
                        throw new Error(`Error de red: ${response.status}`);
                    }
                    return response.json(); // Los datos deben ser recibidos en formato JSON
                })
                .then(data => {
                    console.log("Datos recibidos por FETCH:", data);
                    let html = '<h3>Últimos Contactos (FETCH)</h3>';
                    
                    if (data.error) {
                         html += `<p style="color: red;">Error en el servidor: ${data.error}</p>`;
                    } else if (data.length > 0) {
                        data.forEach(item => {
                            html += `<p><strong>${item.nombre}</strong> (${item.email}) - Fecha: ${item.fecha_envio}</p>`;
                        });
                    } else {
                        html += '<p>No hay mensajes recientes para mostrar.</p>';
                    }
                    // Mostrar en algún contenedor definido
                    contenedorDatos.innerHTML = html; 
                })
                .catch(error => {
                    console.error('Error en la operación FETCH:', error);
                    contenedorDatos.innerHTML = `<p style="color: red;">Error al cargar los datos: ${error.message}</p>`;
                });
        });
    }
});