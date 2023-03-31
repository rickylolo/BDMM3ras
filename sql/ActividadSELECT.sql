
USE SAKILA;
SELECT t.table_schema AS db_name,
       t.table_name,
       (CASE WHEN t.table_type = 'BASE TABLE' THEN 'table'
             WHEN t.table_type = 'VIEW' THEN 'view'
             ELSE t.table_type
        END) AS table_type,
        c.column_name,
        c.column_type,
        c.column_default,
        c.column_key,
        c.is_nullable,
        c.extra,
        c.column_comment
FROM information_schema.tables AS t
INNER JOIN information_schema.columns AS c
ON t.table_name = c.table_name
AND t.table_schema = c.table_schema
WHERE t.table_schema = 'SAKILA' 
ORDER BY t.table_schema,
         t.table_name,
         c.ordinal_position;
         
DESCRIBE ACTOR;
INSERT INTO actor(first_name,last_name) VALUES('ARTURO','SOLORIO');

/*
1)Obtener el nombre completo de cada actor y la cantidad de películas en las que participa
Incluir a los actores que no participan en ninguna película
*/
SELECT A.actor_id,CONCAT(A.first_name,' ', A.last_name) NOMBRE_COMPLETO, COUNT(B.film_id) NO_PELICULAS
FROM ACTOR A
LEFT JOIN film_actor B ON A.actor_id = B.actor_id
GROUP BY 1
ORDER BY NO_PELICULAS;


/*
2) Obtener la cantidad de ingresos por año-mes y por sucursal, ordenado por año, mes, sucursal
*/
SELECT A.store_id,SUM(C.amount) INGRESOS, MONTH(C.payment_date) MES, YEAR(C.payment_date) AÑO
FROM store A
JOIN staff B ON A.store_id = B.store_id
JOIN payment C ON C.staff_id = B.staff_id
GROUP BY YEAR(C.payment_date), MONTH(C.payment_date),  A.store_id
ORDER BY YEAR(C.payment_date), MONTH(C.payment_date),  A.store_id;


/*
3) Obtener la cantidad que ha gastado cada cliente por concepto de renta de películas y la cantidad de veces que ha rentado alguna.
 Se ocupa: Nombre del cliente, $ gastado por renta, # rentas
*/
SELECT CONCAT(A.first_name, ' ', A.last_name) CLIENTE,COUNT(B.rental_id) NO_RENTAS, SUM(C.amount) MONTO_GASTADO
FROM customer A
JOIN rental B ON A.customer_id = B.customer_id
JOIN payment C ON B.rental_id = C.rental_id
GROUP BY C.customer_id
ORDER BY 3 DESC;

/*
4) Obtener nombre del cliente, nombre de película que ha rentado y fecha de renta. Incluir clientes que no han rentado películas.
*/
DESCRIBE customer;
INSERT INTO customer(store_id,first_name,last_name,email,address_id,create_date) VALUES(1,'EROS','VEGA','EROSVEGA@gmail.com',1,now());

SELECT CONCAT(A.first_name, ' ', A.last_name) CLIENTE, D.title PELICULA, B.rental_date FECHA_RENTA
FROM customer A
LEFT JOIN rental B ON A.customer_id = B.customer_id
LEFT JOIN inventory C ON B.inventory_id = C.inventory_id
LEFT JOIN film D ON C.film_id = D.film_id
ORDER BY A.customer_id DESC;
  
  
/*
5) Obtener nombre del cliente y cantidad de rentas que ha realizado por año, mes, ordenado por año, mes, nombre del cliente
*/
SELECT CONCAT(A.first_name, ' ', A.last_name) CLIENTE, COUNT(B.Customer_id) NO_RENTAS, MONTH(B.rental_date) MES, YEAR(B.rental_date) AÑO
FROM customer A
LEFT JOIN rental B ON A.customer_id = B.customer_id
GROUP BY A.customer_id,YEAR(B.rental_date), MONTH(B.rental_date)
ORDER BY YEAR(B.rental_date), MONTH(B.rental_date), CLIENTE;

/*
5.1) Misma Consulta pero ordenado a los que han rentado más peliculas a menos
*/
SELECT CONCAT(A.first_name, ' ', A.last_name) CLIENTE, COUNT(B.Customer_id) NO_RENTAS, MONTH(B.rental_date) MES, YEAR(B.rental_date) AÑO
FROM customer A
LEFT JOIN rental B ON A.customer_id = B.customer_id
GROUP BY A.customer_id,YEAR(B.rental_date), MONTH(B.rental_date)
ORDER BY 2 DESC, YEAR(B.rental_date), MONTH(B.rental_date), CLIENTE;


