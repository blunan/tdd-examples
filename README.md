# Ejercicios desarrollados en el curso de TDD

## Listado de ejercicios:

1. **TDD1** - Juego del ahorcado
1. **TDD2** - Juego del ahorcado con inyección de dependencias y escritura de logs

## Como utilizar los ejercicios

Primero hay que instalar `composer` para el manejo de dependencias.

```bash
brew install composer
```

Después instalamos las dependecias como tal.

```bash
 #composer require --dev phpunit/phpunit
 composer install
```

Ejemplo de como correr los tests:

```bash
./vendor/bin/phpunit ./TDD1/AhorcadoTest.php
```

Ejemplo de como correr en consola:

```bash
php ./TDD1/Game.php
```

