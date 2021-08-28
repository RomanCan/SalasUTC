DESCARGANDO POR PRIMERA VEZ EL PROYECTO, HAY UNOS COMANDOS QUE TIENES QUE CORRER PARA PODER CONTINUAR, YA QUE TE INSTALAS PAQUETES Y DEPENDENCIAS, ESTO SE HACE DESDE LA TERMINAL, ESTANDO EN EL DIRECTORIO DEL PROYECTO. 

### INSTALAR PAQUETES O DEPENDENCIAS

`composer install`


### COPIAMOS EL CONTENIDO DEL ARCHIVO ENV.EXAMPLE CON LA SIGUIENTE LINEA

`cp .env.example .env`

### GENERAMOS APP_KEY 

`php artisan key:generate`

### Listo el proyecto ya es funcional, para correrlo usamos

`php artisan serve`

### Creamos la base de datos corriendo la siguiente linea.

`php artisan make:database salas mysql`

*Puedes agregar el tipo de caracteres a usar despues del tipo de BD a usar, por ejemplo*

`php artisan make:database salas mysql utf8mb4`

*NO OLVIDES MODIFICAR TU ARCHIVO .env  CON EL NOMBRE DE LA BD QUE HAS CREADO*

### Actualiza tu base de datos corriendo las migraciones para la tabla.

`php artisan migrate`
