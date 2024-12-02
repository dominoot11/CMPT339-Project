CREATE DATABASE IF NOT EXISTS tradesmanager;
USE tradesmanager;

-- Table Creation

DROP TABLE IF EXISTS jobs;

-- Jobs Table
CREATE TABLE jobs (
    JobID VARCHAR(5) PRIMARY KEY NOT NULL,
    JobStage CHAR(1) DEFAULT 'New', 
    JobStageDescription VARCHAR(50),
    JobType VARCHAR(30),
    JobSite VARCHAR(30),
    CrewID VARCHAR(5),
    HoursNeeded INT,
    StartDate DATE, 
    CompletionDate DATE,
    DueDate DATE,
    Cost DECIMAL(10, 2) DEFAULT 0.00,
    Address VARCHAR(50),
    ClientID VARCHAR(5),
    CONSTRAINT FK_Jobs_Clients FOREIGN KEY (ClientID) REFERENCES Clients(ClientID),
    CONSTRAINT FK_Jobs_Crews FOREIGN KEY (CrewID) REFERENCES Crews(CrewID)
);


DROP TABLE IF EXISTS clients;

-- Client Table
CREATE TABLE clients(
ClientID VARCHAR(5) PRIMARY KEY NOT NULL,
FirstName VARCHAR(16) NOT NULL,
LastName VARCHAR(16) NOT NULL,
PhoneNumber VARCHAR(12) NOT NULL,
Email VARCHAR(32) NOT NULL,
Address VARCHAR(32),
City VARCHAR(16),
ZipCode VARCHAR(12),
Province VARCHAR(20),
Country VARCHAR(20),
DateOfBirth DATE,
Gender CHAR(1) CHECK (Gender IN ('M', 'F'))
);


DROP TABLE IF EXISTS crews;

-- Crew Table
CREATE TABLE crews(
CrewID VARCHAR(5) PRIMARY KEY NOT NULL, 
Specialty VARCHAR(16),
CrewSize INT,
Cost Decimal(10, 2)
);


DROP TABLE IF EXISTS workers;

-- Workers Table
CREATE TABLE workers(
WorkerID VARCHAR(5) PRIMARY KEY NOT NULL,
FirstName VARCHAR(16),
LastName VARCHAR(16),
Specialty VARCHAR(16),
CrewID VARCHAR(5),
CONSTRAINT FK_Workers_Crews FOREIGN KEY (CrewID) REFERENCES Crews(CrewID)
);


DROP TABLE IF EXISTS schedule;

-- Schedule Table
CREATE TABLE schedule(
JobID VARCHAR(5) NOT NULL,
CurrentWeek Date NOT NULL,
Sunday VARCHAR(30),
Monday VARCHAR(30),
Tuesday VARCHAR(30),
Wednesday VARCHAR(30),
Thursday VARCHAR(30),
Friday VARCHAR(30),
Saturday VARCHAR(30),
PRIMARY KEY (JobID, CurrentWeek),
CONSTRAINT FK_Schedule_Jobs FOREIGN KEY (JobID) REFERENCES Jobs(JobID)
);


-- Views

-- Simple Jobs
CREATE VIEW simple_jobs AS
SELECT JobID, JobStage, Address, StartDate, CompletionDate, DueDate, Cost
FROM jobs;

-- Crews and Members
CREATE VIEW crew_members AS
SELECT 
    c.CrewID, 
    c.Specialty AS CrewSpecialty, 
    c.CrewSize, 
    c.Cost AS CrewCost,
    w.WorkerID, 
    w.FirstName AS WorkerFirstName, 
    w.LastName AS WorkerLastName
FROM crews c
LEFT JOIN workers w ON c.CrewID = w.CrewID;

-- Schedule for Clients. When used, can filter by clientID
CREATE VIEW client_schedule AS
SELECT j.JobID, j.JobSite, j.JobStage, s.CurrentWeek, 
       s.Sunday, s.Monday, s.Tuesday, s.Wednesday, 
       s.Thursday, s.Friday, s.Saturday, j.ClientID
FROM jobs j
JOIN schedule s ON j.JobID = s.JobID;

-- Schedule for crews and workers. When used, can filter by crewID 
CREATE VIEW crew_schedule AS
SELECT j.JobID, j.JobSite, j.JobStage, w.FirstName AS WorkerFirstName,
       w.LastName AS WorkerLastName, c.Specialty AS CrewSpecialty, s.CurrentWeek,
       s.Sunday, s.Monday, s.Tuesday, s.Wednesday, s.Thursday, s.Friday, s.Saturday
FROM jobs j
JOIN workers w ON j.CrewID = w.CrewID
JOIN crews c ON w.CrewID = c.CrewID
JOIN schedule s ON j.JobID = s.JobID



-- Procedures

-- Add / Update / Delete / Alter

-- Job
DELIMITER //
CREATE PROCEDURE addJob (
    IN p_JobID VARCHAR(5),
    IN p_JobStage CHAR(1), 
    IN p_JobStageDescription VARCHAR(50),
    IN p_JobType VARCHAR(30),
    IN p_JobSite VARCHAR(30),
    IN p_CrewID VARCHAR(5),
    IN p_HoursNeeded INT,
    IN p_StartDate DATE, 
    IN p_CompletionDate DATE,
    IN p_DueDate DATE,
    IN p_Cost DECIMAL(10, 2),
    IN p_Address VARCHAR(50),
    IN p_ClientID VARCHAR(5)
)
BEGIN
    INSERT INTO jobs (JobID, JobStage, JobStageDescription, JobType, JobSite, CrewID, HoursNeeded, StartDate, CompletionDate, DueDate, Cost, Address, ClientID)
    VALUES (p_JobID, p_JobStage, p_JobStageDescription, p_JobType, p_JobSite, p_CrewID, p_HoursNeeded, p_StartDate, p_CompletionDate, p_DueDate, p_Cost, p_Address, p_ClientID);
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE updateJob (
    IN p_JobID VARCHAR(5),
    IN p_JobStage CHAR(1),
    IN p_JobStageDescription VARCHAR(50)
    IN p_JobType VARCHAR(30),
    IN p_JobSite VARCHAR(30),
    IN p_CrewID VARCHAR(5),
    IN p_HoursNeeded INT,
    IN p_StartDate DATE,
    IN p_CompletionDate DATE, 
    IN p_DueDate DATE, 
    IN p_Cost DECIMAL(10, 2), 
    IN p_Address VARCHAR(50),
    IN p_ClientID VARCHAR(5)
)
BEGIN
    UPDATE jobs
    SET JobStage = p_JobStage,
        JobStageDescription = p_JobStageDescription,
        JobType = p_JobType,
        JobSite = p_JobSite,
        CrewID = p_CrewID,
        HoursNeeded = p_HoursNeeded,
        StartDate = p_StartDate,
        CompletionDate = p_CompletionDate,
        DueDate = p_DueDate,
        Cost = p_Cost,
        Address = p_Address,
        ClientID = p_ClientID
    WHERE JobID = p_JobID;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE deleteJob(
    IN p_JobID VARCHAR(5)
)
BEGIN
    DELETE FROM jobs
    WHERE JobID = p_JobID;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE alterJobsDefaults(
    IN columnName VARCHAR(50),
    IN newDefaultValue VARCHAR(50)
)
BEGIN
    SET @query = CONCAT('ALTER TABLE jobs ALTER COLUMN ', columnName, ' SET DEFAULT "', newDefaultValue, '";');
    PREPARE stmt FROM @query;
    EXECUTE stmt;
    DEALLOCATE PREPARE stmt;
END //
DELIMITER ;


-- Client
DELIMITER //
CREATE PROCEDURE addClient (
    IN p_ClientID VARCHAR(5),
    IN p_FirstName VARCHAR(16),
    IN p_LastName VARCHAR(16),
    IN p_PhoneNumber VARCHAR(12),
    IN p_Email VARCHAR(32),
    IN p_Address VARCHAR(32),
    IN p_City VARCHAR(16),
    IN p_ZipCode VARCHAR(12),
    IN p_Province VARCHAR(20),
    IN p_Country VARCHAR(20),
    IN p_DateOfBirth DATE,
    IN p_Gender CHAR(1)
)
BEGIN
    INSERT INTO clients (ClientID, FirstName, LastName, PhoneNumber, Email, Address, City, ZipCode, Province, Country, DateOfBirth, Gender)
    VALUES (p_ClientID, p_FirstName, p_LastName, p_PhoneNumber, p_Email, p_Address, p_City, p_ZipCode, p_Province, p_Country, p_DateOfBirth, p_Gender);
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE updateClient (
    IN p_ClientID VARCHAR(5),
    IN p_FirstName VARCHAR(16),
    IN p_LastName VARCHAR(16),
    IN p_PhoneNumber VARCHAR(12),
    IN p_Email VARCHAR(32),
    IN p_Address VARCHAR(32),
    IN p_City VARCHAR(16),
    IN p_ZipCode VARCHAR(12),
    IN p_Province VARCHAR(20),
    IN p_Country VARCHAR(20),
    IN p_DateOfBirth DATE,
    IN p_Gender CHAR(1)
)
BEGIN
    UPDATE clients
    SET FirstName = p_FirstName,
        LastName = p_LastName,
        PhoneNumber = p_PhoneNumber,
        Email = p_Email,
        Address = p_Address,
        City = p_City,
        ZipCode = p_ZipCode,
        Province = p_Province,
        Country = p_Country,
        DateOfBirth = p_DateOfBirth,
        Gender = p_Gender
    WHERE ClientID = p_ClientID;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE deleteClient(
    IN p_ClientID VARCHAR(5)
)
BEGIN
    DELETE FROM clients
    WHERE ClientID = p_ClientID;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE alterClientsDefaults(
    IN columnName VARCHAR(50),
    IN newDefaultValue VARCHAR(50)
)
BEGIN
    SET @query = CONCAT('ALTER TABLE clients ALTER COLUMN ', columnName, ' SET DEFAULT "', newDefaultValue, '";');
    PREPARE stmt FROM @query;
    EXECUTE stmt;
    DEALLOCATE PREPARE stmt;
END //
DELIMITER ;


-- Crew
DELIMITER //
CREATE PROCEDURE addCrew (
    IN p_CrewID VARCHAR(5),
    IN p_Specialty VARCHAR(16),
    IN p_CrewSize INT,
    IN p_Cost DECIMAL(10, 2)
)
BEGIN
    INSERT INTO crews (CrewID, Specialty, CrewSize, Cost)
    VALUES (p_CrewID, p_Specialty, p_CrewSize, p_Cost);
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE updateCrew (
    IN p_CrewID VARCHAR(5),
    IN p_Specialty VARCHAR(16),
    IN p_CrewSize INT,
    IN p_Cost DECIMAL(10, 2)
)
BEGIN
    UPDATE crews
    SET Specialty = p_Specialty,
        CrewSize = p_CrewSize,
        Cost = p_Cost
    WHERE CrewID = p_CrewID;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE deleteCrew(
    IN p_CrewID VARCHAR(5)
)
BEGIN
    DELETE FROM crews
    WHERE CrewID = p_CrewID;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE alterCrewsDefaults(
    IN columnName VARCHAR(50),
    IN newDefaultValue VARCHAR(50)
)
BEGIN
    SET @query = CONCAT('ALTER TABLE crews ALTER COLUMN ', columnName, ' SET DEFAULT "', newDefaultValue, '";');
    PREPARE stmt FROM @query;
    EXECUTE stmt;
    DEALLOCATE PREPARE stmt;
END //
DELIMITER ;


-- Worker
DELIMITER //
CREATE PROCEDURE addWorker (
    IN p_WorkerID VARCHAR(5),
    IN p_FirstName VARCHAR(16),
    IN p_LastName VARCHAR(16),
    IN p_Specialty VARCHAR(16),
    IN p_CrewID VARCHAR(5)
)
BEGIN
    INSERT INTO workers (WorkerID, FirstName, LastName, Specialty, CrewID)
    VALUES (p_WorkerID, p_FirstName, p_LastName, p_Specialty, p_CrewID);
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE updateWorker (
    IN p_WorkerID VARCHAR(5),
    IN p_FirstName VARCHAR(16),
    IN p_LastName VARCHAR(16),
    IN p_Specialty VARCHAR(16),
    IN p_CrewID VARCHAR(5)
)
BEGIN
    UPDATE workers
    SET FirstName = p_FirstName,
        LastName = p_LastName,
        Specialty = p_Specialty,
        CrewID = p_CrewID
    WHERE WorkerID = p_WorkerID;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE deleteWorker(
    IN p_WorkerID VARCHAR(5)
)
BEGIN
    DELETE FROM workers
    WHERE WorkerID = p_WorkerID;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE alterWorkersDefaults(
    IN columnName VARCHAR(50),
    IN newDefaultValue VARCHAR(50)
)
BEGIN
    SET @query = CONCAT('ALTER TABLE workers ALTER COLUMN ', columnName, ' SET DEFAULT "', newDefaultValue, '";');
    PREPARE stmt FROM @query;
    EXECUTE stmt;
    DEALLOCATE PREPARE stmt;
END //
DELIMITER ;


-- Schedule
DELIMITER //
CREATE PROCEDURE addSchedule (
    IN p_JobID VARCHAR(5),
    IN p_CurrentWeek DATE,
    IN p_Sunday VARCHAR(30),
    IN p_Monday VARCHAR(30),
    IN p_Tuesday VARCHAR(30),
    IN p_Wednesday VARCHAR(30),
    IN p_Thursday VARCHAR(30),
    IN p_Friday VARCHAR(30),
    IN p_Saturday VARCHAR(30)
)
BEGIN
    INSERT INTO schedule (JobID, CurrentWeek, Sunday, Monday, Tuesday, Wednesday, Thursday, Friday, Saturday)
    VALUES (p_JobID, p_CurrentWeek, p_Sunday, p_Monday, p_Tuesday, p_Wednesday, p_Thursday, p_Friday, p_Saturday);
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE updateSchedule (
    IN p_JobID VARCHAR(5),
    IN p_CurrentWeek DATE,
    IN p_Sunday VARCHAR(30),
    IN p_Monday VARCHAR(30),
    IN p_Tuesday VARCHAR(30),
    IN p_Wednesday VARCHAR(30),
    IN p_Thursday VARCHAR(30),
    IN p_Friday VARCHAR(30),
    IN p_Saturday VARCHAR(30)
)
BEGIN
    UPDATE schedule
    SET Sunday = p_Sunday,
        Monday = p_Monday,
        Tuesday = p_Tuesday,
        Wednesday = p_Wednesday,
        Thursday = p_Thursday,
        Friday = p_Friday,
        Saturday = p_Saturday
    WHERE JobID = p_JobID AND CurrentWeek = p_CurrentWeek;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE deleteSchedule(
	IN p_JobID VARCHAR(5),
    IN p_CurrentWeek DATE
)
BEGIN
    DELETE FROM schedule
    WHERE JobID = p_JobID AND CurrentWeek = p_CurrentWeek;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE alterScheduleDefaults(
    IN columnName VARCHAR(50),
    IN newDefaultValue VARCHAR(50)
)
BEGIN
    SET @query = CONCAT('ALTER TABLE schedule ALTER COLUMN ', columnName, ' SET DEFAULT "', newDefaultValue, '";');
    PREPARE stmt FROM @query;
    EXECUTE stmt;
    DEALLOCATE PREPARE stmt;
END //
DELIMITER ;


-- Filter

-- Job by stage
DELIMITER //
CREATE PROCEDURE getJobsByStage(
    IN p_JobStage VARCHAR(1)
)
BEGIN
    SELECT JobID, Address, StartDate, CompletionDate, DueDate, Cost
    FROM simple_jobs
    WHERE JobStage = p_JobStage;
END //
DELIMITER ;


-- Active Jobs
DELIMITER //
CREATE PROCEDURE getJobsByStage()
BEGIN
    SELECT JobID, Address, StartDate, CompletionDate, DueDate, Cost
    FROM simple_jobs
    WHERE JobStage NOT IN ('J', 'K'); -- J finished, K cancelled
END //
DELIMITER ;

-- crews and members
DELIMITER //
CREATE PROCEDURE viewCrew(
    IN p_CrewID VARCHAR(5)
)
BEGIN
    -- Select from the crew_members view, filtering by CrewID
    SELECT *
    FROM crew_members
    WHERE CrewID = p_CrewID;
END //
DELIMITER ;


-- Crew Performance
DELIMITER //
CREATE PROCEDURE viewCrewPerformance(
    IN p_ClientID VARCHAR(5)
)
BEGIN
    SELECT CrewID, COUNT(JobID) AS JobsHandled, SUM(HoursNeeded) AS TotalHours, SUM(Cost) AS TotalEarnings
	FROM jobs
	GROUP BY CrewID;
END //
DELIMITER ;


-- Client Schedule
DELIMITER //
CREATE PROCEDURE getClientSchedule(
    IN p_ClientID VARCHAR(5)
)
BEGIN
    -- Select from the client_schedule view, filtering by ClientID
    SELECT *
    FROM client_schedule
    WHERE ClientID = p_ClientID;
END //
DELIMITER ;


-- Crew Schedule
DELIMITER //
CREATE PROCEDURE getCrewSchedule(
    IN p_CrewID VARCHAR(5)
)
BEGIN
    -- Select from the client_schedule view, filtering by ClientID
    SELECT *
    FROM client_schedule
    WHERE CrewID = p_CrewID;
END //
DELIMITER ;





