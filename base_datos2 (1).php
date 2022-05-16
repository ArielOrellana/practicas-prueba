<?php
##################################
## Cláusula order by del select
##################################

## Se usa para que los registros se muestren ordenados por algún campo.
//Ej: Recuperamos los registros de la tabla "libros" ordenados por el título:

select codigo,titulo,autor,editorial,precio 
from libros 
order by titulo;

//Aparecen los registros ordenados alfabéticamente por el campo especificado.


## También podemos colocar el número de orden del campo por el que queremos que se ordene en lugar de su nombre. 
//Por ejemplo, queremos el resultado del "select" ordenado por "precio":

select codigo,titulo,autor,editorial,precio 
from libros 
order by 5;

## Si no aclaramos en la sentencia, los ordena de manera ascendente (de menor a mayor). Podemos ordenarlos de mayor a menor, para ello agregamos la palabra clave "desc":

select codigo,titulo,autor,editorial,precio 
from libros 
order by editorial desc;

## También podemos ordenar por varios campos, por ejemplo, por "titulo" y "editorial":

select codigo,titulo,autor,editorial,precio 
from libros 
order by titulo, editorial;

## Incluso, podemos ordenar en distintos sentidos, por ejemplo, por "titulo" en sentido ascendente y "editorial" en sentido descendente:
//Debe aclararse al lado de cada campo, pues estas palabras claves afectan al campo inmediatamente anterior.

select codigo,titulo,autor,editorial,precio 
from libros 
order by titulo asc, editorial desc;

/*
//Para trabajar:

create table libros(
  codigo int unsigned auto_increment,
  titulo varchar(40),
  autor varchar(30),
  editorial varchar(15),
  precio decimal (5,2) unsigned,
  primary key (codigo)
 );

insert into libros (titulo,autor,editorial,precio)
  values('El aleph','Borges','Planeta',15.50);
insert into libros (titulo,autor,editorial,precio)
  values('Martin Fierro','Jose Hernandez','Emece',22.90);
insert into libros (titulo,autor,editorial,precio)
  values('Martin Fierro','Jose Hernandez','Planeta',39);
insert into libros (titulo,autor,editorial,precio)
  values('Aprenda PHP','Mario Molina','Emece',19.50);
insert into libros (titulo,autor,editorial,precio)
  values('Cervantes y el quijote','Borges','Paidos',35.40);
insert into libros (titulo,autor,editorial,precio)
  values('Matematica estas ahi', 'Paenza', 'Paidos',19);
*/

##########################################
## Búsqueda de patrones (like y not like)  
##########################################

## Para comparar porciones de cadenas utilizamos los operadores "like" y "not like".
//Ejemplo: Para recuperar todos los registros cuyo autor contenga la cadena "Borges" debemos tipear:

select * from libros
where autor like "%Borges%";

//El símbolo "%" (porcentaje) reemplaza cualquier cantidad de caracteres (incluyendo ningún caracter). Es un caracter comodín. "like" y "not like" son operadores de comparación que señalan igualdad o diferencia.

## Para seleccionar todos los libros que comiencen con "A":

select * from libros
where titulo like 'A%';

//Note que el símbolo "%" ya no está al comienzo, con esto indicamos que el título debe tener como primera letra la "A" y luego, cualquier cantidad de caracteres.

## Para seleccionar todos los libros que no comiencen con "A":

select * from libros
where titulo not like 'A%';

## Así como "%" reemplaza cualquier cantidad de caracteres, el guión bajo "_" reemplaza un caracter, es el otro caracter comodín. Por ejemplo, queremos ver los libros de "Lewis Carroll" pero no recordamos si se escribe "Carroll" o "Carrolt", entonces tipeamos esta condición:

select * from libros
where autor like "%Carrol_";

## Si necesitamos buscar un patrón en el que aparezcan los caracteres comodines, por ejemplo, queremos ver todos los registros que comiencen con un guión bajo, si utilizamos '_%', mostrará todos los registros porque lo interpreta como "patrón que comienza con un caracter cualquiera y sigue con cualquier cantidad de caracteres". Debemos utilizar "\_%", esto se interpreta como 'patrón que comienza con guión bajo y continúa con cualquier cantidad de caracteres". Es decir, si queremos incluir en una búsqueda de patrones los caracteres comodines, debemos anteponer al caracter comodín, la barra invertida "\", así lo tomará como caracter de búsqueda literal y no como comodín para la búsqueda. Para buscar el caracter literal "%" se debe colocar "\%".

/*
insert into libros (titulo,autor,editorial,precio)
  values('El aleph','Borges','Planeta',15.50);
insert into libros (titulo,autor,editorial,precio)
  values('Martin Fierro','Jose Hernandez','Emece',22.90);
insert into libros (titulo,autor,editorial,precio)
  values('Antologia poetica','J.L. Borges','Planeta',39);
insert into libros (titulo,autor,editorial,precio)
  values('Aprenda PHP','Mario Molina','Emece',19.50);
insert into libros (titulo,autor,editorial,precio)
  values('Cervantes y el quijote','Bioy Casare- J.L. Borges','Paidos',35.40);
insert into libros (titulo,autor,editorial,precio)
  values('Manual de PHP', 'J.C. Paez', 'Paidos',19);
insert into libros (titulo,autor,editorial,precio)
  values('Harry Potter y la piedra filosofal','J.K. Rowling','Paidos',45.00);
insert into libros (titulo,autor,editorial,precio)
  values('Harry Potter y la camara secreta','J.K. Rowling','Paidos',46.00);
insert into libros (titulo,autor,editorial,precio)
  values('Alicia en el pais de las maravillas','Lewis Carroll','Paidos',36.00);
*/

#############################
## Contar registros (count)
#############################

## La función "count()" cuenta la cantidad de registros de una tabla, incluyendo los que tienen valor nulo.
## Tenga en cuenta que no debe haber espacio entre el nombre de la función y el paréntesis

select count(*) 
from libros;

//Ejemplo: Para saber la cantidad de libros de la editorial "Planeta" tipeamos:

select count(*) from libros
where editorial='Planeta';

//También podemos utilizar esta función junto con la clausula "where" para una consulta más específica. Por ejemplo, solicitamos la cantidad de libros que contienen la cadena "Borges":

select count(*) from libros
where autor like '%Borges%';

##Para contar los registros que tienen precio (sin tener en cuenta los que tienen valor nulo), usamos la función "count()" y en los paréntesis colocamos el nombre del campo que necesitamos contar:

select count(precio) 
from libros;

## Note que "count(*)" retorna la cantidad de registros de una tabla (incluyendo los que tienen valor "null") mientras que "count(precio)" retorna la cantidad de registros en los cuales el campo "precio" no es nulo. 
## No es lo mismo. "count(*)" cuenta registros, si en lugar de un asterisco colocamos como argumento el nombre de un campo, se contabilizan los registros cuyo valor en ese campo no es nulo.

##############################################################
##  Funciones de agrupamiento (count - max - min - sum - avg)
##############################################################

## La función "sum()" retorna la suma de los valores que contiene el campo especificado. 
//Por ejemplo, queremos saber la cantidad de libros que tenemos disponibles para la venta:

select sum(cantidad) 
from libros;

## También podemos combinarla con "where". 
//Por ejemplo, queremos saber cuántos libros tenemos de la editorial "Planeta":

select sum(cantidad) from libros
where editorial ='Planeta';

## Para averiguar el valor máximo o mínimo de un campo usamos las funciones "max()" y "min()" respectivamente. 
//Ejemplo, queremos saber cuál es el mayor precio de todos los libros:

select max(precio) 
from libros;

//Queremos saber cuál es el valor mínimo de los libros de "Rowling":

select min(precio) 
from libros
where autor like '%Rowling%';

## La función avg() retorna el valor promedio de los valores del campo especificado. 
//Por ejemplo, queremos saber el promedio del precio de los libros referentes a "PHP":

select avg(precio) 
from libros
where titulo like '%PHP%';

############################### 
## Agrupar registros (group by)
###############################

## La sentencia "group by", se utiliza para agrupar registros para consultas detalladas.

//Ejemplo: Queremos saber la cantidad de visitantes de cada ciudad, podemos tipear la siguiente sentencia:

select ciudad, count(*)
from visitantes
group by ciudad;

//Entonces, para saber la cantidad de visitantes que tenemos en cada ciudad utilizamos la función "count()", agregamos "group by" y el campo por el que deseamos que se realice el agrupamiento, también colocamos el nombre del campo a recuperar.

## Para obtener la cantidad visitantes con teléfono no nulo, de cada ciudad utilizamos la función "count()" enviándole como argumento el campo "telefono", agregamos "group by" y el campo por el que deseamos que se realice el agrupamiento (ciudad):

select ciudad, count(telefono)
from visitantes
group by ciudad;

/*
Como resultado aparecen los nombres de las ciudades y la cantidad de registros de cada una, sin contar los que tienen teléfono nulo. Recuerde la diferencia de los valores que retorna la función "count()" cuando enviamos como argumento un asterisco o el nombre de un campo: en el primer caso cuenta todos los registros incluyendo los que tienen valor nulo, en el segundo, los registros en los cuales el campo especificado es no nulo.
*/
## Para conocer el total de las compras agrupadas por sexo:

select sexo, sum(montocompra)
from visitantes
group by sexo;

## Para saber el máximo y mínimo valor de compra agrupados por sexo:

select sexo, max(montocompra) 
from visitantes
group by sexo;


select sexo, min(montocompra) 
from visitantes
group by sexo;


## Se pueden simplificar las 2 sentencias anteriores en una sola sentencia, ya que usan el mismo "group by":

select sexo, max(montocompra), min(montocompra)
from visitantes
group by sexo;

##Para calcular el promedio del valor de compra agrupados por ciudad:

select ciudad, avg(montocompra) 
from visitantes
group by ciudad;

## Podemos agrupar por más de un campo, por ejemplo, vamos a hacerlo por "ciudad" y "sexo":

select ciudad, sexo, count(*) 
from visitantes
group by ciudad,sexo;

## También es posible limitar la consulta con "where".

## Vamos a contar y agrupar por ciudad sin tener en cuenta "Cordoba":

select ciudad, count(*) from visitantes
where ciudad<>'Cordoba'
group by ciudad;


## Podemos usar las palabras claves "asc" y "desc" para una salida ordenada:

select ciudad, count(*) 
from visitantes
group by ciudad desc;


/*
Para trabajar:

create table visitantes(
  nombre varchar(30),
  edad tinyint unsigned,
  sexo char(1),
  domicilio varchar(30),
  ciudad varchar(20),
  telefono varchar(11),
  montocompra decimal (6,2) unsigned
 );

insert into visitantes (nombre,edad, sexo,domicilio,ciudad,telefono,montocompra)
  values ('Susana Molina', 28,'f','Colon 123','Cordoba',null,45.50); 
insert into visitantes (nombre,edad, sexo,domicilio,ciudad,telefono,montocompra)
  values ('Marcela Mercado',36,'f','Avellaneda 345','Cordoba','4545454',0);
insert into visitantes (nombre,edad, sexo,domicilio,ciudad,telefono,montocompra)
  values ('Alberto Garcia',35,'m','Gral. Paz 123','Alta Gracia','03547123456',25); 
insert into visitantes (nombre,edad, sexo,domicilio,ciudad,telefono,montocompra)
  values ('Teresa Garcia',33,'f','Gral. Paz 123','Alta Gracia','03547123456',0);
insert into visitantes (nombre,edad, sexo,domicilio,ciudad,telefono,montocompra)
  values ('Roberto Perez',45,'m','Urquiza 335','Cordoba','4123456',33.20);
insert into visitantes (nombre,edad, sexo,domicilio,ciudad,telefono,montocompra)
  values ('Marina Torres',22,'f','Colon 222','Villa Dolores','03544112233',25);
insert into visitantes (nombre,edad, sexo,domicilio,ciudad,telefono,montocompra)
  values ('Julieta Gomez',24,'f','San Martin 333','Alta Gracia','03547121212',53.50);
insert into visitantes (nombre,edad, sexo,domicilio,ciudad,telefono,montocompra)
  values ('Roxana Lopez',20,'f','Triunvirato 345','Alta Gracia',null,0);
insert into visitantes (nombre,edad, sexo,domicilio,ciudad,telefono,montocompra)
  values ('Liliana Garcia',50,'f','Paso 999','Cordoba','4588778',48);
insert into visitantes (nombre,edad, sexo,domicilio,ciudad,telefono,montocompra)
  values ('Juan Torres',43,'m','Sarmiento 876','Cordoba','4988778',15.30);


*/

##############################
## Alias 
##############################

## Un "alias" se usa como nombre de un campo o de una expresión o para referenciar una tabla cuando se utilizan más de una tabla (tema que veremos más adelante).

//Ejemplo, Cuando usamos una función de agrupamiento la columna en la salida tiene como encabezado "count(*)", para que el resultado sea más claro podemos utilizar un alias:
 
select count(*) as librosdeborges
from libros
where autor like '%Borges%';

## Un alias puede tener hasta 255 caracteres, acepta todos los caracteres. 
## La palabra clave "as" es opcional en algunos casos, pero es conveniente usarla. 
## Si el alias consta de una sola cadena las comillas no son necesarias, 
## pero si contiene más de una palabra, es necesario colocarla entre comillas.

## Se pueden utilizar alias en las clásulas "group by", "order by". Por ejemplo:

select editorial as 'Nombre de editorial'
from libros
group by 'Nombre de editorial';
 
select editorial, count(*) as cantidad
from libros
group by editorial
order by cantidad;

## No está permitido utilizar alias de campos en las cláusulas "where".

#####################
## Clave foránea.
#####################

## Un campo que se usa para establecer un "join" (unión) con otra tabla en la cual es clave primaria, se denomina "clave ajena o foránea".

// En el ejemplo de la librería en que utilizamos las tablas "libros" y "editoriales" con los campos:

libros: codigo (clave primaria), titulo, autor, codigoeditorial, precio, cantidad.

editoriales: codigo (clave primaria), nombre.

## el campo "codigoeditorial" de "libros" es una clave foránea, se emplea para enlazar la tabla "libros" con "editoriales" y es clave primaria en "editoriales" con el nombre "codigo".

##Cuando alteramos una tabla, debemos tener cuidado con las claves foráneas. Si modificamos el tipo, longitud o atributos de una clave foránea, ésta puede quedar inhabilitada para hacer los enlaces.

##Las claves foráneas y las claves primarias deben ser del mismo tipo para poder enlazarse. Si modificamos una, debemos modificar la otra para que los valores se correspondan.

/*
Para trabajar:

create table libros(
  codigo int unsigned auto_increment,
  titulo varchar(40) not null,
  autor varchar(30) not null default 'Desconocido',
  codigoeditorial tinyint unsigned not null,
  precio decimal(5,2) unsigned,
  cantidad smallint unsigned default 0,
  primary key (codigo)
 );

create table editoriales(
  codigo tinyint unsigned auto_increment,
  nombre varchar(20) not null,
  primary key(codigo)
 );

insert into editoriales values(2,'Emece');
insert into editoriales values(15,'Planeta');
insert into editoriales values(23,'Paidos');

insert into libros values(1,'El aleph','Borges',23,4.55,10);
insert into libros values(2,'Alicia en el pais de las maravillas','Lewis Carroll',2,11.55,2);
insert into libros values(3,'Martin Fierro','Jose Hernandez',15,7.12,4);
*/ 

######################## 
## Varias tablas (join)
########################

//Los datos de nuestra tabla "libros" podrían separarse en 2 tablas, una "libros" y otra "editoriales" que guardará la información de las editoriales.
//En nuestra tabla "libros" haremos referencia a la editorial colocando un código que la identifique.

 create table libros(
  codigo int unsigned auto_increment,
  titulo varchar(40) not null,
  autor varchar(30) not null default 'Desconocido',
  codigoeditorial tinyint unsigned not null,
  precio decimal(5,2) unsigned,
  cantidad smallint unsigned default 0,
  primary key (codigo)
 );

 create table editoriales(
  codigo tinyint unsigned auto_increment,
  nombre varchar(20) not null,
  primary key(codigo)
 );

## De este modo, evitamos almacenar tantas veces los nombres de las editoriales en la tabla "libros" y guardamos el nombre en la tabla "editoriales"; para indicar la editorial de cada libro agregamos un campo referente al código de la editorial en la tabla "libros" y en "editoriales".

select * 
from libros;

## Vemos que en el campo "editorial" aparece el código, pero no sabemos el nombre de la editorial. 
## Para obtener los datos de cada libro, incluyendo el nombre de la editorial, necesitamos consultar ambas tablas, traer información de las dos.

## Cuando obtenemos información de más de una tabla decimos que hacemos un "join" (unión):

select * from libros
join editoriales
on libros.codigoeditorial=editoriales.codigo;


##Analicemos la consulta anterior.
## Indicamos el nombre de la tabla luego del "from" ("libros"), unimos esa tabla con "join" y el nombre de la otra tabla ("editoriales"), 
## luego especificamos la condición para enlazarlas con "on", es decir, el campo por el cual se combinarán. "on" hace coincidir registros de las dos tablas basándose en el valor de algún campo, en este ejemplo, los códigos de las editoriales de ambas tablas, el campo "codigoeditorial" de "libros" y el campo "codigo" de "editoriales" son los que enlazarán ambas tablas.

## Cuando se combina (join, unión) información de varias tablas, es necesario indicar qué registro de una tabla se combinará con qué registro de la otra tabla.


select * from libros
join editoriales on libros.codigoeditorial=editoriales.codigo;


//si en las tablas, los campos tienen el mismo nombre, debemos especificar a cuál tabla pertenece el campo al hacer referencia a él, para ello se antepone el nombre de la tabla al nombre del campo, separado por un punto (.).

## Se nombra la primer tabla, se coloca "join" junto al nombre de la segunda tabla de la cual obtendremos información y se asocian los registros de ambas tablas usando un "on" que haga coincidir los valores de un campo en común en ambas tablas, que será el enlace.

## Para simplificar la sentencia podemos usar un alias para cada tabla:

select * from libros as l
join editoriales as e
on l.codigoeditorial=e.codigo;

#############
## left join
#############

## Para averiguar qué registros de una tabla no se encuentran en otra tabla necesitamos usar un "join" diferente.
## Necesitamos determinar qué registros no tienen correspondencia en otra tabla, cuáles valores de la primera tabla (de la izquierda) no están en la segunda (de la derecha).

//Para obtener la lista de editoriales y sus libros, incluso de aquellas editoriales de las cuales no tenemos libros usamos:

select * from editoriales
left join libros
on editoriales.codigo=libros.codigoeditorial;

##Un "left join" se usa para hacer coincidir registros en una tabla (izquierda) con otra tabla (derecha), pero, si un valor de la tabla de la izquierda no encuentra coincidencia en la tabla de la derecha, se genera una fila extra (una por cada valor no encontrado) con todos los campos seteados a "null".

/*Entonces, la sintaxis es la siguiente: se nombran ambas tablas, una a la izquierda del "join" y la otra a la derecha, y la condición para enlazarlas, es decir, el campo por el cual se combinarán, se establece luego de "on". Es importante la posición en que se colocan las tablas en un "left join", la tabla de la izquierda es la que se usa para localizar registros en la tabla de la derecha. Por lo tanto, estos "join" no son iguales:
*/

//La primera sentencia opera así: por cada valor de codigo de "editoriales" busca coincidencia en la tabla "libros", si no encuentra coincidencia para algún valor, genera una fila seteada a "null".
select * from editoriales
left join libros
on editoriales.codigo=libros.codigoeditorial;
 
//La segunda sentencia opera de modo inverso: por cada valor de "codigoeditorial" de "libros" busca coincidencia en la tabla "editoriales", si no encuentra coincidencia, setea la fila a "null". 
select * from libros
left join editoriales
on editoriales.codigo=libros.codigoeditorial;


//Muestra los valores de la tabla "editoriales" que están presentes en la tabla de la derecha ("libros").
select e.nombre,l.titulo
from editoriales as e
left join libros as l
on e.codigo=l.codigoeditorial
where l.codigoeditorial is not null;


//También podemos mostrar las editoriales que no están presentes en "libros":
select e.nombre,l.titulo 
from editoriales as e
left join libros as l
on e.codigo=l.codigoeditorial
where l.codigoeditorial is null;

########################
## right join
########################

## "right join" opera del mismo modo que "left join" sólo que la búsqueda de coincidencias la realiza de modo inverso, es decir, los roles de las tablas se invierten, busca coincidencia de valores desde la tabla de la derecha en la tabla de la izquierda y si un valor de la tabla de la derecha no encuentra coincidencia en la tabla de la izquierda, se genera una fila extra (una por cada valor no encontrado) con todos los campos seteados a "null".

//Trabajamos con las tablas de una librería:

-libros: codigo (clave primaria), titulo, autor, codigoeditorial, precio, cantidad y
-editoriales: codigo (clave primaria), nombre.

Estas sentencias devuelven el mismo resultado:

select nombre,titulo
from editoriales as e
left join libros as l
on e.codigo=l.codigoeditorial;

select nombre,titulo
from libros as l
right join editoriales as e
on e.codigo=l.codigoeditorial;


//La primera busca valores de "codigo" de la tabla "editoriales" (tabla de la izquierda) coincidentes con los valores de "codigoeditorial" de la tabla "libros" (tabla de la derecha). La segunda busca valores de la tabla de la derecha coincidentes con los valores de la tabla de la izquierda.

#######################
## inner join 
#######################

## "inner join" es igual que "join". Con "inner join", todos los registros no coincidentes son descartados, sólo los coincidentes se muestran en el resultado:

Select nombre,titulo
from editoriales as e
inner join libros as l
on e.codigo=l.codigoeditorial;

Tiene la misma salida que un simple "join":

select nombre,titulo
from editoriales as e
join libros as l
on e.codigo=l.codigoeditorial;

#####################
## Tarea
#####################


Ejercicio 1
-----------
Averiguar y ejercitar:  

* Operadores Lógicos (and - or - not)  
* Selección de un grupo de registros (having)
* Registros duplicados (distinct)
* Cláusula limit del comando select.


Ejercicio 2
-----------

Datos para trabajar: 

Créelas con las siguientes estructuras:

 create table clientes (
  codigo int unsigned auto_increment,
  nombre varchar(30) not null,
  domicilio varchar(30),
  ciudad varchar(20),
  codigoProvincia tinyint unsigned,
  telefono varchar(11),
  primary key(codigo)
 );

 create table provincias(
  codigo tinyint unsigned auto_increment,
  nombre varchar(20),
  primary key (codigo)
 );

3- Ingrese algunos registros para ambas tablas:

 insert into provincias (nombre) values('Cordoba');
 insert into provincias (nombre) values('Santa Fe');
 insert into provincias (nombre) values('Corrientes');
 insert into provincias (nombre) values('Misiones');
 insert into provincias (nombre) values('Salta');
 insert into provincias (nombre) values('Buenos Aires');
 insert into provincias (nombre) values('Neuquen');

 insert into clientes (nombre,domicilio,ciudad,codigoProvincia,telefono)
  values ('Lopez Marcos', 'Colon 111', 'Córdoba',1,'null');
 insert into clientes (nombre,domicilio,ciudad,codigoProvincia,telefono)
  values ('Perez Ana', 'San Martin 222', 'Cruz del Eje',1,'4578585');
 insert into clientes (nombre,domicilio,ciudad,codigoProvincia,telefono)
  values ('Garcia Juan', 'Rivadavia 333', 'Villa Maria',1,'4578445');
 insert into clientes (nombre,domicilio,ciudad,codigoProvincia,telefono)
  values ('Perez Luis', 'Sarmiento 444', 'Rosario',2,null);
 insert into clientes (nombre,domicilio,ciudad,codigoProvincia,telefono)
  values ('Pereyra Lucas', 'San Martin 555', 'Cruz del Eje',1,'4253685');
 insert into clientes (nombre,domicilio,ciudad,codigoProvincia,telefono)
  values ('Gomez Ines', 'San Martin 666', 'Santa Fe',2,'0345252525');
 insert into clientes (nombre,domicilio,ciudad,codigoProvincia,telefono)
  values ('Torres Fabiola', 'Alem 777', 'Villa del Rosario',1,'4554455');
 insert into clientes (nombre,domicilio,ciudad,codigoProvincia,telefono)
  values ('Lopez Carlos', 'Irigoyen 888', 'Cruz del Eje',1,null);
 insert into clientes (nombre,domicilio,ciudad,codigoProvincia,telefono)
  values ('Ramos Betina', 'San Martin 999', 'Cordoba',1,'4223366');
 insert into clientes (nombre,domicilio,ciudad,codigoProvincia,telefono)
  values ('Lopez Lucas', 'San Martin 1010', 'Posadas',4,'0457858745');


A- Queremos saber de qué provincias no tenemos clientes.

B- Queremos saber de qué provincias si tenemos clientes, sin repetir el nombre de la provincia.

C- Omita la referencia a las tablas en la condición "on" para verificar que la sentencia no se 
ejecuta porque el nombre del campo "codigo" es ambiguo (ambas tablas lo tienen).

D- Obtenga los datos de ambas tablas, use alias.

E- Obtenga la misma información anterior pero ordenada por nombre del cliente.

F- Realice "left join" de la tabla "clientes" a "provincias" buscando coincidencia de "provincia"

G- Realice "right join" para obtener la misma salida anterior




