#   DS_Travel_Admin

##   Descripción

Este repositorio contiene la parte del panel de administración del proyecto DS Travel, una aplicación web desarrollada como Trabajo Práctico Final para la materia Diseño de Sistemas en 2022. DS Travel es una plataforma de alquiler de vehículos. Este componente permite la gestión y administración del sistema.

##   Requisitos Técnicos

* Navegador web (Firefox, Chrome, etc.)
* Conexión a Internet (para la instalación inicial)
* XAMPP instalado

##   Instalación

1.  **Instalar XAMPP:** Descargue e instale XAMPP en su sistema.
2.  **Crear la carpeta del proyecto:**
    * Localice la carpeta de instalación de XAMPP.
    * Dentro de la carpeta `htdocs`, cree una carpeta llamada `proyectos`.
    * Clone o descargue el repositorio `ds_travel_admin` y copie su contenido dentro de la carpeta `proyectos`. Esto creará la carpeta `ds_travel_admin` dentro de `proyectos`.
    * La estructura de carpetas resultante debe ser: `xampp/htdocs/proyectos/ds_travel_admin`
3.  **Iniciar Apache y MySQL:**
    * Ejecute el XAMPP Control Panel.
    * Inicie los módulos Apache y MySQL haciendo clic en los botones "Start" correspondientes.
4.  **Crear la base de datos:**
    * Abra su navegador web e ingrese `localhost` en la barra de direcciones.
    * En el Dashboard de XAMPP, haga clic en `phpMyAdmin`.
    * En el sidebar de phpMyAdmin, haga clic en "Nueva" y cree una base de datos llamada `ds_travel`.
5.  **Importar la base de datos:**
    * En phpMyAdmin, seleccione la base de datos `ds_travel`.
    * Haga clic en la pestaña "Importar".
    * En "Archivo a importar", seleccione el archivo `ds_travel.sql` que se encuentra dentro de la carpeta `ds_travel_admin/bd`.
6.  **Acceder a la aplicación:**
    * En su navegador web, ingrese la siguiente URL: `http://localhost/proyectos/ds_travel_admin/`

##   Contenido del Repositorio

Este repositorio contiene los archivos necesarios para ejecutar la parte del panel de administración de DS Travel. Los archivos clave incluyen:

* **Código Fuente del Panel de Administración:** (Dentro de la carpeta `ds_travel_admin`) Archivos PHP, HTML, CSS y JavaScript que implementan la interfaz y la lógica del panel de administración.
* **Script de la Base de Datos:** (ds\_travel\_admin/bd/ds\_travel.sql) El script SQL para crear la base de datos `ds_travel` necesaria para la aplicación.

##   Funcionalidades Principales

El panel de administración de DS Travel permite realizar las siguientes operaciones:

* **Gestión de Vehículos:** Alta, Baja, Modificación y Listado de Vehículos. (ABML de Vehículos)
* **Gestión de Accesorios:** Alta, Baja, Modificación y Listado de Accesorios. (ABML de Accesorios)
* **Gestión de Empresas:** Alta, Baja, Modificación y Listado de Empresas. (ABML de Empresas)
* **Gestión de Sucursales:** Alta, Baja, Modificación y Listado de Sucursales. (ABML de Sucursales)
* **Alta de Usuarios:** Creación de nuevos usuarios del sistema.
* **Perfil de Usuario:** Visualización de la información del usuario actual.
* **Cambio de Contraseña:** Función para que los usuarios cambien su contraseña.
* **Reportes:** Generación de reportes por fecha y por cliente.

##   Autor

Valeria E. Durruty
