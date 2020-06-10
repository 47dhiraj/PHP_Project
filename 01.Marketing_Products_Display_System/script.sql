create database dashboard;
use dashboard;

create table category(
    cid int primary key auto_increment,
    cname varchar(100) not null,
    cimage TEXT  NULL
);
 
create table store(
    pid int primary key auto_increment,
    pname varchar(100) not null,
    pprice INT not null,
    psize varchar(100) not null,
    pimage TEXT  NULL,
    username varchar(100) not null,
    cid INTEGER not null,
    FOREIGN KEY(cid) REFERENCES category(cid)
    ON DELETE CASCADE

);

create table users(
    id int primary key auto_increment,
    username varchar(100) not null unique,
    password text not null,
    address varchar(100) not null,
    contact varchar(100) not null,
    image TEXT  NULL
);

