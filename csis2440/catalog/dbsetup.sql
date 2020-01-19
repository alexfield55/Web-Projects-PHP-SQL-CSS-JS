create database catalog;
use catalog;
create table user (id int primary key auto_increment, username varchar(50), password varchar(50));
create table product (id int primary key auto_increment, name varchar(50), description varchar(100), image varchar(100), price float);