document.addEventListener('DOMContentLoaded', () => {
    const navLinks = document.querySelectorAll('.nav__link');

    navLinks.forEach(link => {
        link.addEventListener('click', (event) => {
            event.preventDefault();

            const targetId = link.getAttribute('href');
            const targetSection = document.querySelector(targetId);

            if (targetSection) {
                window.scrollTo({
                    top: targetSection.offsetTop - 70,
                    behavior: 'smooth'
                });
            }
        });
    });

    const sections = document.querySelectorAll('section');
    const observer = new IntersectionObserver((entries) => {
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

    const contactForm = document.querySelector('.contact__form');
    if (contactForm) {
        contactForm.addEventListener('submit', (event) => {
            const nameInput = document.getElementById('name');
            const emailInput = document.getElementById('email');
            const messageInput = document.getElementById('message');
            
            if (nameInput.value.trim() === '' || emailInput.value.trim() === '' || messageInput.value.trim() === '') {
                alert('Por favor, completa todos los campos obligatorios.');
                event.preventDefault();
            }
        });
    }
});