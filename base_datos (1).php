<?php

//usuario "root"
//servidor local: 127.0.0.1 o localhost
//puerto: 3306:

show databases //lista las bd

create database administracion // crea bd

#####################################################################################################
## Creación de una tabla y mostrar sus campos (create table - show tables - describe - drop table) ##
#####################################################################################################

show tables //ver tablas existentes, no hace falta

create table usuarios (
	 nombre varchar(30),
	 clave varchar(10)
) //crear tablas


describe usuarios //Para ver la estructura de una tabla

drop table usuarios //Para eliminar una tabla
//drop table if exists usuarios;

use administracion //para seleccionar la base de datos esto es opcional


## Ejercicio ##

1- Crear una tabla llamada "agenda", debe tener los siguientes campos: 
     nombre varchar(20)
     domicilio varchar(30)
     y telefono varchar(11)


2- Intente crearla nuevamente. 

3- Visualice las tablas existentes 

4- Visualice la estructura de la tabla "agenda" 

5- Elimine la tabla, si existe 

6- Intente eliminar la tabla sin la cláusula if exists 

//resul
   1- /*

   create table agenda(
   nombre varchar(20),
   domicilio varchar(30),
   telefono varchar(11)
);
*/
 2-//Aparece mensaje de error.
 3-//(show tables).
 4-//(describe agenda).
 5-//(drop table, if exists).
 6-//(drop table agenda). Debe aparecer un mensaje de error cuando no existe la tabla.


###########################################################################
## Carga de registros a una tabla y su recuperación (insert into - select)
###########################################################################

insert into usuarios (nombre, clave) values ('MarioPerez','Marito'); //insertar datos en una tabla

select nombre,clave from usuarios; //visualizar datos de una tabla



//Ejercicio


1- Visualice la estructura de la tabla "agenda". (si n esta hay que crearla)

2- Ingrese los siguientes registros:

 nombre: Alberto Mores
 direccion: Colon 123
 tel: 4234567
 ------
nombre: Juan Torres
direccion: Avellaneda 135
tel: 4458787

3- Seleccione y mustre todos los registros de la tabla:

/*
res

1- describe agenda
1-
  create table agenda(
   nombre varchar(20),
   domicilio varchar(30),
   telefono varchar(11)
);
2-
insert into agenda (nombre, domicilio, telefono) values 
  ('Alberto Mores','Colon 123','4234567');
insert into agenda (nombre, domicilio, telefono) values 
  ('Juan Torres','Avellaneda 135','4458787');

3- select nombre, domicilio, telefono from agenda;


*/

###################################################
## Típos de datos básicos de un campo de una tabla.
###################################################

- varchar: 
----------
se usa para almacenar cadenas de caracteres. Una cadena es una secuencia de caracteres. Se coloca entre comillas (simples): 'Hola'. El tipo "varchar" define una cadena de longitud variable en la cual determinamos el máximo de caracteres. Puede guardar hasta 65535 caracteres (versiones antiguas de MySQL permitían solo 255). Para almacenar cadenas de hasta 30 caracteres, definimos un campo de tipo varchar(30). Si asignamos una cadena de caracteres de mayor longitud que la definida, la cadena se corta. Por ejemplo, si definimos un campo de tipo varchar(10) y le asignamos la cadena 'Buenas tardes', se almacenará 'Buenas tar' ajustándose a la longitud de 10 caracteres.

- integer: 
---------
se usa para guardar valores numéricos enteros, de -2000000000 a 2000000000 aprox. Definimos campos de este tipo cuando queremos representar, por ejemplo, cantidades.

- float: 
--------
se usa para almacenar valores numéricos decimales. Se utiliza como separador el punto (.). Definimos campos de este tipo para precios, por ejemplo.



create table libros(
	titulo varchar(40),
	autor varchar(20),
	editorial varchar(15),
	precio float,
	cantidad integer
);

Insertamos:

insert into libros (titulo,autor,editorial,precio,cantidad)
  values ('El aleph','Borges','Emece',45.50,100);
insert into libros (titulo,autor,editorial,precio,cantidad)
  values ('Alicia en el pais de las maravillas','Lewis Carroll','Planeta',25,200);
insert into libros (titulo,autor,editorial,precio,cantidad)
  values ('Matematica estas ahi','Paenza','Planeta',15.8,200);

Ejercicio:

Una empresa almacena los datos de sus empleados en una tabla "empleados" que guarda los siguientes

datos: nombre, documento, sexo, domicilio, sueldobasico.

1- Cree la tabla eligiendo el tipo de dato adecuado para cada campo

2- Vea la estructura de la tabla:

3- Ingrese algunos registros:
 nombre, documento, sexo, domicilio, sueldobasico:
 Juan Perez,22345678,m,Sarmiento 123,300
 Ana Acosta,24345678,f,Colon 134,500
 Marcos Torres,27345678,m,Urquiza 479,800

4- Seleccione todos los registros
  

/*
res

1
 create table empleados(
  nombre varchar(20),
  documento varchar(8),
  sexo varchar(1),
  domicilio varchar(30),
  sueldobasico float
 );

2-  describe empleados;

3-
 insert into empleados (nombre, documento, sexo, domicilio, sueldobasico)
  values ('Juan Perez','22345678','m','Sarmiento 123',300);
 insert into empleados (nombre, documento, sexo, domicilio, sueldobasico)
  values ('Ana Acosta','24345678','f','Colon 134',500);
 insert into empleados (nombre, documento, sexo, domicilio, sueldobasico)
  values ('Marcos Torres','27345678','m','Urquiza 479',800);

3-select * from empleados;  
*/

#########################################################
## Recuperación de registros específicos (select - where)
#########################################################

select nombre, documento from empleados where nombre='juan'; 

select nombre, documento from empleados where nombre='ana' and documento='24345678';  


#########################################
## Operadores Relacionales = <> < <= > >=
#########################################

Los operadores relacionales son los siguientes:

=	igual
<>	distinto
>	mayor
<	menor
>=	mayor o igual
<=	menor o igual


//Para trabajar: 
drop table if exists libros;

create table libros(
  titulo varchar(20),
  autor varchar(30),
  editorial varchar(15),
  precio float
);

insert into libros (titulo,autor,editorial,precio) values ('El aleph','Borges','Planeta',12.50);
insert into libros (titulo,autor,editorial,precio) values ('Martin Fierro','Jose Hernandez','Emece',16.00);
insert into libros (titulo,autor,editorial,precio) values ('Aprenda PHP','Mario Molina','Emece',35.40);
insert into libros (titulo,autor,editorial,precio) values ('Cervantes','Borges','Paidos',50.90);




//Trabajamos: 
//Podemos seleccionar los registros cuyo autor sea diferente de 'Borges', para ello usamos la condición:
select titulo,autor,editorial from libros where autor<>'Borges';

//Podemos comparar valores numéricos. Por ejemplo, queremos mostrar los libros cuyos precios sean mayores a 20 pesos:
select titulo,autor,editorial,precio from libros where precio>20;

//También, los libros cuyo precio sea menor o igual a 30:
select titulo,autor,editorial,precio from libros where precio<=30;


###############################################
## Borrado de registros de una tabla (delete) 
###############################################

// Para eliminar los registros de una tabla usamos el comando "delete":

delete from usuarios;
/*
Si queremos eliminar uno o varios registros debemos indicar cuál o cuáles, para ello utilizamos el comando "delete" junto con la clausula "where" con la cual establecemos la condición que deben cumplir los registros a borrar

Por ejemplo, queremos eliminar aquel registro cuyo nombre de usuario es 'Leonardo':
*/
delete from usuarios where nombre='Leonardo';

/*
El comando delete hay que tener mucho cuidado en su uso, una vez eliminado un registro no hay forma de recuperarlo. Si por ejemplo ejecutamos el comando:
*/
delete from usuarios;

//Si la tabla tiene 1000000 de filas, todas ellas serán eliminadas.

/*
Nota opcional:

En MySQL hay una variable de configuración llamada SQL_SAFE_UPDATES que puede almacenar los valores 1 (activa) y 0 (desactiva). Cuando tiene el valor 1 no permite ejecutar comandos delete sin indicar un where y que dicho where se relacione a una clave primaria
*/

//ejercicio:

drop table if exists  usuarios;

create table usuarios (
  nombre varchar(30),
  clave varchar(10)
);

insert into usuarios (nombre, clave) values ('Leonardo','payaso');
insert into usuarios (nombre, clave) values ('MarioPerez','Marito');
insert into usuarios (nombre, clave) values ('Marcelo','River');
insert into usuarios (nombre, clave) values ('Gustavo','River');

delete from usuarios;

delete from usuarios where nombre='Leonardo';

select nombre,clave from usuarios;

delete from usuarios where clave='River';

select nombre,clave from usuarios;


##################################################
## Modificación de registros de una tabla (update)
##################################################

//Para modificar uno o varios datos de uno o varios registros utilizamos "update" (actualizar).

//Por ejemplo, en nuestra tabla "usuarios", queremos cambiar los valores de todas las claves, por "RealMadrid":

update usuarios set clave='RealMadrid';

/*
Utilizamos "update" junto al nombre de la tabla y "set" junto con el campo a modificar y su nuevo valor.
El cambio afectará a todos los registros.
Podemos modificar algunos registros, para ello debemos establecer condiciones de selección con "where".
*/

//Por ejemplo, queremos cambiar el valor correspondiente a la clave de nuestro usuario llamado 'MarioPerez', queremos como nueva clave 'Boca', necesitamos una condición "where" que afecte solamente a este registro:

 update usuarios set clave='Boca'
  where nombre='MarioPerez';

//Si no encuentra registros que cumplan con la condición del "where", ningún registro es afectado.
//Las condiciones no son obligatorias, pero si omitimos la cláusula "where", la actualización afectará a todos los registros.

//También se puede actualizar varios campos en una sola instrucción:
//Para ello colocamos "update", el nombre de la tabla, "set" junto al nombre del campo y el nuevo valor y separado por coma, el otro nombre del campo con su nuevo valor.

 update usuarios set nombre='MarceloDuarte', clave='Marce'
  where nombre='Marcelo';

Ejercicio:

drop table if exists  usuarios;

create table usuarios (
  nombre varchar(30),
  clave varchar(10)
);

insert into usuarios (nombre, clave) values ('Leonardo','payaso');
insert into usuarios (nombre, clave) values ('MarioPerez','Marito'); 
insert into usuarios (nombre, clave) values ('Marcelo','River');
insert into usuarios (nombre, clave) values ('Gustavo','River');

select * from usuarios;

update usuarios set clave='RealMadrid';

select nombre,clave from usuarios;

update usuarios set nombre='GustavoGarcia'
  where nombre='Gustavo';

update usuarios set nombre='MarceloDuarte', clave='Marce'
  where nombre='Marcelo';

select nombre,clave from usuarios;


##################################
## Clave Primaria
##################################

//Una clave primaria es un campo (o varios) que identifica 1 solo registro (fila) en una tabla.
//Para un valor del campo clave existe solamente 1 registro. Los valores no se repiten ni pueden ser nulos.

/*
Veamos un ejemplo, si tenemos una tabla con datos de personas, el número de documento puede establecerse como clave primaria, es un valor que no se repite; puede haber personas con igual apellido y nombre, incluso el mismo domicilio (padre e hijo por ejemplo), pero su documento será siempre distinto.

Si tenemos la tabla "usuarios", el nombre de cada usuario puede establecerse como clave primaria, es un valor que no se repite; puede haber usuarios con igual clave, pero su nombre de usuario será siempre distinto.
*/
//Establecemos que un campo sea clave primaria al momento de creación de la tabla:

 create table usuarios (
  nombre varchar(20),
  clave varchar(10),
  primary key(nombre)
 );

//Para definir un campo como clave primaria agregamos "primary key" luego de la definición de todos los campos y entre paréntesis colocamos el nombre del campo que queremos como clave.

//Si visualizamos la estructura de la tabla con "describe" vemos que el campo "nombre" es clave primaria y no acepta valores nulos(más adelante explicaremos esto detalladamente).

Ingresamos algunos registros:

 insert into usuarios (nombre, clave)
  values ('Leonardo','payaso'); 
 insert into usuarios (nombre, clave)
  values ('MarioPerez','Marito');
 insert into usuarios (nombre, clave)
  values ('Marcelo','River');
 insert into usuarios (nombre, clave)
  values ('Gustavo','River');

//Si intentamos ingresar un valor para el campo clave que ya existe, aparece un mensaje de error indicando que el registro no se cargó pues el dato clave existe. Esto sucede porque los campos definidos como clave primaria no pueden repetirse.

//Ingresamos un registro con un nombre de usuario repetido, por ejemplo:

 insert into usuarios (nombre, clave)
  values ('Gustavo','Boca');

//Una tabla sólo puede tener una clave primaria. Cualquier campo (de cualquier tipo) puede ser clave primaria, debe cumplir como requisito, que sus valores no se repitan.

###############################
## Campo con autoincremento 
###############################

//Un campo de tipo entero puede tener otro atributo extra 'auto_increment'. Los valores de un campo 'auto_increment', se inician en 1 y se incrementan en 1 automáticamente.

//Se utiliza generalmente en campos correspondientes a códigos de identificación para generar valores únicos para cada nuevo registro que se inserta.

//Sólo puede haber un campo "auto_increment" y debe ser clave primaria (o estar indexado).

//Para establecer que un campo autoincremente sus valores automáticamente, éste debe ser entero (integer) y debe ser clave primaria:

 create table libros(
  codigo int auto_increment,
  titulo varchar(50),
  autor varchar(50),
  editorial varchar(25),
  primary key (codigo)
 );
//Para definir un campo autoincrementable colocamos "auto_increment" luego de la definición del campo al crear la tabla.
//Este primer registro ingresado guardará el valor 1 en el campo correspondiente al código.
//Si continuamos ingresando registros, el código (dato que no ingresamos) se cargará automáticamente siguiendo la secuencia de autoincremento.

 insert into libros (titulo,autor,editorial)
  values('El aleph','Borges','Planeta');

//Un campo "auto_increment" funciona correctamente sólo cuando contiene únicamente valores positivos.

/*//Está permitido ingresar el valor correspondiente al campo "auto_increment",
//Pero debemos tener cuidado con la inserción de un dato en campos "auto_increment". Debemos tener en cuenta que:
- si el valor está repetido aparecerá un mensaje de error y el registro no se 
  ingresará.
- si el valor dado saltea la secuencia, lo toma igualmente y en las siguientes 
  inserciones, continuará la secuencia tomando el valor más alto.
- si el valor ingresado es 0, no lo toma y guarda el registro continuando la 
  secuencia.
- si el valor ingresado es negativo (y el campo no está definido para aceptar sólo 
  valores positivos), lo ingresa.
 */

drop table if exists libros;

create table libros(
  codigo integer auto_increment,
  titulo varchar(50),
  autor varchar(50),
  editorial varchar(25),
  primary key (codigo)
 );

describe libros;

insert into libros (titulo,autor,editorial)
  values('El aleph','Borges','Planeta');

select * from libros libros;

insert into libros (titulo,autor,editorial)
  values('Martin Fierro','Jose Hernandez','Emece');
insert into libros (titulo,autor,editorial)
  values('Aprenda PHP','Mario Molina','Emece');
insert into libros (titulo,autor,editorial)
  values('Cervantes y el quijote','Borges','Paidos');
insert into libros (titulo,autor,editorial)
  values('Matematica estas ahi', 'Paenza', 'Paidos');

select codigo,titulo,autor,editorial from libros;

insert into libros (codigo,titulo,autor,editorial)
  values(6,'Martin Fierro','Jose Hernandez','Paidos');

insert into libros (codigo,titulo,autor,editorial)
  values(2,'Martin Fierro','Jose Hernandez','Planeta');

insert into libros (codigo,titulo,autor,editorial)
  values(15,'Harry Potter y la piedra filosofal','J.K. Rowling','Emece');

insert into libros (titulo,autor,editorial)
  values('Harry Potter y la camara secreta','J.K. Rowling','Emece');

insert into libros (codigo,titulo,autor,editorial)
  values(0,'Alicia en el pais de las maravillas','Lewis Carroll','Planeta');

insert into libros (codigo,titulo,autor,editorial)
  values(-5,'Alicia a traves del espejo','Lewis Carroll','Planeta');

select * from libros;

############################
## TAREA
############################
Ejercicio A
-----------

2- Cree una tabla llamada "libros". 
   Debe definirse con los siguientes campos: 
   titulo varchar(20), 
   autor varchar(30),
 y editorial varchar(15)

3- Intente crearla nuevamente. 

4- Visualice las tablas existentes.

5- Visualice la estructura de la tabla "libros".

6- Elimine la tabla, si existe.

7- Intente eliminar la tabla.


Ejercicio B
-----------

1- Cree una tabla llamada "libros". Debe definirse con los siguientes campos: 
   titulo (cadena de 20), autor (cadena de 30) y editorial (cadena de 15).

2- Visualice las tablas existentes. 

3- Visualice la estructura de la tabla "libros". 

4- Ingrese los siguientes registros:
 'El aleph','Borges','Planeta';
 'Martin Fierro','Jose Hernandez','Emece';
 'Aprenda PHP','Mario Molina','Emece';

5- Muestre todos los registros. 

Ejercicio C
-----------

Un comercio que vende artículos de computación registra los datos de sus artículos
 en una tabla llamada "articulos".

1- Elimine la tabla si existe.

2- Cree la tabla "articulos" con la siguiente estructura:
  codigo integer, nombre varchar(20), descripcion varchar(30), precio float

3- Vea la estructura de la tabla

4- Ingrese algunos registros:

codigo, nombre    , descripcion        , precio
1     ,'impresora','Epson Stylus C45'  ,400.80
2     ,'impresora','Epson Stylus C85'  ,500
3     ,'monitor'  ,'Samsung 14'        ,800
4     ,'teclado'  ,'ingles Biswal'     ,100
5     ,'teclado'  ,'español Biswal'    ,90

5- Seleccione todos los datos de los registros cuyo nombre sea "impresora".

6- Muestre sólo el código, descripción y precio de los teclados.

Ejercicio D
------------

Trabaje con la tabla "agenda" que registra la información referente a sus amigos.

1- Elimine la tabla si existe.

2- Cree la tabla con los siguientes campos: 

apellido (cadena de 30), 
nombre (cadena de 20),
domicilio (cadena de 30) 
telefono (cadena de 11):

3- Visualice la estructura de la tabla "agenda".

4- Ingrese los siguientes registros::
 Mores,Alberto,Colon 123,4234567,
 Torres,Juan,Avellaneda 135,4458787,
 Lopez,Mariana,Urquiza 333,4545454,
 Lopez,Jose,Urquiza 333,4545454,
 Peralta,Susana,Gral. Paz 1234,4123456.

5- Elimine el registro cuyo nombre sea 'Juan'.
6- Elimine los registros cuyo número telefónico sea igual a '4545454'.

Ejercicio E
-----------


Trabaje con la tabla "agenda" que almacena los datos de sus amigos.

1- Elimine la tabla si existe.

2- 
  apellido varchar(30),
  nombre varchar(20),
  domicilio varchar(30),
  telefono varchar(11)


3- Visualice la estructura de la tabla "agenda".

4- Ingrese los siguientes registros:
 Mores,Alberto,Colon 123,4234567,
 Torres,Juan,Avellaneda 135,4458787,
 Lopez,Mariana,Urquiza 333,4545454,
 Lopez,Jose,Urquiza 333,4545454,
 Peralta,Susana,Gral. Paz 1234,4123456.

5- Modifique el registro cuyo nombre sea "Juan" por "Juan Jose".

6- Actualice los registros cuyo número telefónico sea igual a '4545454' por '4445566'.

7- Actualice los registros que tengan en el campo "nombre" el valor "Juan" por "Juan Jose".

Ejercicio F
-----------

Trabaje con la tabla "libros" de una librería.

1- Elimine la tabla si existe.

2- Créela con los siguientes campos y clave: 
codigo (integer), 
 titulo (cadena de 20 caracteres de longitud),
 autor (cadena de 30), 
editorial (cadena de 15), codigo será clave primaria:
 


3- Visualice la estructura de la tabla "libros", compruebe la clave primaria.

4- Ingrese los siguientes registros:
 1,El aleph,Borges,Planeta;
 2,Martin Fierro,Jose Hernandez,Emece;
 3,Aprenda PHP,Mario Molina,Emece;
 4,Cervantes y el quijote,Borges,Paidos;
 5,Matematica estas ahi, Paenza, Paidos;

5- Seleccione todos los registros.

6- Ingrese un registro con código no repetido y nombre de autor repetido.

7- Ingrese un registro con código no repetido y título y editorial repetidos.

8- Intente ingresar un registro que repita el campo clave. ¿Que pasa?

Ejercicio G
-----------

Una farmacia guarda información referente a sus medicamentos en una tabla 
llamada "medicamentos".

1- Elimine la tabla,si existe.

2- Cree la tabla con la siguiente estructura:

  codigo integer auto_increment, primary key
  nombre varchar(20),
  laboratorio varchar(20),
  precio float,
  cantidad integer

3- Visualice la estructura de la tabla "medicamentos" .

4- Ingrese los siguientes registros
:
'Sertal','Roche',5.2,100
'Buscapina','Roche',4.10,200
 'Amoxidal 500','Bayer',15.60,100

5- Verifique que el campo "código" generó los valores de modo automático


6- Intente ingresar un registro con un valor de clave primaria repetido.

7- Ingrese un registro con un valor de clave primaria no repetido salteando la secuencia:

8- Ingrese un nuevo registro, ¿Qué sucede con la secuencia?