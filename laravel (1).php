
<?php

## Preparación del entorno de desarrollo ##
// Vamos a desarrollar en  Laravel 5.4 

##############
## Composer ##
##############

/*
Laravel utiliza Composer para manejar sus dependencias. 
¿Qué significa esto? Pues el framework Laravel hace uso de una colección de paquetes o componentes propios y de terceros para agregarle funcionalidades a las aplicaciones. Por tanto, necesitamos un gestor de dependencias que se encargue automáticamente de crear proyectos, instalar, actualizar o eliminar componentes y a su vez las dependencias de éstos
*/

## Chequeamos si esta instalado o no Composer
// Abro el cmd de windows, voy a la raiz (C: esto lo hago con el comando cd)
// Escribo el comando: composer


## Si no esta instalado: 
## Se baja de la página y se instala 

https://getcomposer.org/

## 1 --> "Descargar"
## 2 --> Descargamos el ejecutable: "Descargue y ejecute Composer-Setup.exe : instalará la última versión del compositor cada vez que se ejecute."


############################
## Instalación de Laravel ## 

// Una vez listo el entorno de desarrollo, usaremos Composer para instalar Laravel de esta manera:

## 1: Nos posicionamos en nuestro servidor (cd C:\xampp\htdocs)

## 2: composer create-project laravel/laravel nombre-proyecto "5.4.*" (El que vamos a usar)
##  
## 2: composer create-project --prefer-dist laravel/laravel nombre-proyecto (te crea un proyecto con la ultima versión, solo informativo)



## Para verificar que la creación de nuestro proyecto
//Accedemos a http://localhost/nombre_del_proyecto/public en el navegador.

/*
Algunos dicen que el patrón de diseño es MVC, otros Front Controller consiste en que un solo componente de la aplicación es el responsable de manejar de todas las peticiones HTTP que ésta recibe. Es decir, hay un solo punto de acceso para todas las peticiones.

En Laravel esta función la cumple el archivo index.php que se encuentra en el directorio public. junto con el archivo .htaccess. Pues que -cuando usas el servidor web Apache- este último archivo se encarga de redirigir todas las peticiones a index.php

El directorio public contiene además, las imágenes, archivos CSS y de Javascript que será públicos para los usuarios y visitantes de la aplicación, el resto de archivos donde se encuentra la lógica de la aplicación es inaccesible para ellos, es decir, son privados.
*/


/*
Algunas de	las	principales	características	y	ventajas	de	Laravel	son:

* Integra un sistema ORM de	mapeado	de datos relacional	llamado	Eloquent aunque
también	permite	la construcción	de consultas directas a	base de	datos mediante	su
Query	Builder.

* Permite	la	gestión	de	bases	de	datos	y	la	manipulación	de	tablas	desde	código,
manteniendo	un	control	de	versiones	de	las	mismas	mediante	su	sistema	de
Migraciones.

* Utiliza un sistema de	plantillas	para las vistas	llamado	Blade,	el	cual hace uso de la
cache para darle mayor velocidad. Blade	facilita la	creación de	vistas	mediante el	uso
de layouts,	herencia y secciones.

* Facilita	la	extensión	de	funcionalidad mediante paquetes o librerías externas.De	esta
forma	es	muy	sencillo añadir	paquetes que nos faciliten el desarrollo de	una	aplicación
y nos ahorren mucho	tiempo	de	programación.

* Incorpora	un	intérprete	de	línea de	comandos llamado	Artisan	que	nos	ayudará	con	un
montón	de	tareas	rutinarias	como la	creación de	distintos	componentes	de	código,
trabajo	con	la	base de	datos y migraciones, gestión	de	rutas,	cachés,	colas,	tareas

*/

#############################
## Estructura del proyecto ##
#############################

## app
// Contiene el	código	principal de la	aplicación.	

## bootstrap
/* En	esta	carpeta	se	incluye	el	código	que	se	carga	para	procesar	cada	una
de	las	llamadas	a	nuestro	proyecto.	Normalmente	no	tendremos	que	modificar	nada	de
esta	carpeta.
*/

## config
/*	Aquí se	encuentran todos los archivos de configuración de la aplicación:
bas datos,	cache, correos, sesiones o cualquier otra configuración general de la aplicación.
*/

## database
/* 	En	esta	carpeta	se	incluye	todo	lo	relacionado	con	la	definición	de	la
base	de	datos	de	nuestro	proyecto.	Dentro	de	ella	podemos	encontrar	a	su	vez	tres
carpetas:	factores,	migrations	y	seeds
*/

## public
/*	Es	la	única	carpeta	pública,	la	única	que	debería	ser	visible	en	nuestro
servidor	web.	Todo	las	peticiones	y	solicitudes	a	la	aplicación	pasan	por	esta	carpeta,
ya	que	en	ella	se	encuentra	el	 	index.php	,	este	archivo	es	el	que	inicia	todo	el	proceso
de	ejecución	del	framework.	En	este	directorio	también	se	alojan	los	archivos	CSS,
Javascript,	imágenes	y	otros	archivos	que	se	quieran	hacer	públicos.
*/

## resource
/*
Esta	carpeta	contiene	a	su	vez	tres	carpetas:	assets,	views	y	lang:

view: Este	directorio	contiene	las	vistas	de	nuestra	aplicación.	En
general	serán	plantillas	de	HTML	que	usan	los	controladores	para	mostrar	la
información.	Hay	que	tener	en	cuenta	que	en	esta	carpeta	no	se	almacenan	los
Javascript,	CSS	o	imágenes,	ese	tipo	de	archivos	se	tienen	que	guardar	en	la
carpeta	 	public	

lang: 	En	esta	carpeta	se	guardan	archivos	PHP	que	contienen	arrays
con	los	textos	de	nuestro	sitio	web	en	diferentes	lenguajes,	solo	será	necesario
utilizarla	en	caso	que	se	desee	que	la	aplicación	se	pueda	traducir.

asset: 	Se	utiliza	para	almacenar	los	fuentes	de	los	assets	tipo	less	o
sass	que	se	tendrían	que	compilar	para	generar	las	hojas	de	estilo	públicas.	No	es
necesario	usar	esta	carpeta	ya	que	podemos	escribir	directamente	las	las	hojas	de
estilo	dentro	de	la	carpeta	public.
*/

## routes 
/* Aquí es donde puede registrar rutas web para la aplicación
*/

## storage:
/*
	En	esta	carpeta	Laravel	almacena	toda	la	información	interna	necesarios
para	la	ejecución	de	la	web,	como	son	los	archivos	de	sesión,	la	caché,	la	compilación
de	las	vistas,	meta	información	y	los	logs	del	sistema.	Normalmente	tampoco
tendremos	que	tocar	nada	dentro	de	esta	carpeta,	unicamente	se	suele	acceder	a	ella
para	consultar	los	logs
*/

##tests
/*Esta	carpeta	se	utiliza	para	los	ficheros	con	las	pruebas	automatizadas.
Laravel	incluye	un	sistema	que	facilita	todo	el	proceso	de	pruebas	con	PHPUnit.

## 	vendor
/*En	esta	carpeta	se	alojan	todas	las	librerías	y	dependencias	que	conforman
el	framework	de	Laravel.	Esta	carpeta	tampoco	la	tendremos	que	modificar,	ya	que
todo	el	código	que	contiene	son	librerías	que	se	instalan	y	actualizan	mediante	la
herramienta	Composer
*/

## Archivo importante:
## env
/*Este	fichero	ya	lo	hemos	mencionado	en	la	sección	de	instalación,	se	utiliza
para	almacenar	los	valores	de	configuración	que	son	propios	de	la	máquina	o
instalación	actual.	Lo	que	nos	permite	cambiar	fácilmente	la	configuración	según	la
máquina	en	la	que	se	instale	y	tener	opciones	distintas	para	producción,	para	distintos
desarrolladores,	etc.	Importante,	este	fichero	debería	estar	en	el	 	.gitignore	.
*/