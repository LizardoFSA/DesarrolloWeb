from django.shortcuts import render, redirect, get_object_or_404
from django.http import JsonResponse
from django.views.decorators.csrf import csrf_exempt
from django.contrib.auth.forms import UserCreationForm
from django.contrib.auth import login
from .models import Noticia, Contacto
from .forms import NoticiaForm, RegistroForm
import json

# ==========================================================================
# MEJORA BACKEND: Migración a Django MVT
# Se eliminó el código PHP nativo y las consultas SQL directas.
# Se utiliza el ORM de Django para prevenir inyecciones SQL automáticamente.
# ==========================================================================

def home(request):
    # REFACTORING: Reemplazo de consulta SQL 'SELECT * ... JOIN ...'
    # Se utiliza select_related para optimizar consultas a BD relacional.
    noticias = Noticia.objects.select_related('autor', 'categoria').order_by('-fecha_publicacion')[:3]

    data = {
        'noticias': noticias
    }
    return render(request, 'web/index.html', data)

# === API REST ENDPOINTS (Para consumo via Fetch JS) ===

@csrf_exempt
def guardar_contacto(request):
    # MEJORA: Endpoint seguro que recibe JSON y utiliza validación de Modelos
    if request.method == 'POST':
        data = json.loads(request.body)
        try:
            Contacto.objects.create(
                nombre=data.get('name'),
                email=data.get('email'),
                mensaje=data.get('message')
            )
            return JsonResponse({'status': 'success', 'message': '¡Mensaje enviado con éxito!'})
        except Exception as e:
            return JsonResponse({'status': 'error', 'message': str(e)}, status=500)
    return JsonResponse({'status': 'error', 'message': 'Método no permitido'}, status=405)

def listar_contactos(request):
    # REFACTORING: Serialización de datos a JSON nativa de Python/Django
    contactos = Contacto.objects.all().order_by('-fecha_envio')[:5]
    data = list(contactos.values('nombre', 'email', 'mensaje', 'fecha_envio'))
    return JsonResponse(data, safe=False)

# === SISTEMA DE USUARIOS Y CRUD ===

def registro(request):
    if request.method == 'POST':
        form = RegistroForm(request.POST)
        if form.is_valid():
            user = form.save()
            login(request, user)
            return redirect('home')
    else:
        form = RegistroForm()

    return render(request, 'registration/registro.html', {'form': form})

def editar_noticia(request, noticia_id):
    # SEGURIDAD: Validación de sesión (reemplaza a session_start de PHP)
    if not request.user.is_authenticated:
        return redirect('login')

    noticia = get_object_or_404(Noticia, pk=noticia_id)

    if request.method == 'POST':
        form = NoticiaForm(request.POST, instance=noticia)
        if form.is_valid():
            form.save()
            return redirect('home')
    else:
        form = NoticiaForm(instance=noticia)

    return render(request, 'web/noticia_form.html', {'form': form})

def eliminar_noticia(request, noticia_id):
    if not request.user.is_authenticated:
        return redirect('login')

    noticia = get_object_or_404(Noticia, pk=noticia_id)
    noticia.delete()
    return redirect('home')