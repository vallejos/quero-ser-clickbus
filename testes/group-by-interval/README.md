Group By Interval
============

O Problema
----------
Dado um grupo desordenado de números inteiros, positivos ou negativos, dividir a lista em grupos ordenados de acordo com o range especificado: 

*Atenção: O algoritmo de ordenação faz parte da solução do problema, não pode ser utilizada funcões da linguagem para realiza-la*

Exemplos:
---------
* 
 **Entrada:** 
 ```
 Range: 10,  
 Number Set: [10, 1, -20,  14, 99, 136, 19, 20, 117, 22, 93,  120, 131]  
 ```
 **Resultado:**  
 ```
 {[-20], [1, 10], [14, 19, 20, 22], [93, 99], [117, 120], [131, 136]}
 ```

* 
  **Entrada:**  
  ```
  Range: 15,  
  Number Set: [10, 1, -20,  14, 99, 136, 19, 20, 117, 22, 93, 120, 131]    
  ```
  **Resultado:**  
  ```
  {[-20], [1, 10, 14], [19, 20, 22], [93, 99], [117, 120, 131], [136]}
  ```

* 
 **Entrada:**  
 ```
 Range: 15,  
 Number Set: [10, 1, A,  14, 99, 133, 19, 20, 117, 22, 93,  120, 131]  
 ```    
 **Resultado:** *throw InvalidArgumentException*

* 
  **Entrada:**  
  ```
  Range: NULL,  
  Number Set: [ ]  
  ```
  **Resultado:** [Empty Set]

1 Install
----------

Make sure you have Symfony 2 and Bower installed on the system.

* Install dependencies
```
$ composer install
$ bower install
```

* Run the server
```
php app/console server:run
```

Open http://127.0.0.1:8000 to try it out.
