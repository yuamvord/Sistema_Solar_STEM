📂 Comandos de terminal básicos (manejo de archivos y carpetas)
# Crear una carpeta
mkdir nombre_carpeta

# Entrar a una carpeta
cd nombre_carpeta

# Subir un nivel
cd ..

# Ver archivos y carpetas
ls           # Linux / Mac
dir          # Windows

# Crear un archivo vacío
touch nombre_archivo.txt

# Abrir archivo (depende del SO)
nano nombre_archivo.txt      # Linux/Mac terminal
code nombre_archivo.txt      # Si tienes VS Code
notepad nombre_archivo.txt   # Windows

# Eliminar un archivo
rm nombre_archivo.txt

# Eliminar carpeta y su contenido
rm -r nombre_carpeta


🌱 Comandos básicos de Git (iniciar y conectar repositorios)
# Iniciar git en una carpeta
git init

# Configurar tu usuario (solo una vez)
git config --global user.name "TuNombre"
git config --global user.email "tuemail@ejemplo.com"

# Ver estado del repositorio
git status

# Conectar con un repositorio remoto (GitHub)
git remote add origin URL_DEL_REPOSITORIO

# Ver remotos configurados
git remote -v


📥 Clonar repositorio remoto

# Clonar proyecto de GitHub a tu máquina
git clone URL_DEL_REPOSITORIO

# Entrar al proyecto clonado
cd nombre-del-repositorio


🌿 Manejo de ramas
# Ver ramas locales
git branch

# Ver todas las ramas (locales y remotas)
git branch -a

# Crear nueva rama
git branch mi-rama

# Cambiar a otra rama
git checkout mi-rama

# Crear y cambiar a una rama de una vez
git checkout -b mi-rama

# Subir la rama al remoto
git push -u origin mi-rama

# Borrar rama local
git branch -d mi-rama

# Borrar rama remota
git push origin --delete mi-rama


📝 Flujo de trabajo diario (add → commit → push)
# 1. Ver qué archivos cambiaron
git status

# 2. Agregar todos los cambios al área de staging
git add .

# 2.1 Agregar un archivo específico
git add nombre_archivo.txt

# 3. Guardar los cambios en un commit
git commit -m "Descripción de los cambios"

# 4. Subir cambios al repositorio remoto
git push origin nombre_de_la_rama

# 5. Traer cambios del remoto a tu rama
git pull origin nombre_de_la_rama



🔄 Fusionar ramas (Merge)
# Cambiar a main antes de fusionar
git checkout main

# Traer la última versión de main
git pull origin main

# Fusionar cambios de otra rama a main
git merge mi-rama

# Subir los cambios fusionados
git push origin main


💡 Extras útiles
# Ver historial de commits
git log --oneline --graph --all

# Ver diferencias de archivos modificados
git diff

# Cancelar cambios en un archivo antes de hacer add
git checkout -- nombre_archivo.txt

# Deshacer el último commit (mantener cambios)
git reset --soft HEAD~1

# Deshacer el último commit y cambios
git reset --hard HEAD~1