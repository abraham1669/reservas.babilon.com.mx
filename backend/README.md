# Genotipo Labotatorio Creativo #

Backend Project 1.0

- Desarrollo de la interfaz de login.
- Sección principal, escritorio.
- Modulo de Usuarios.
- Módulo Galería (Unicamente fotos, se pueden ordenar)
- Módulo Menú (Se pueden cambiar el orden del menu y el orden de las fotos dentro del menu)
- Módulo Testimonios (En 2 Idiomas En/Es)

Notaciones:
- Todos los pluggins javascript deben ir en la carpeta js/bundles/nombre_pluggin

- includes/_funciones.php
    * $site_name cambiar por el nombre del sitio
    * <?=base_url;?> cambiar datos para archivos locales ruta de la carpeta 
    * Cambiar los accesos de la base de datos tanto local como remota
    * En la funcion de "envio_email" cambiar las variables
        $logo = base_url."img/logo_header.png"; (Imagen de encabezado del email)
        $tlink = "backend.revistaequipar.com"; nombre del sitio

- modulo/usuarios/index.php
    * Aqui se definiran los nombres de las secciones mediante un CHECKBOX apartir de la linea 85 class SECCIONS
    * Hay 2 niveles, ADMINISTRADOR puede acceder a todos los modulos
    * EDITOR puede administrar todos los modulos excepto el de USUARIOS y puede administrar modulos independientes.
    
- includes/_modulesMenu.php
    * Una vez definidos los modulos en usuarios el array para mostrar el modulo segun los permisos es el siguiente:
      <?php if (in_array("todos", $sec) || in_array("menus", $sec)) { ?><li><a href="<?= base_url ?>modulo/menus">Menús</a></li> <?php } ?>
    * todos (obviamente si es administrador o si se eligio esta opcion)
    * menus < este es un ejemplo de que si puede administrar el modulo de menus se le imprimira en su MENU+
    * En el INDEX de cada MODULO se debe agregar la linea $seccion_actual = "testimonios"; donde testimonios se debe
    reemplazar por el nombre del modulo que se esta trabajando, este nombre debe coincidir con el nombre del CHECKBOX
    que se defina en el MODULO DE USUARIOS.

- css/src/colores.less
    * Aqui se define la gama de colores para el backend estos son las variables que se usan en el BACKEND.LESS actualmente
      @temaSeleccionado : 'Cafe';
      @cafeHover: #653000;
      @white:#ffffff;
      @cafeAccented;

    * Si no esta la gama de colores, modificar o agregar una nueva gama

- img/logo_header.png
    * Esta imagen se debe reemplazar es la que aparecera en la barra superior una vez ingresando al backend

- img/logo_login.png
    * Este es el logo que aparecera en el LOGIN del backend

PD: 
    - Comentar su codigo.
    - Comentar codigo no comentado xD! si le entienden al codigo agregarle el comment para evitar perdernos.
    - Besos <3 
