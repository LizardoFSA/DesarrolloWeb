from django import forms
from django.contrib.auth.forms import UserCreationForm
from django.contrib.auth.models import User
from .models import Noticia

class NoticiaForm(forms.ModelForm):
    class Meta:
        model = Noticia
        fields = ['titulo', 'resumen', 'categoria'] # Campos que dejaremos editar
        widgets = {
            'titulo': forms.TextInput(attrs={'class': 'form-control'}),
            'resumen': forms.Textarea(attrs={'class': 'form-control', 'rows': 3}),
            'categoria': forms.Select(attrs={'class': 'form-control'}),
        }

# === NUEVO FORMULARIO PARA REGISTRO ===
class RegistroForm(UserCreationForm):
    class Meta:
        model = User
        fields = ['username', 'email'] # Agregamos email por si quieres pedirlo

    def __init__(self, *args, **kwargs):
        super().__init__(*args, **kwargs)
        # Este bucle mágico le pone la clase 'form-control' a TODOS los campos
        for field in self.fields:
            self.fields[field].widget.attrs.update({'class': 'form-control'})