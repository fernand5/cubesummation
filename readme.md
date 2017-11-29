Cube Summation usando Laravel framework 5.4 con arboles fenwick

# CODING CHALLENGE
- Problema: https://www.hackerrank.com/challenges/cube-summation

## Install
- Clonar reposotorio
- Instalar dependencias ```composer install```
- Generar clave de seguridad ```php artisan key:generate```
- Correr servidor ```php artisan serve```

## PHP-unit tests
- Correr el comando ```./vendor/bin/phpunit```

## Ejemplo de entrada
```
2
4 5
UPDATE 2 2 2 4
QUERY 1 1 1 3 3 3
UPDATE 1 1 1 23
QUERY 2 2 2 4 4 4
QUERY 1 1 1 3 3 3
2 4
UPDATE 2 2 2 1
QUERY 1 1 1 1 1 1
QUERY 1 1 1 2 2 2
QUERY 2 2 2 2 2 2
```

## Ejemplo de salida
```
4
4
27
0
1
1
```

## Capas de la aplicacion
- Capa de presentación o vista: Recopila la información del usuario o cliente y la envía al servidor. Recibe los resultados de la capa de proceso y los muestra al cliente.En el proyecto, la función de esta capa es cubierta por los archivos de la carpeta “resources” ya que Aquí se guardan los archivos de vistas. Es decir, acá está el Frontend de la aplicación.

- Capa de aplicación o de proceso: Recibe la entrada de datos de la capa de presentación o vista, además se encarga de interactuar con la capa de datos para realizar operaciones, y finalmente manda los resultados procesados a la capa de presentación.En el proyecto, la función de la capa de proceso es cubierta por los archivos dentro de la carpeta “app” más específicamente por el archivo CubeController.php ya que en estos dos archivos es en donde se centra la logística de la aplicación y el control  de datos para ser entregados a la capa de presentación.

- Capa de persistencia o de datos: Almacena y recupera los datos de la aplicación. En el proyecto no existe ninguna base datos que almacena todos los datos, sin embargo la clase contenida en Cube.php realiza el trabajo de almacenar los datos de un arreglo 3D.

## La responsabilidad de cada clase creada
- Clase CubeController: En esta clase lleva a cabo la funcionalidad principal del ejercicio, ya que la misma posee un método (calculate) que recibe un request POST con los parametros N, M y las sentencias del test-case

- Clase Cube: En esta clase se representa la estructura de una matriz 3D que representa cada cubo como un objeto. Esta clase almacena los atributos N, M, y la matriz. Posee los métodos setValuePosition que corresponde a la aplicación de la operación “UPDATE” en el ejercicio; y el método getQuery que corresponde a la operación “QUERY” del ejercicio.

- Clase CalculateTest: Prueba PHPunit que verifica los métodos de la clase Cube.
