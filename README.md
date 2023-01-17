### MercaCali ###

## Instalar nuestro aplicativo ##

* Clonamos el repositorio en nuestro equipo mediante el comando git clone https://github.com/jorge-egg/TiendaCanastaFamiliar.git

* Para instalar el aplicativo debemos contar con NodeJs y Composer previamente instalados en nuestro Equipo

* Una vez en nuestra carpeta del proyecto, abrimos una ventana de comandos en la raiz de nuesto aplicativo y ejecutamos los siguientes comandos

* npm install esto para instalar todos los modulos y dependencias de nuestro aplicativo.

* Posteriormente ejecutamos el comando Composer install para instalar los servicios del FrameWork

* Una ves configurado esto, configuramos nuestra base de datos, *OJO MUY IMPORTANTE* dentro de nuestro File System, en nuestra carpeta Database encontramos la Base de datos con todos los productos agregados, con sus respectivas imagenes, Es importante Importar esa base de datos dentro de nuestro motor de base de datos en mi caso utilice Xampp Pasos para Crear bd

*-1 Vamos a nuestro Localhost y en las bases de datos creamos una nueva ingresamos el nombre tiendacanastaflia, una vez creada buscamos donde dice Importar y seleccionamos el archivo tiendacanastaflia.sql


## Ejecutar nuestro Aplicativo ##

Una vez lista la instalación de nuestro aplicativo, vamos a abrir nuestra consola de comandos y ejecutamos Php artisan serve esto lanzará nuestro Aplicativo de forma virtual, en otra consola ejecutamos npm run dev y ya podrán visualizar todo el contenido, esto estará corriendo en el puerto 8000, es decir Localhost:8000

Para iniciar seccion con el usuario de rol 'Gerente' se usa la cuenta 'admin@gmail.com' con contraseña '123456789'.
En esta cuenta se podra visualizar los usuarios que son supervisores y clientes, la contraseña de cada usuarios es las misma que la del gerente.
## Contenido del aplicativo ##

Se entrega aplicativo completo, desde Manejo de usuarios hasta Modulo de ventas, cumpliendo con los requerimientos impuestos al momento de presentar la Prueba Tecnica.


### NOTA ###

Debido a la ultima actualizacion de Laravel, este ya utiliza Vite como motor de procesado, esto lo hace un poco más eficiente a la hora de cargar nuestras aplicaciones, pero esto añade un paso, solo si es necesario y se lanza un error apenas entrar al aplicativo, la solucion es en la terminal dentro de la carpeta raiz, debemos ejecuar el comando "Npm run dev" Esto solucionará el error y te permitirá navegar sin problemas

## FIn ###

Posteriormente procedo a informar que contiene este aplicativo

-Modulo de usuarios
-Modulo de productos
-Modulo de pedidos y detalles
-Modulo de carro
-Diseño y estructura totalmete CSS no se utilizó ningun tipo de plantilla, unicamente en el dashboard admin Utilizando ADMINLTE3 y bootstrap.

