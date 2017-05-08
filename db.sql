//Android voting application for AMU-CSIT-Exhibition

create database voting;
use voting;
create table developer(
 id varchar(255) primary key,
 firstname varchar(255),
 lastname varchar(255),
 sex varchar(255)
);
create table project(
  title varchar(255),
  dev_id varchar(255)
);
create table score(
 dev_id varchar(255) primary key,
 stu_vote varchar(255),
 staff_vote varchar(255)
);
create table access_list(
 mac varchar(255) primary key,
 vote_count varchar(255)
);
create table staff(
 username varchar(255) primary key,
 password varchar(255)
);
