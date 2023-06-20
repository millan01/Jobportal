<?php
$servername = "localhost";
$username ="root";
$password="";
$databasename ="jobportal";

$conn = mysqli_connect($servername, $username, $password, $databasename);

// $sql = "CREATE TABLE admin_login(
//     Admin_id INT(20) UNSIGNED AUTO_INCREMENT primary key,
//     Email varchar(100) UNIQUE, 
//     username varchar(100) unique,
//     Password varchar(255) NOT NULL
// )";
// $sql = "CREATE TABLE job(
//     job_id INT unsigned auto_increment primary key,
//     category VARCHAR(200) not null,
//     job_title VARCHAR(100) not null,
//     posted_date DATE ,
//     deadline_date DATE,
//     estimated_salary VARCHAR(100),
//     no_of_vacancy INT not null,
//     job_address VARCHAR(200) not null,
//     job_type varchar(50) not null,
//     job_description VARCHAR(255) not null,
//     companyID int(10) unsigned, 
//     FOREIGN KEY(companyID) REFERENCES company(company_id),
//     companyName varchar(200) not null
// )";

// $sql = "CREATE TABLE company(
//     company_id int unsigned auto_increment primary key,
//     company_name varchar(200) not null,
//     conatact_personname varchar(100) not null,
//     email varchar(100),
//     phone varchar(100) not null,
//     password varchar(200) not null,
//     location varchar(200) not null,
//     website varchar(100),
//     category varchar(100) not null,
//     description varchar(512) not null,
//     Image_name varchar(100) not null
//  )";
// $sql = "CREATE TABLE Job_seeker(
//     Job_seeker_id int(20) unsigned auto_increment primary key,
//     Full_name varchar(100) not null,
//     Email varchar(200),
//     Password varchar(200) not null,
//     Address varchar(200) NOT NULL,
//     Phone varchar(100) not null,
//     Resume_file varchar(100) not null
// )";


// $sql = "CREATE TABLE jobseeker_education(id INT unsigned auto_increment PRIMARY KEY,
//         Course VARCHAR(100),
//         Board VARCHAR(100),
//         institute VARCHAR(100),
//         started_year INT ,
//         end_year INT,
//         jobseeker_id INT(20) unsigned,
//         FOREIGN KEY (jobseeker_id) REFERENCES job_seeker(job_seeker_id)
//         ON DELETE CASCADE
//         ON UPDATE CASCADE )";

// $sql  = "CREATE TABLE jobseeker_skill(id int unsigned auto_increment primary key,
//         Title varchar(200) not null,
//         progress int not null,
//         jobseeker_id int(20) unsigned,
//         foreign key(jobseeker_id) references job_seeker(job_seeker_id)
//         on delete cascade
//         on update cascade)";


// $sql = "CREATE TABLE jobseeker_certs(id int unsigned auto_increment primary key,
//         Title varchar(255) not null,
//         year varchar(100) not null,
//         awarded_by varchar(255) not null,
//         jobseeker_id int unsigned,
//         foreign key(jobseeker_id) references job_seeker(job_seeker_id)
//         on delete cascade
//         on update cascade)";

$sql = "CREATE TABLE jobseeker_experience(id int unsigned auto_increment primary key,
        companyName varchar(255) not null,
        startDate date,
        endDate date,
        jobseeker_id int unsigned,
        foreign key(jobseeker_id) references job_seeker(job_seeker_id)
        on delete cascade
        on update cascade)
        ";
if(mysqli_query($conn,$sql)){
    echo "table created successfully";
    }
?>