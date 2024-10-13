CREATE DATABASE IF NOT EXISTS mydb;

USE mydb;

CREATE TABLE IF NOT EXISTS my_symptoms(

    ID INT PRIMARY KEY AUTO_INCREMENT UNIQUE,
    cycle_dates VARCHAR(20),
    cycle_length VARCHAR(20),
    period_length VARCHAR(20),
    BloodFlow VARCHAR(20),
    period_status VARCHAR(20),
    ovulation_date VARCHAR(20),
    Fertile_window VARCHAR(20)
);