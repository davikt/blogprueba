/* Script para crear la BD del Blog */

drop schema if exists blogprueba;
create schema blogprueba;
use blogprueba;

create table posts (
    id int primary key auto_increment,
    fecha timestamp not null default now(),
    /* Hay que tener en cuenta que la filosofía del blog no es de artículos grandes...  Por eso... Lo limitamos a 400. */
    texto varchar(400) not null,
    autor varchar(600) not null,
    dispositivo varchar(600) not null,
    active int(1) not null default '0'
);

-- Datos de prueba
insert into posts(texto,autor,dispositivo) values 
    ('Hola, este es el primer artículo','unemail@midominio.es','Iphone (Apple)'),
    ('Después del primero viene el segundo... :)','otroemail@test.com','Nexus 7 (Google)'),
    ('Donde caben dos, caben tres. Un dicho popular muy acertado.','masemails@pruebas.net','ninguno');
    



/* SCRIPT SIN FINALIZAR */

