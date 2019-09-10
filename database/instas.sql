/*
Created		04/09/2019
Modified		10/09/2019
Project		
Model		
Company		
Author		
Version		
Database		mySQL 5 
*/


drop table IF EXISTS followers;
drop table IF EXISTS filters;
drop table IF EXISTS chat;
drop table IF EXISTS lajki;
drop table IF EXISTS komentarji;
drop table IF EXISTS posts;
drop table IF EXISTS users;


Create table users (
	id Serial NOT NULL,
	google_auth_id Varchar(255),
	email Varchar(150) NOT NULL,
	ime Varchar(50) NOT NULL,
	priimek Varchar(50) NOT NULL,
	datum_r Date NOT NULL,
	geslo Varchar(255),
	opis Text,
 Primary Key (id)) ENGINE = MyISAM;

Create table posts (
	id Serial NOT NULL,
	filter_id Bigint UNSIGNED NOT NULL,
	naslov Varchar(50) NOT NULL,
	opis Text,
	slika_url Varchar(255) NOT NULL,
	user_id Bigint UNSIGNED NOT NULL,
 Primary Key (id)) ENGINE = MyISAM;

Create table komentarji (
	id Serial NOT NULL,
	komentar Text NOT NULL,
	opis Text NOT NULL,
	post_id Bigint UNSIGNED NOT NULL,
	user_id Bigint UNSIGNED NOT NULL,
 Primary Key (id)) ENGINE = MyISAM;

Create table lajki (
	id Serial NOT NULL,
	post_id Bigint UNSIGNED NOT NULL,
	user_id Bigint UNSIGNED NOT NULL,
 Primary Key (id)) ENGINE = MyISAM;

Create table chat (
	id Serial NOT NULL,
	getter_id Bigint UNSIGNED NOT NULL,
	sender_id Bigint UNSIGNED NOT NULL,
	massg Text NOT NULL,
 Primary Key (id)) ENGINE = MyISAM;

Create table filters (
	id Serial NOT NULL,
	filter Varchar(200) NOT NULL,
	ime Varchar(50) NOT NULL,
	opis Text NOT NULL,
 Primary Key (id)) ENGINE = MyISAM;

Create table followers (
	id Serial NOT NULL,
	follower_id Bigint UNSIGNED NOT NULL,
	followed_id Bigint UNSIGNED NOT NULL,
 Primary Key (id)) ENGINE = MyISAM;


Alter table chat add Foreign Key (sender_id) references users (id) on delete  restrict on update  restrict;
Alter table chat add Foreign Key (getter_id) references users (id) on delete  restrict on update  restrict;
Alter table posts add Foreign Key (user_id) references users (id) on delete  restrict on update  restrict;
Alter table komentarji add Foreign Key (user_id) references users (id) on delete  restrict on update  restrict;
Alter table lajki add Foreign Key (user_id) references users (id) on delete  restrict on update  restrict;
Alter table followers add Foreign Key (follower_id) references users (id) on delete  restrict on update  restrict;
Alter table followers add Foreign Key (followed_id) references users (id) on delete  restrict on update  restrict;
Alter table komentarji add Foreign Key (post_id) references posts (id) on delete  restrict on update  restrict;
Alter table lajki add Foreign Key (post_id) references posts (id) on delete  restrict on update  restrict;
Alter table posts add Foreign Key (filter_id) references filters (id) on delete  restrict on update  restrict;


