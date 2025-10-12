document.addEventListener('DOMContentLoaded', function() { // Función Principal
    console.log("DOM Cargado. Inicializando script."); // console.log()
    const navLinks = document.querySelectorAll('.nav__link');

    // -----------------------------------------------------
    // FUNCIONALIDAD 1: Smooth Scroll 
    // -----------------------------------------------------
    navLinks.forEach(link => {
        // Función asociada al evento 'click' (Evento 2)
        link.addEventListener('click', function(event) {
            console.log("Evento 'click' detectado en un enlace de navegación."); // console.log()
            
            // USO DE THIS (Uso 1/2): Se pasa 'this' (el elemento <a>) como clickedElement
            handleNavClick(event, this); 
        });
    });
    
    /**
     * @function handleNavClick
     * @description Realiza el desplazamiento suave a la sección objetivo.
     * @param {Event} event - El objeto de evento del click.
     * @param {HTMLElement} clickedElement - El objeto 'this' (el enlace) pasado como parámetro. (2+ parámetros)
     */
    function handleNavClick(event, clickedElement) {
        event.preventDefault();
        
        console.log("Función handleNavClick ejecutada con elemento:", clickedElement); // console.log()

        const targetId = clickedElement.getAttribute('href');
        const targetSection = document.querySelector(targetId);

        if (targetSection) {
            window.scrollTo({
                top: targetSection.offsetTop - 70,
                behavior: 'smooth'
            });
        }
    }
    
    // -----------------------------------------------------
    // FUNCIONALIDAD 2: Animación con Intersection Observer (Fade-in)
    // -----------------------------------------------------
    const sections = document.querySelectorAll('section');
    /**
     * @function IntersectionObserverCallback (Función anónima)
     * @description Maneja la visibilidad de la sección cuando entra en el viewport.
     * @param {Array<IntersectionObserverEntry>} entries - Lista de elementos observados. (2+ parámetros)
     * @param {IntersectionObserver} observer - El objeto observer actual. (2+ parámetros)
     */
    const observer = new IntersectionObserver((entries, observer) => { // Evento 3 (Implícito)
        console.log("IntersectionObserver callback ejecutado."); // console.log()
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

    sections.forEach(section => { // Evento 4 (forEach)
        section.style.opacity = '0';
        section.style.transform = 'translateY(20px)';
        section.style.transition = 'opacity 1s ease-out, transform 0.8s ease-out';
        observer.observe(section);
    });

    // -----------------------------------------------------
    // FUNCIONALIDAD 3: Validación de Formulario
    // -----------------------------------------------------
    const contactForm = document.querySelector('.contact__form');
    if (contactForm) {
        // Función asociada al evento 'submit' (Evento 5)
        contactForm.addEventListener('submit', function(event) {
            console.log("Evento 'submit' detectado en el formulario de contacto."); // console.log()
            
            // USO DE THIS (Uso 2/2): Se pasa 'this' (el formulario) como formElement
            validateForm(event, this); 
        });
    }
    
    /**
     * @function validateForm
     * @description Valida que los campos requeridos no estén vacíos antes de enviar.
     * @param {Event} event - El objeto de evento del submit.
     * @param {HTMLFormElement} formElement - El objeto 'this' (el formulario) pasado como parámetro. (2+ parámetros)
     */
    function validateForm(event, formElement) {
        const nameInput = formElement.querySelector('#name');
        const emailInput = formElement.querySelector('#email');
        const messageInput = formElement.querySelector('#message');
        
        console.log("Ejecutando validación para el formulario:", formElement); // console.log()
        
        if (nameInput.value.trim() === '' || emailInput.value.trim() === '' || messageInput.value.trim() === '') {
            alert('Por favor, completa todos los campos obligatorios.');
            event.preventDefault();
        }
    }

    // -----------------------------------------------------
    // FUNCIONALIDAD 4: FETCH para Listar Datos (Requisito BD/JSON)
    // -----------------------------------------------------
    const btnMostrarDatos = document.getElementById('mostrar-datos');
    const contenedorDatos = document.getElementById('contenedor-datos');

    if (btnMostrarDatos) {
        // Evento 6: Click para FETCH
        btnMostrarDatos.addEventListener('click', () => {
            console.log("Evento 'click' detectado en el botón FETCH. Iniciando solicitud a php/list.php"); // console.log()
            contenedorDatos.innerHTML = '<p>Cargando datos...</p>';
            
            // Requisito FETCH: Trae JSON desde la BD (list.php)
            fetch('php/list.php') 
                .then(response => {
                    console.log("Respuesta de FETCH recibida. Estado:", response.status); // console.log()
                    if (!response.ok) {
                        throw new Error(`Error de red: ${response.status}`);
                    }
                    return response.json(); // Los datos deben ser recibidos en formato JSON
                })
                .then(data => {
                    console.log("Datos recibidos por FETCH:", data); // console.log()
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
                    console.error('Error en la operación FETCH:', error); // console.log()
                    contenedorDatos.innerHTML = `<p style="color: red;">Error al cargar los datos: ${error.message}</p>`;
                });
        });
    }
});