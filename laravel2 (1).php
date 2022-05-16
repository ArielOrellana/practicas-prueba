<?php

##################
## Rutas 		##
##################


/*Las	rutas	de	nuestra	aplicación	aplicación	se	tienen	que	definir	en	el	fichero
routes/web.php	.	
Este es	el punto centralizado para	la	definición	de	rutas y	cualquier ruta no
definida en	este fichero no	será válida, generado una excepción	(lo	que	devolverá un error
404).
*/

## Ruta de tipo GET 

Route::get('/',	function()
{
	return '¡Hola	mundo!';
});


## Ruta de tipo POST

Route::post('foo/bar',	function()
{
	return '¡Hola	mundo!';
});



## Añadir parámetros a las rutas obligatorios


Route::get('user/{id}',	function($id)
{
	return 'User: '.$id;
});

// En el navegador: http://localhost/sistleon/public/user/22
// Si no se pasa ningun valor va a dar error


## Añadir parámetros opcionales a las rutas 

// Un parámetro es opcional simplemente	añadiendo el símbolo ? al	final

Route::get('user/{name?}',	function($name	=	null)
{
	return $name;
});

//En el navegador http://localhost/sistleon/public/user


//También podemos poner algún valor por defecto

Route::get('user/{name?}',	function($name='Pepe')
{
	return $name;
});



#####################
## Artisan    	   ##
#####################
/*
Es una interfaz de	línea de comandos (CLI,	Command	line interface). 
Esta utilidad	nos	va a permitir realizar múltiples tareas	necesarias	durante	el proceso	de	desarrollo	o despliegue	a	producción	de	una	aplicación,	por	lo	que	nos	facilitará
y acelerará	el	trabajo.
*/

//En la raiz de nuestro proyecto abrimos la consola para ejecutar los comandos


//Para listar las opciones de artisan
php	artisan	list


//Para ayuda detallada: help y el comando que queremos saber
php	artisan	help migrate

//Para ver	un listado	con	todas las rutas	que	hemos definido en el fichero web.php	
php	artisan	route:list

//Para generar código
// make

php	artisan	make:controller	MiControlador


##########################
## Vistas 				##
##########################

/*
Las vistas son la forma de presentar el resultado (una pantalla de nuestro sitio web) de forma visual al usuario, el cual podrá interactuar con él y volver a realizar una petición. Las vistas además nos permiten separar toda la parte de presentación de resultados de la lógica (controladores) y de la base de datos (modelos). Por lo tanto no tendrán que realizar ningún tipo de consulta ni procesamiento de datos, simplemente recibirán datos y los prepararán para mostrarlos como HTML.
*/

//Las vistas se almacenan en la carpeta resources/views como ficheros PHP

//Creamos la vista home	(resources/views/home.php)
?>

<html>
	<head>
		<title>Mi	Web</title>
	</head>
	<body>
		<h1>¡Hola	<?php echo $nombre;	?>!</h1>
	</body>
</html>
<?php

//Una vez tenemos una vista tenemos que asociarla a una ruta para poder mostrarla. Para esto tenemos que ir al fichero web.php

Route::get('/',	function()
{
	return	view('home', array('nombre'	=>	'Pepe'));
});

/*
En este caso estamos definiendo que la vista se devuelva cuando se haga una petición tipo GET a la raíz de nuestro sitio. 
*/

/*
Devolvenos la vista usando el método view. 
Esta función recibe como parámetros: El nombre de la vista (en este caso home ), el cual será un fichero almacenado en la carpeta views.

la vista la habíamos guardado en resources/views/home.php . 
Para indicar el nombre de la vista se utiliza el mismo nombre del fichero pero sin la extensión .php . 

Como segundo parámetro recibe un array de datos que se le pasarán a la vista. 
En este caso la vista recibirá una variable llamada $nombre con valor "Pepe". 
*/

/*
 Las vistas se pueden organizar en sub-carpetas dentro de la carpeta resources/views.
 Por ejemplo podríamos tener una carpeta resources/views/user y dentro de esta todas las vistas relacionadas, como por ejemplo login.php , register.php o profile.php . 

 En este caso para referenciar las vistas que están dentro de sub-carpetas tenemos que utilizar la notación tipo "dot", en la que las barras que separan las carpetas se sustituyen por puntos. Por ejemplo, para referenciar la vista resources/views/user/login.php usaríamos el nombre user.login , o la vista resources/views/user/register.php la cargaríamos de la forma:
*/
 Route::get('register',	function()
{
	return	view('user.register');
});

//Pasar datos a una vista 
/*
En el array del metodo view podemos añadir todas la variables que queramos utilizar dentro de la vista, 
ya sean de tipo variable normal Laravel 5 Vistas 28 (cadena, entero, etc.) u otro array o objeto con más 
datos. 
Por ejemplo, para enviar a la vista profile todos los datos del usuario cuyo id recibimos a través de la ruta tendríamos que hacer:
*/

Route::get('user/profile/{id}', function($id) { 
	$user = // Cargar los datos del usuario a partir de $id 
 	return view('user.profile', array('user' => $user)); 
}); 

##########################
## blade 				##
##########################

//Laravel utiliza Blade para la definición de plantillas en las vistas. Esta librería permite realizar todo tipo de operaciones con los datos


/*
Los ficheros de vistas que utilizan el sistema de plantillas Blade tienen que tener la extensión .blade.php . Esta extensión tampoco se tendrá que incluir a la hora de referenciar una vista desde el fichero de rutas o desde un controlador. Es decir, utilizaremos view('home') tanto si el fichero se llama home.php como home.blade.php
*/

## Mostrar datos ##

/*
El método más básico que tenemos en Blade es el de mostrar datos, para esto utilizaremos las llaves dobles ({{ }}) y dentro de ellas escribiremos la variable o función con el contenido a mostrar: 
*/

Hola {{ $nombre }}. 
La hora actual es {{ time() }}

## Mostrar un dato solo si existe

{{	isset($nombre)	?	$nombre	:	'Valor	por	defecto'	}}
// O simplemente usar la notación que incluye Blade para este fin:
{{	$nombre	or	'Valor	por	defecto'	}}

## Comentarios

{{--	Este	comentario	no	se	mostrará	en	HTML	--}}

## Estructuras de control

@if( count($users) === 1 ) 
	Solo hay un usuario! 
@elseif (count($users) > 1) 
	Hay muchos usuarios! 
@else 
	No hay ningún usuario :( 
@endif


@for($i	=0;	$i	<	10;	$i++)
	El	valor	actual	es	{{	$i	}}
@endfor



@while(true)
	<p>Soy	un	bucle	while	infinito!</p>
@endwhile


@foreach($users	as	$user)
	<p>Usuario	{{	$user->nombre	}}	con	identificador:	{{	$user->id	}}</p>
@endforeach


## Incluir una plantilla dentro de otra plantilla 

/*
En Blade podemos indicar que se incluya una plantilla dentro de otra plantilla,
para esto disponemos de la instrucción @include : 
*/
 @include('view_name') 

 /*
Ademas podemos pasarle un array de datos a la vista a cargar usando el segundo parámetro del método include : 
Esta opción es muy útil para crear vistas que sean reutilizables o para separar el contenido de una vista en varios ficheros.	
*/
 @include('view_name', array('some'=>'data')) 

## Layouts 
/*
Blade también nos permite la definición de layouts para crear una estructura HTML base con secciones que serán rellenadas por otras plantillas o vistas hijas. 
Por ejemplo, podemos crear un layout con el contenido principal o común de nuestra web (head, body, etc.) y definir una serie de secciones que serán rellenados por otras plantillas para completar el código
*/


//resources/views/layouts/master.blade.php	:

?>

<html>
	<head>
		<title>Mi	Web</title>
	</head>
	<body>
		@section('menu')
			Contenido	del	menu
		@show
		div	class="container">
			@yield('content')
		</div>
	</body>
</html>

<?php
/*
Posteriormente, en otra plantilla o vista,
podemos indicar que extienda el layout que hemos creado (con @extends('layouts.master') ) 
y que complete las dos secciones de contenido que habíamos definido en el mismo: 
*/
@extends('layouts.master') 


@section('menu') 
	@parent 
	//Este condenido es añadido al menú principal.
@endsection 

@section('content') 
	//Este apartado aparecerá en la sección "content".
@endsection 


/*
Como se puede ver, las vistas que extienden un layout simplemente tienen que sobrescribir las secciones del layout. 
La directiva @section permite ir añadiendo contenido en las plantillas hijas, mientras que @yield será sustituido por el contenido que se indique.
 El método @parent carga en la posición indicada el contenido definido por el padre para dicha sección. El método @yield también permite establecer un contenido por defecto mediante su segundo parámetro: 
*/
 @yield('section', 'Contenido por defecto')


 #################
 ## Tarea 		##
 #################

 Ejercicio 1
 -----------


 /*
En este ejercicio vamos a definir las rutas principales que va a tener nuestro sitio web. 
Para empezar simplemente indicaremos que las rutas devuelvan una cadena 
(así podremos comprobar que se han creado correctamente).
 */


Ruta 					Texto a mostrar
----                    -----------------
/ 						Pantalla	principal
login 					Login	usuario
logout 					Logout	usuario
catalog 				Listado	productos
catalog/show/{id} 		Vista	detalle	de producto	{id}
catalog/create 			Añadir	producto
catalog/edit/{id} 		Modificar	producto	{id}


Ejercicio 2
/*
Para comprobar que las rutas se hayan creado correctamente utiliza el comando de artisan que devuelve un listado de rutas y además prueba también las rutas en el navegador
*/