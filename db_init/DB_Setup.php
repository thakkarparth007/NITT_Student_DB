<?php

/*
Run the following script once in order to set up the database, 
which will be used in future.
 */

require_once "../DB_config.php";

$db_initial_data_loc = __DIR__  . DIRECTORY_SEPARATOR;
$courses = $db_initial_data_loc . "db_courses.txt";
$depts = $db_initial_data_loc . 'db_depts.txt';

$query1 = <<<NITT
CREATE TABLE students (
	roll 		 			CHAR(9)	PRIMARY KEY,
	name 					VARCHAR(50)		NOT NULL,
    course 					TINYINT			NOT NULL,
    dept 					TINYINT			NOT NULL,
    dob 					DATE			NOT NULL,
    hostel 					VARCHAR(20)		NOT NULL,
	email 					VARCHAR(320)	NOT NULL,	
	contact 				CHAR(13)		NOT NULL,
	sec_contact 			CHAR(13)		NOT NULL,
	curr_addrline1			VARCHAR(100)	NOT NULL,
	curr_addrline2			VARCHAR(100)	NOT NULL,
	curr_city				VARCHAR(50)		NOT NULL,
	curr_state				VARCHAR(50)		NOT NULL,
	curr_zip				VARCHAR(16)		NOT NULL,
	curr_country			VARCHAR(30)		NOT NULL,
	india_addrline1			VARCHAR(100)	NOT NULL,
	india_addrline2			VARCHAR(100)	NOT NULL,
	india_city				VARCHAR(30)		NOT NULL,
	india_state				VARCHAR(20)		NOT NULL,
	india_zip				VARCHAR(16)		NOT NULL,
	nationality				VARCHAR(30)		NOT NULL,
	father_name				VARCHAR(50)		NOT NULL,
	father_email			VARCHAR(320)	NOT NULL,
	father_contact			CHAR(13)		NOT NULL,
	mother_name				VARCHAR(50)		NOT NULL,
	mother_email			VARCHAR(320)	NOT NULL,
	mother_contact			CHAR(13)		NOT NULL,
	emergency_name			VARCHAR(50)		NOT NULL,
	emergency_relation		VARCHAR(50)		NOT NULL,
	emergency_contact		CHAR(13)		NOT NULL,
	bloodgrp				VARCHAR(4)		NOT NULL,
	donate					CHAR 			NOT NULL
);
NITT;

$query2 = <<<NITT
CREATE TABLE courses (
	course_id 				TINYINT	PRIMARY KEY,
	course_name				VARCHAR(30)
);
NITT;

$query3 = <<<NITT
CREATE TABLE departments (
	dept_id					TINYINT PRIMARY KEY,
	dept_name				VARCHAR(50)
);
NITT;

$query4 = 'LOAD DATA LOCAL INFILE \'' . $courses . '\' INTO Table courses';		// DON'T add ';' at the end yet.
$query5 = 'LOAD DATA LOCAL INFILE \'' . $depts . '\' INTO Table departments';

$query4 = preg_replace('/\\\/','/', $query4) . " LINES TERMINATED BY '\r\n';";
$query5 = preg_replace('/\\\/','/', $query5) . " LINES TERMINATED BY '\r\n';";

$link = mysqli_connect(get_host(), get_username(), get_password(), get_db());
mysqli_query($link, $query1) or die("Error : " . mysqli_error($link));
mysqli_query($link, $query2) or die("Error : " . mysqli_error($link));
mysqli_query($link, $query3) or die("Error : " . mysqli_error($link));
mysqli_query($link, $query4) or die("Error : " . mysqli_error($link));
mysqli_query($link, $query5) or die("Error : " . mysqli_error($link));
?>