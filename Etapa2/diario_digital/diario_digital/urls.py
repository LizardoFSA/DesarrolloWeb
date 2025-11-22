"""
URL configuration for diario_digital project.

The `urlpatterns` list routes URLs to views. For more information please see:
    https://docs.djangoproject.com/en/5.2/topics/http/urls/
Examples:
Function views
    1. Add an import:  from my_app import views
    2. Add a URL to urlpatterns:  path('', views.home, name='home')
Class-based views
    1. Add an import:  from other_app.views import Home
    2. Add a URL to urlpatterns:  path('', Home.as_view(), name='home')
Including another URLconf
    1. Import the include() function: from django.urls import include, path
    2. Add a URL to urlpatterns:  path('blog/', include('blog.urls'))
"""
# diario_digital/urls.py
from django.contrib import admin
from django.urls import path, include
from web import views

urlpatterns = [
    path('admin/', admin.site.urls),
    path('', views.home, name='home'),
    path('api/listar-contactos/', views.listar_contactos, name='listar_contactos'),
    path('api/guardar-contacto/', views.guardar_contacto, name='guardar_contacto'),
    # === NUEVAS RUTAS DE USUARIOS ===
    # 1. Rutas automáticas de Django (Login, Logout, Password Reset)
    path('accounts/', include('django.contrib.auth.urls')),
    
    # 2. Nuestra ruta personalizada para Registrarse
    path('registro/', views.registro, name='registro'),
    
    path('noticia/editar/<int:noticia_id>/', views.editar_noticia, name='editar_noticia'),
    path('noticia/eliminar/<int:noticia_id>/', views.eliminar_noticia, name='eliminar_noticia'),
]
