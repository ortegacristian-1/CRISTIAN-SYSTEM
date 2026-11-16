CRISTIAN SYSTEM - SISTEMA BÁSICO DE VENTAS E INVENTARIO
=======================================================

REQUISITOS
- XAMPP instalado
- Apache y MySQL iniciados
- Navegador web

INSTALACIÓN
1. Descomprime la carpeta CRISTIAN_SYSTEM.
2. Copia la carpeta dentro de: C:\xampp\htdocs\
   Debe quedar: C:\xampp\htdocs\CRISTIAN_SYSTEM\
3. Abre http://localhost/phpmyadmin
4. Entra en la pestaña Importar y selecciona el archivo database.sql
5. Pulsa Importar.
6. Abre en el navegador:
   http://localhost/CRISTIAN_SYSTEM/

ACCESO INICIAL
Usuario: admin
Contraseña: admin123

FUNCIONES
- Inicio con resumen de productos, stock y ventas del día.
- Registro y listado de productos.
- Registro de ventas.
- Descuento automático del inventario al registrar una venta.
- Historial de ventas.

CONFIGURACIÓN DE BASE DE DATOS
El archivo config.php está preparado para XAMPP por defecto:
Host: localhost
Base de datos: cristian_system
Usuario: root
Contraseña: (vacía)

Si tu MySQL tiene otra contraseña, modifica $pass en config.php.

NOTAS
- Este es un sistema básico de demostración.
- Antes de usarlo en un negocio real, cambia la contraseña inicial y agrega
  controles adicionales, copias de seguridad y permisos por usuario.
- Requiere conexión a internet solo para cargar la fuente tipográfica externa;
  si no hay internet, se utilizará Arial como alternativa.
