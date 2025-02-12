# RFVG - Proyecto 2 

## (https://github.com/RichardFVG/Proyecto2-DPL.git)

## Descripción del proyecto

He desarrollado esta **plataforma de venta de equipos médicos**, llamada MaxiSalud, donde se pueden gestionar productos, usuarios y un carrito de compras. Permite el registro e inicio de sesión de usuarios, la gestión de productos para un administrador, y la posibilidad de añadir y comprar productos para usuarios regulares.

## Tecnologías utilizadas

- **PHP** (versión 7.4 o superior, para la lógica de servidor).
- **MySQL** (para la base de datos).
- **HTML5** y **CSS3** (para la estructura y estilos del sitio).
- **XAMPP** (Apache + MySQL) para crear un entorno de desarrollo local en Windows.
- **Visual Studio Code** con la extensión **PHP Server** (opcional, para previsualizar y trabajar con el proyecto).

## Instrucciones de instalación y ejecución

1. **Clonar o descargar el repositorio**  
   - Descargo (o clono) este repositorio y lo coloco en la carpeta `htdocs` de mi instalación de XAMPP.  
   - Por ejemplo, en Windows la ruta podría ser:  
     ```
     C:\Users\Alpha\OneDrive\Documents\XAMPP\htdocs
     ```
   - Verifico que la estructura del proyecto (directorios y archivos) permanezca intacta.

2. **Levantar el servidor Apache y MySQL con XAMPP**  
   - Abro XAMPP Control Panel.  
   - Inicio los módulos **Apache** (indispensable para PHP) y **MySQL** (necesario para la base de datos).

3. **Configurar la base de datos**  
   - Abro el navegador y entro a `http://localhost/phpmyadmin/`.  
   - Creo una base de datos llamada `tienda_medica`.  
   - Importo el archivo `BD.sql` (ubicado en la carpeta `sql` del proyecto). Este archivo creará las tablas (`usuarios`, `productos`, `carrito`) y algunos productos de ejemplo.  
   - Si decido usar otro nombre de base de datos, actualizo las credenciales en `app/config/db.php`.

4. **Ejecutar el proyecto en el navegador**  
   - Para acceder a la aplicación, escribo en el navegador:
     ```
     http://localhost:3000/app/public/index.php
     ```
   - (Si puse la carpeta con otro nombre, uso esa ruta en lugar de `PROYECTO2-DPL`.)

5. **Uso de Visual Studio Code con la extensión PHP Server (opcional)**  
   - Abro la carpeta del proyecto en Visual Studio Code.  
   - Instalo la extensión **PHP Server** (si no la tengo).  
   - Hago clic derecho sobre el archivo `index.php` (en la carpeta `public`) y selecciono **"PHP Server: Serve project"** (o la opción equivalente).  
   - Se abrirá el proyecto en una nueva pestaña del navegador.  
   - Para que la aplicación se conecte a la base de datos, debo mantener corriendo MySQL (con XAMPP, por ejemplo).

## Capturas de pantalla de la prueba de ejecución

*(Espacio reservado para agregar capturas de pantalla en el futuro.)*