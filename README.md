# minesweeper
*Escribe una aplicación PHP que lleve a cabo la siguiente funcionalidad:
Se trata de implementar un sencillo juego de buscaminas. 
El Buscaminas es un juego de ordenador para un solo jugador. El objetivo del juego es
despejar un campo minado sin detonar ninguna mina.
El tablero de juego del Buscaminas es un rectángulo de filas y columnas (8x8). En cada posición 
de fila y columna hay una celda o casilla, inicialmente
cubierta. En algunas de esas celdas se ocultan 10 minas. El jugador debe despejar todas las
celdas del tablero excepto aquellas que ocultan una mina. Si el jugador da la orden de
levantar una celda con mina, entonces pierde el juego.
Algunas casillas, entre las que no son celdas de mina, tienen asignado un valor numérico:
ese valor indica el número de minas que circundan a la posición de esa celda. Cada celda
tiene hasta un máximo de otras ocho que la rodean, y por tanto el valor máximo que
podrá tomar una celda es 8.
Habrá casillas que no tendrán ninguna mina a su alrededor: a esas casillas no se les asigna
número alguno (o se les asigna el valor 0). Cuando el jugador levanta una celda sin valor
numérico y sin mina es inmediato saber que las ocho celdas que la rodean tampoco
tienen mina: por eso, cuando el jugador selecciona una celda sin valor, el juego desvela
automáticamente todas aquellas celdas que, a partir de ésa seleccionada, se encuentren
también sin valor, hasta levantar todas aquellas que tienen un valor numérico distinto de
0.
La partida acaba cuando el jugador a descubierto todas las casillas menos las que tienen las minas o
el jugador ha descubierto una casilla con mina*


Orientaciones:
1. Estructuras de control variadas
2. Utilización de arrays bidimensionales
3. Uso de Funciones de usuario
4. Envío de bloques de información desde el formulario
5. Interacción múltiple con la aplicación
6. Ordinograma de control del controlador
7. Uso de AJAX para posibilitar la comunicación entre el cliente y el servidor de manera asíncrona.
8. Uso de JSON como formato de intercambio de datos.
9. Manipulación de elementos del DOM con JQuery.
10. Uso de composer
11. Generación de vistas con motor de vistas BladeOne
12. Arquitectura controlador y vistas. Patrón MVC
13. Uso de recursos de programación funcional (array_map, array_walk, array_filter, etc).



