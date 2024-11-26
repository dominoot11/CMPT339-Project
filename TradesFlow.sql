CREATE DATABASE IF NOT EXISTS tradesmanager;
USE tradesmanager;

DROP TABLE IF EXISTS jobs;

-- Jobs Table
CREATE TABLE jobs (
    JobID VARCHAR(10) PRIMARY KEY,
    JobStage VARCHAR(10),
    JobStageDescription VARCHAR(50),
    JobType VARCHAR(30),
    JobSite VARCHAR(30),
    CrewID INT,
    HoursNeeded INT,
    StartDate DATE,
    CompletionDate DATE,
    DueDate DATE,
    Cost INT,
    Address VARCHAR(50),
    ClientID VARCHAR(12),
    CONSTRAINT FK_Jobs_Clients FOREIGN KEY (ClientID) REFERENCES Clients(ClientID),
    CONSTRAINT FK_Jobs_Crews FOREIGN KEY (CrewID) REFERENCES Crews(CrewID)
);


DROP TABLE IF EXISTS clients;

-- Client Table
CREATE TABLE clients(
ClientID VARCHAR(12) PRIMARY KEY,
FirstName VARCHAR(12),
LastName VARCHAR(12),
PhoneNumber VARCHAR(12),
Email VARCHAR(30),
Address VARCHAR(25),
City VARCHAR(12),
ZipCode VARCHAR(12),
Province VARCHAR(20),
Country VARCHAR(12),
DateOfBirth DATE,
Gender VARCHAR(1)
);


DROP TABLE IF EXISTS crews;

-- Crew Table
CREATE TABLE crews(
CrewID VARCHAR(10) PRIMARY KEY,
Specialty VARCHAR(12),
CrewSize INT,
Cost INT
);


DROP TABLE IF EXISTS workers;

-- Workers Table
CREATE TABLE workers(
WorkerID VARCHAR(10) PRIMARY KEY,
FirstName VARCHAR(12),
LastName VARCHAR(12),
Specialty VARCHAR(15),
CrewID VARCHAR(10),
CONSTRAINT FK_Workers_Crews FOREIGN KEY (CrewID) REFERENCES Crews(CrewID)
);


DROP TABLE IF EXISTS schedule;

-- Schedule Table
CREATE TABLE schedule(
JobID VARCHAR(10),
CurrentWeek Date,
Sunday VARCHAR(12),
Monday VARCHAR(12),
Tuesday VARCHAR(12),
Wednesday VARCHAR(12),
Thursday VARCHAR(12),
Friday VARCHAR(12),
Saturday VARCHAR(12),
PRIMARY KEY (JobID, CurrentWeek),
CONSTRAINT FK_Schedule_Jobs FOREIGN KEY (JobID) REFERENCES Jobs(JobID)
);
