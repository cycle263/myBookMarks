//create database bookmarks
create database bookmarks;

use bookmarks;
create table user(
	username varchar(16) not null primary key,
	password char(50) not null,
	email varchar(100) not null
);

create table bookmark(
	username varchar(16) not null,
	bm_url varchar(255) not null,
	index (username),
	index (bm_url),
	primary key (username, bm_url)
);

//create user bm_user for database bookmarks
grant select, insert, update, delete on bookmarks.* to bm_user@localhost identified by 'password';
