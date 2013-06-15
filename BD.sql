/* Script para crear la BD del Blog */

drop schema if exists blogprueba;
create schema blogprueba;
use blogprueba;

create table usuarios(
    email varchar(600) primary key  not null,
    pass varchar(100) not null,
    active int(1) not null default '1'
);

create table posts (
    id int primary key not null auto_increment,
    fecha timestamp not null default now(),
    /* Hay que tener en cuenta que la filosofía del blog no es de artículos grandes...  Por eso... Lo limitamos a 600. */
    texto varchar(600) not null,
    autor varchar(600) not null,
    dispositivo varchar(600) not null,
    active int(1) not null default '0'
);

alter table posts add constraint fk_email foreign key (autor) 
        references usuarios(email) 
        on update cascade 
        on delete restrict;

-- Datos de prueba
insert into usuarios(email,pass) values
    ('unemail@midominio.es',sha1('unemail')),
    ('otroemail@test.com',sha1('otroemail')),
    ('masemails@pruebas.net',sha1('masemails'));

insert into posts(texto,autor,dispositivo,active) values 
    ('En un lugar de la Mancha, de cuyo nombre no quiero acordarme, no ha mucho tiempo que vivía un hidalgo de los de lanza en astillero, adarga antigua, rocín flaco y galgo corredor. Una olla de algo más vaca que carnero, salpicón las más noches, duelos y quebrantos los sábados, lantejas los viernes, algún palomino de añadidura los domingos, consumían las tres partes de su hacienda. El resto della concluían sayo de velarte, calzas de velludo para las fiestas, con sus pantuflos de lo mesmo','unemail@midominio.es','Iphone (Apple)',1),
    ('Después del primero viene el segundo... :)','otroemail@test.com','Nexus 7 (Google)',1),
    ('Donde caben dos, caben tres. Un dicho popular muy acertado.','masemails@pruebas.net','ninguno',1);
    



/* SCRIPT SIN FINALIZAR */

