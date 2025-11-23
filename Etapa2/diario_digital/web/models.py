from django.db import models
from django.contrib.auth.models import User


# ==========================================================================
# BASE DE DATOS: Modelos ORM
# MEJORA: Se define la estructura de la BD usando clases de Python.
# Django se encarga automáticamente de crear las tablas y relaciones (SQL),
# garantizando integridad referencial y seguridad.
# ==========================================================================


# 1. Modelo para Categorías (ej: Tecnología, Eventos)
class Categoria(models.Model):
    nombre_categoria = models.CharField(max_length=100)

    def __str__(self):
        return self.nombre_categoria

# 2. Modelo para las Noticias (Antes tabla 'articulos')
class Noticia(models.Model):
    titulo = models.CharField(max_length=200)
    resumen = models.TextField()
    contenido = models.TextField(default="") # Para el texto completo
    fecha_publicacion = models.DateTimeField(auto_now_add=True)
    # Relaciones: Una noticia tiene un Autor y una Categoría
    autor = models.ForeignKey(User, on_delete=models.CASCADE) 
    categoria = models.ForeignKey(Categoria, on_delete=models.SET_NULL, null=True)

    def __str__(self):
        return self.titulo

# 3. Modelo para Contactos (Lo que llega del formulario)
class Contacto(models.Model):
    nombre = models.CharField(max_length=100)
    email = models.EmailField()
    mensaje = models.TextField()
    fecha_envio = models.DateTimeField(auto_now_add=True)

    def __str__(self):
        return f"{self.nombre} - {self.email}"