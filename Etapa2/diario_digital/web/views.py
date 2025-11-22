from django.shortcuts import render
from django.http import JsonResponse
from django.views.decorators.csrf import csrf_exempt # <--- Para facilitar el fetch por ahora
from .models import Noticia, Contacto
import json

from django.contrib.auth.forms import UserCreationForm
from django.contrib.auth import login
from django.shortcuts import redirect

from django.shortcuts import render, redirect, get_object_or_404
from .forms import NoticiaForm



def home(request):
    # Traemos las últimas 3 noticias, ordenadas por fecha (la más nueva primero)
    # select_related es un truco para optimizar la carga del autor y categoria
    noticias = Noticia.objects.select_related('autor', 'categoria').order_by('-fecha_publicacion')[:3]
    
    data = {
        'noticias': noticias
    }
    return render(request, 'web/index.html', data)

# 1. API para guardar el contacto (Reemplaza a insert.php)
@csrf_exempt  # Usamos esto temporalmente para evitar errores de seguridad con Fetch
def guardar_contacto(request):
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

# 2. API para listar contactos (Reemplaza a list.php)
def listar_contactos(request):
    contactos = Contacto.objects.all().order_by('-fecha_envio')[:5]
    # Convertimos los datos a una lista simple para enviarla como JSON
    data = list(contactos.values('nombre', 'email', 'fecha_envio'))
    return JsonResponse(data, safe=False)

def registro(request):
    if request.method == 'POST':
        form = UserCreationForm(request.POST)
        if form.is_valid():
            user = form.save()
            # Logueamos al usuario automáticamente después de registrarse
            login(request, user)
            return redirect('home')
    else:
        form = UserCreationForm()
    
    return render(request, 'registration/registro.html', {'form': form})


# === CRUD: UPDATE (Editar Noticia) ===
def editar_noticia(request, noticia_id):
    # Solo usuarios logueados pueden editar
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

# === CRUD: DELETE (Eliminar Noticia) ===
def eliminar_noticia(request, noticia_id):
    # Solo usuarios logueados pueden borrar
    if not request.user.is_authenticated:
        return redirect('login')
        
    noticia = get_object_or_404(Noticia, pk=noticia_id)
    noticia.delete()
    return redirect('home')