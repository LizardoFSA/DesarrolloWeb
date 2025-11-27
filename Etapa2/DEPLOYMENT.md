# Diario Digital Estudiantil - Deployment Guide

## Despliegue en PythonAnywhere

### Información del Proyecto
- **Framework**: Django 5.2.8
- **Python Version**: 3.9+
- **Base de Datos**: SQLite (development)

### Pasos para Desplegar

1. **Clonar el repositorio**
```bash
git clone https://github.com/LizardoFSA/DesarrolloWeb.git
cd DesarrolloWeb/Etapa2/diario_digital
```

2. **Crear y activar entorno virtual**
```bash
mkvirtualenv --python=/usr/bin/python3.10 diario_digital
```

3. **Instalar dependencias**
```bash
pip install -r requirements.txt
```

4. **Configurar settings.py**
- Cambiar `DEBUG = False`
- Agregar dominio a `ALLOWED_HOSTS`

5. **Ejecutar migraciones**
```bash
python manage.py migrate
```

6. **Recolectar archivos estáticos**
```bash
python manage.py collectstatic --noinput
```

7. **Crear superusuario**
```bash
python manage.py createsuperuser
```

### Configuración WSGI
Ver archivo de configuración en la carpeta del proyecto.

### Variables de Entorno Importantes
- `DJANGO_SETTINGS_MODULE=diario_digital.settings`
