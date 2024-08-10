create database customer;
use customer;
CREATE TABLE customer (cid INTEGER PRIMARY KEY AUTO_INCREMENT, 
    cname VARCHAR(30), 
    cdob DATE, 
    cphone_no VARCHAR(15), 
    cemail VARCHAR(30),
    clicense varchar(16),
    caddress VARCHAR(1000)
);
INSERT INTO customer (cname, cdob, cphone_no,cemail,clicense,caddress) 
VALUES ('Bheem','2001-01-01','9876543219','example@gmail.com','AP54 34567891245','ANDHRA PRADESH');
DELETE FROM customer where cname='Bheem';
SELECT * FROM customer;
drop table customer;
CREATE TABLE rc (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50), 
    vehicle_num VARCHAR(50), 
    registration_date DATE, 
    chasi_number VARCHAR(50), 
    engine_number VARCHAR(50), 
    wheel_type VARCHAR(20), 
    fuel_type VARCHAR(20),
	brand VARCHAR(20),
	modell VARCHAR(20),
    model_year INTEGER,
    seating_capacity INTEGER,
    engine_capacity INTEGER,
    listed_price INTEGER,
    usage_type VARCHAR(20),
    fitness_validupto DATE
);
INSERT INTO rc (name, vehicle_num, registration_date, chasi_number, engine_number, wheel_type, fuel_type, brand, modell, model_year, seating_capacity, engine_capacity, listed_price, usage_type, fitness_validupto) 
VALUES ('Bheem', 'AP 00 HG 0000', '2021-05-03', 'JKBFJGH6568562236', 'NMFFNN484235', 'Four wheeler', 'Diesel', 'Tata', 'Bolt', '2015', '5', '1193', '800000', 'Private', '2022-05-03');
DELETE FROM rc where name='Bheem';
SELECT * FROM rc;
drop table rc;

CREATE TABLE curc (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50), 
    vehicle_num VARCHAR(50),
     cemail VARCHAR(40)
    );
SELECT * FROM curc;
delete from curc where vehicle_num="AP 00 HG 0000";
INSERT INTO curc (name,vehicle_num, cemail) 
VALUES ('Bheem', 'AP 00 HG 0000','example@gmail.com');
drop table curc;


CREATE TABLE afteraddons (
    vehicle_num VARCHAR(50) NOT NULL,
    netPremium DECIMAL(10, 2) NOT NULL,
    addons varchar(1000),
    date_added DATETIME NOT NULL,
    due_date DATETIME NOT NULL
);
select * from afteraddons;
delete from afteraddons where vehicle_num="AP 00 HG 0000";
INSERT INTO afteraddons(vehicle_num, netPremium, addons, date_added,due_date)
VALUES ('AP 00 HG 0000', '22325.00', "[\"Zero Depreciation Cover\",\"Engine Protection\",\"Personal Accident Cover\"]", '2021-08-08 14:45:11','2022-08-08 14:45:11');
drop table afteraddons;





CREATE TABLE credit_card_details (
     id INT AUTO_INCREMENT PRIMARY KEY,
    vehicle_num VARCHAR(13),
    price integer,
    card_name VARCHAR(50) NOT NULL,
    card_number VARCHAR(19) NOT NULL,
    expiry_date VARCHAR(5) NOT NULL, 
    cvv VARCHAR(3) NOT NULL,
    date_time DATETIME NOT NULL
);
INSERT INTO credit_card_details (vehicle_num,price,card_name, card_number, expiry_date, cvv ,date_time)
VALUES ( 'AP 00 HG 0000', '22325', 'Bheem', '9874562315623458', '04/26', '258', '2022-08-08 17:56:12');
select * from credit_card_details;
drop table credit_card_details;
delete from credit_card_details where vehicle_num="AP 00 HG 0000";


CREATE TABLE claim(cname varchar(30),vehicle_num VARCHAR(50),claim_type varchar(30),claim_details varchar(2000),cause_of_claiming varchar(5000),place varchar(200),pincode varchar(7));
select * from claim;
drop table claim;

CREATE TABLE image2(
	cname varchar(30),vehicle_num VARCHAR(50),id INT AUTO_INCREMENT PRIMARY KEY,
    image1 VARCHAR(255) NOT NULL,image2 VARCHAR(255) NOT NULL,image3 VARCHAR(255) NOT NULL,
    image4 VARCHAR(255) NOT NULL,image5 VARCHAR(255) NOT NULL,date_time DATETIME NOT NULL
);
select * from image2;
drop table image2;


DELETE FROM afteraddons WHERE vehicle_num = 'AP 00 HG 0000';

SET SQL_SAFE_UPDATES = 0;


CREATE TABLE request_claim (
      cname VARCHAR(30),
      vehicle_num VARCHAR(50),
      date_time DATETIME NOT NULL,
      request VARCHAR(3)
);
select * from request_claim;
drop table request_claim;



CREATE TABLE image3(
	cname varchar(40),vehicle_num VARCHAR(50),id INT AUTO_INCREMENT PRIMARY KEY,
    image1 VARCHAR(255) NOT NULL,image2 VARCHAR(255) NOT NULL,image3 VARCHAR(255) NOT NULL,
    image4 VARCHAR(255) NOT NULL,image5 VARCHAR(255) NOT NULL,date_time DATETIME NOT NULL
);
select * from image3;
drop table image3;


CREATE TABLE credit_card_details_renew (
    id INT AUTO_INCREMENT PRIMARY KEY,
    vehicle_num VARCHAR(13),
    price integer,
    card_name VARCHAR(50) NOT NULL,
    card_number VARCHAR(19) NOT NULL,
    expiry_date VARCHAR(5) NOT NULL, 
    cvv VARCHAR(3) NOT NULL,
    date_time DATETIME NOT NULL
);
select * from credit_card_details_renew;
drop table credit_card_details_renew;


CREATE TABLE contact_form (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    subject VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,
    submitted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
select * from contact_form;
drop table contact_form;

drop database customer;
