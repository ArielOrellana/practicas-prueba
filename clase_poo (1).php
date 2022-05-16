<?php

###########################
## Inicio 
##########################

/*
Una clase es un molde del que luego se pueden crear múltiples objetos, 
con similares características.

Una clase es una plantilla (molde), que define atributos (lo que conocemos como variables)
y métodos (lo que conocemos como funciones).

La clase define los atributos y métodos comunes a los objetos de ese tipo, 
pero luego, cada objeto tendrá sus propios valores y compartirán las mismas funciones.

Debemos crear una clase antes de poder crear objetos (instancias) de esa clase. 
Al crear un objeto de una clase, se dice que se crea una instancia de la clase o un
 objeto propiamente dicho.
*/


class Persona {

  // Atributos (variables)
  // Los atributos normalmente son privados (private), 
  private $nombre; 

  //métodos (funciones)
  public function inicializar($nom)
  {
    $this->nombre=$nom;
  }
  public function imprimir()
  {
    echo $this->nombre;
    echo '<br>';
  }
}

// instancia de una clase (Se crea un objeto)
$per1=new Persona();
$per1->inicializar('Juan');
$per1->imprimir();

// instancia de una clase (Se crea un objeto)
$per2=new Persona();
$per2->inicializar('Ana');
$per2->imprimir();


############################
## Atributos
###########################

/*
Los atributos son las características, cualidades,
propiedades distintivas de cada clase.
Contienen información sobre el objeto. 
Determinan la apariencia, estado y demás particularidades de la clase.
Varios objetos de una misma clase tendrán los mismos atributos pero con valores diferentes.
*/
class Menu {
  //Atributos
  private $enlaces=array();
  private $titulos=array();

  //Métodos
  public function cargarOpcion($en,$tit)
  {
    $this->enlaces[]=$en;
    $this->titulos[]=$tit;
  }
  public function mostrar()
  {
    for($f=0;$f<count($this->enlaces);$f++)
    {
      echo '<a href="'.$this->enlaces[$f].'">'.$this->titulos[$f].'</a>';
      echo "-";
    }
  }
}

$menu1=new Menu();
$menu1->cargarOpcion('http://www.google.com','Google');
$menu1->cargarOpcion('http://www.instagram.com','Instagram');
$menu1->cargarOpcion('http://www.msn.com','MSN');
$menu1->mostrar();


################
## Métodos
###############

/*
Los métodos también son llamados las responsabilidades de la clase. 
Para encontrar las responsabilidades de una clase hay que preguntarse qué puede hacer la clase.

El objetivo de un método es ejecutar las actividades que tiene encomendada 
la clase a la cual pertenece.

Los atributos de un objeto se modifican mediante llamadas a sus métodos.
*/
class CabeceraPagina {
  private $titulo;
  private $ubicacion;
  public function inicializar($tit,$ubi)
  {
    $this->titulo=$tit;
    $this->ubicacion=$ubi;
  }
  public function graficar()
  {
    echo '<div style="font-size:40px;text-align:'.$this->ubicacion.'">';
    echo $this->titulo;
    echo '</div>';
  }
}

$cabecera=new CabeceraPagina();
$cabecera->inicializar('Cabecera de página','center');
$cabecera->graficar();

########################
## Constructor  (agregado)
#######################


/*
El constructor es un método especial de una clase. El objetivo fundamental del constructor 
es inicializar los atributos del objeto que creamos.

Básicamente el constructor remplaza al método inicializar que habíamos hecho en el 
concepto anterior.

Las ventajas de implementar un constructor en lugar del método inicializar son:

El constructor es el primer método que se ejecuta cuando se crea un objeto.
El constructor se llama automáticamente. Es decir es imposible de olvidarse llamarlo
ya que se llamará automáticamente.
Quien utiliza POO (Programación Orientada a Objetos) conoce el objetivo de este método.
Otras características de los constructores son:

* El constructor se ejecuta inmediatamente luego de crear un objeto y no puede ser llamado 
nuevamente.
* Un constructor no puede retornar dato.
* Un constructor puede recibir parámetros que se utilizan normalmente para inicializar atributos.
* El constructor es un método opcional, de todos modos es muy común definirlo.

Veamos la sintaxis del constructor:

  public function __construct([parámetros])
  {
    [algoritmo]
  }
*/
class CabeceraPagina {
  private $titulo;
  private $ubicacion;
  public function __construct($tit,$ubi)
  {
    $this->titulo=$tit;
    $this->ubicacion=$ubi;
  }
  public function graficar()
  {
    echo '<div style="font-size:40px;text-align:'.$this->ubicacion.'">';
    echo $this->titulo;
    echo '</div>';
  }
}

$cabecera=new CabeceraPagina('Nuestra cabecera','center');
$cabecera->graficar();

################################################
## llamada método dentro de una clase (agregado)
################################################

/*
Si queremos llamar dentro de la clase a otro método que pertenece a la misma clase, la sintaxis es la siguiente:

$this->[nombre del método]
Es importante tener en cuenta que esto solo se puede hacer cuando estamos dentro de la misma clase.
*/

class Tabla {
  private $mat=array();
  private $cantFilas;
  private $cantColumnas;

  public function __construct($fi,$co)
  {
    $this->cantFilas=$fi;
    $this->cantColumnas=$co;
  }

  public function cargar($fila,$columna,$valor)
  {
    $this->mat[$fila][$columna]=$valor;
  }

  public function inicioTabla()
  {
    echo '<table border="1">';
  }
    
  public function inicioFila()
  {
    echo '<tr>';
  }

  public function mostrar($fi,$co)
  {
    echo '<td>'.$this->mat[$fi][$co].'</td>';
  }

  public function finFila()
  {
    echo '</tr>';
  }

  public function finTabla()
  {
    echo '</table>';
  }

  public function graficar()
  {
    $this->inicioTabla();
    for($f=1;$f<=$this->cantFilas;$f++)
    {
      $this->inicioFila();
      for($c=1;$c<=$this->cantColumnas;$c++)
      {
        $this->mostrar($f,$c);
      }
      $this->finFila();
    }
    $this->finTabla();
  }
}

$tabla1=new Tabla(2,3);
$tabla1->cargar(1,1,"1");
$tabla1->cargar(1,2,"2");
$tabla1->cargar(1,3,"3");
$tabla1->cargar(2,1,"4");
$tabla1->cargar(2,2,"5");
$tabla1->cargar(2,3,"6");
$tabla1->graficar();


##########################
## Herencia
##########################

//La herencia significa que se pueden crear nuevas clases partiendo de clases existentes, 
//que tendrá todas los atributos y los métodos de su 'superclase' o 'clase padre' 
//y además se le podrán añadir otros atributos y métodos propios.

/*
Ahora plantearemos el primer problema utilizando herencia en PHP. 
Supongamos que necesitamos implementar dos clases que llamaremos Suma y Resta. 
Cada clase tiene como atributo $valor1, $valor2 y $resultado.
 Los métodos a definir son:
 * cargar1 (que inicializa el atributo $valor1), 
 * carga2 (que inicializa el atributo $valor2), 
 * operar (que en el caso de la clase "Suma" suma los dos atributos 
 y en el caso de la clase "Resta" hace la diferencia entre $valor1 y $valor2, 
 y otro método mostrarResultado.
Si analizamos ambas clases encontramos que muchos atributos y métodos son idénticos.
 En estos casos es bueno definir una clase padre que agrupe dichos atributos y 
 responsabilidades comunes.

Solamente el método operar es distinto para las clases Suma y Resta 
(esto hace que no lo podamos disponer en la clase Operacion), 
luego los métodos cargar1, cargar2 y mostrarResultado son idénticos a las dos clases, 
esto hace que podamos disponerlos en la clase Operacion. Lo mismo los atributos $valor1, $valor2 y $resultado 
se definirán en la clase padre Operacion.


*/

class Operacion {
  protected $valor1;
  protected $valor2;
  protected $resultado;
  public function cargar1($v)
  {
    $this->valor1=$v;
  }
  public function cargar2($v)
  {
    $this->valor2=$v;
  }
  public function imprimirResultado()
  {
    echo $this->resultado.'<br>';
  }
}

class Suma extends Operacion{
  public function operar()
  {
    $this->resultado=$this->valor1+$this->valor2; 
  }
}

class Resta extends Operacion{
  public function operar()
  {
    $this->resultado=$this->valor1-$this->valor2;
  }
}

$suma=new Suma();
$suma->cargar1(10);
$suma->cargar2(10);
$suma->operar();
echo 'El resultado de la suma de 10+10 es:';
$suma->imprimirResultado();

$resta=new Resta();
$resta->cargar1(10);
$resta->cargar2(5);
$resta->operar();
echo 'El resultado de la diferencia de 10-5 es:';
$resta->imprimirResultado();
