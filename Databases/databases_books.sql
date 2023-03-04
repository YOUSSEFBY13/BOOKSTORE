create database bookstor_pro1;

use bookstor_pro1;

CREATE TABLE custmer (
  id int auto_increment primary key,
  first_name varchar(255) NOT NULL,
  last_name varchar(255) NOT NULL,
  email varchar(255) NOT NULL,
  city varchar(255) NOT NULL,
  password varchar(255) NOT NULL
);

CREATE TABLE admin_book (
  id int auto_increment primary key,
  email varchar(255) NOT NULL,
  password varchar(255) NOT NULL
);

insert into admin_book values (1, 'admin@gmail.com', 'admin');


CREATE TABLE books (
  id int auto_increment primary key,
  book_title varchar(255) not null,
  book_autor varchar(255) not null,
  book_price varchar(255) not null,
  book_desc text not null,
  book_lang varchar(255) not null,
  book_numbe_page varchar(255) not null,
  book_type varchar(255) not null,
  book_image varchar(255) not null
);

CREATE TABLE contact_books (
  id int auto_increment primary key,
  first_name varchar(255) not null,
  last_name varchar(255) not null,
  email varchar(255) not null,
  Subject varchar(255) not null,
  message text not null
);

CREATE TABLE orders_books (
  id int auto_increment primary key,
  fuul_name varchar(255) not null,
  email varchar(255) not null,
  adresse varchar(255) not null,
  city varchar(255) not null,
  state varchar(255) not null,
  zip_code varchar(255) not null,
  name_card varchar(255) not null,
  number_card varchar(255) not null,
  month varchar(255) not null,
  year varchar(255) not null,
  cvv varchar(255) not null
);

CREATE TABLE category (
  id_category int auto_increment primary key,
  name_category varchar(255) NOT NULL,
  desc_category text NOT NULL,
  image_category varchar(255) NOT NULL
);


CREATE TABLE cart_book (
  id_cart_book int auto_increment primary key,
  book_cart_name varchar(255) not null,
  book_cart_autor varchar(255) not null,
  book_cart_price varchar(255) not null,
  book_cart_quantity varchar(255) not null,
  book_cart_image varchar(255) not null
);

CREATE TABLE reviews (
  id_rev INT AUTO_INCREMENT PRIMARY KEY,
  rate VARCHAR(255) NOT NULL,
  rev_title VARCHAR(255) NOT NULL,
  rev_comm TEXT NOT NULL
);