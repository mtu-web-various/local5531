

SET FOREIGN_KEY_CHECKS=0; 
DROP TABLE IF EXISTS INSURANCE;
DROP TABLE IF EXISTS DEPARTMENTS;
DROP TABLE IF EXISTS EMPLOYEES;
DROP TABLE IF EXISTS COMPANIES;
DROP TABLE IF EXISTS LINESOFBUSINESS;
DROP TABLE IF EXISTS CONTRACT_TYPES;
DROP TABLE IF EXISTS CONTRACTS;
DROP TABLE IF EXISTS TASK_TYPES;
DROP TABLE IF EXISTS PROVINCES;
DROP TABLE IF EXISTS CITY_PROV;
DROP TABLE IF EXISTS PREFERS;
DROP TABLE IF EXISTS ASSIGNED_TASKS;
DROP TABLE IF EXISTS TIME_ENTRIES;
DROP TABLE IF EXISTS DELIVERABLE_TYPES;
DROP TABLE IF EXISTS DELIVERABLES;


#-----CREATE SCHEMA-------#

/* The Sales Associate will be able to
enter any combination of City-Province.
All new combinations entered will be stored in the CITY_PROV
table to aid the dropdown.
*/

CREATE TABLE PROVINCES(
Name VARCHAR(50) NOT NULL,
-- CONSTRAINTS
PRIMARY KEY (Name)
);

INSERT INTO PROVINCES(Name) VALUES
('Quebec'),
('Alberta'),
('British Columbia'),
('Manitoba'),
('Newfoundland & Labrador'),
('Prince Edward Island'),
('Saskatchewan'),
('New Brunswick'),
('Nova Scotia'),
('Northwest Territories'),
('Yukon'),
('Nunavut')
('Ontario');

CREATE TABLE CITY_PROV(
City VARCHAR(50) NOT NULL,
Province varchar(50) not null,
-- CONSTRAINTS
PRIMARY KEY (City, Province),
FOREIGN KEY (Province) REFERENCES PROVINCES(Name)
);


CREATE TABLE INSURANCE(
Plan varchar(50),
-- CONSTRAINTS
PRIMARY KEY (Plan)
);

CREATE TABLE DEPARTMENTS(
Name varChar(100) NOT NULL,
-- CONSTRAINTS
CONSTRAINT PK_Dep PRIMARY KEY (Name)
);

CREATE TABLE EMPLOYEES(
EMAIL VARCHAR(80) NOT NULL,
FirstName varChar(100) NOT NULL,
LastName varChar(100) NOT NULL,
DepName varchar(100) not null,
Role varchar(100) not null,
InsurancePlan varchar(50),
City varchar(50),
Province varchar(50),
PostalCode varChar(6),
AddressText varChar(255),
-- CONSTRAINTS
PRIMARY KEY (EMAIL),
FOREIGN KEY (DepName) REFERENCES DEPARTMENTS(Name),
FOREIGN KEY (InsurancePlan) REFERENCES INSURANCE(Plan),
FOREIGN KEY (Province) REFERENCES PROVINCES(Name)
);


CREATE TABLE COMPANIES(
ID int NOT NULL AUTO_INCREMENT,
Name varChar(100) NOT NULL,
Phone int(10) NOT NULL,
EMAIL varchar(50) NOT NULL,
ContactFirstName varchar(100) not null,
ContactLastName varchar(100) not null,
City varchar(50),
Province varchar(50),
PostalCode varChar(6),
AddressText varChar(255),
-- CONSTRAINTS
PRIMARY KEY (ID),
FOREIGN KEY (Province) REFERENCES PROVINCES(Name)
);

CREATE TABLE LINESOFBUSINESS(
Name varChar(50) NOT NULL,
Manager varChar(80),
-- CONSTRAINTS
PRIMARY KEY(Name),
FOREIGN KEY (Manager) REFERENCES EMPLOYEES(EMAIL)
);

INSERT INTO LINESOFBUSINESS VALUES
('Cloud Services',null), ('Business Development',null), ('Research',null)
;

CREATE TABLE CONTRACT_TYPES(
Name varchar(50),
-- CONSTRAINTS
PRIMARY KEY (Name)
);

INSERT INTO CONTRACT_TYPES(Name) VALUES
('Gold'), ('Silver'), ('Premium'), ('Diamond');

CREATE TABLE CONTRACTS(
ID int(10) NOT NULL auto_increment,
CompanyID int not null,
ManagerID int NOT NULL,
StartDate DATETIME NOT NULL,
Service ENUM('Cloud', 'On-Premises'),
ContractType varchar(50),
ACV DECIMAL(2) ,
InitialAmount DECIMAL(2),
-- CONSTRAINTS
PRIMARY KEY (ID),
FOREIGN KEY (CompanyID) REFERENCES COMPANIES(ID),
FOREIGN KEY (ContractType) REFERENCES CONTRACT_TYPES(Name),
FOREIGN KEY (ContractType) REFERENCES LINESOFBUSINESS(Name)
);

CREATE TABLE TASK_TYPES(
Name VARCHAR(50) NOT NULL,
-- CONSTRAINTS
PRIMARY KEY (Name)
);

INSERT INTO TASK_TYPES(Name) VALUES
('Client Onboarding'), ('Provisioning'), ('Assign technical team'), ('Allocate data centre');

CREATE TABLE PREFERS(
EmployeeID varchar(80),
ContractType varchar (50),
-- CONSTRAINTS
FOREIGN KEY (EmployeeID) REFERENCES EMPLOYEES(EMAIL),
FOREIGN KEY (ContractType) REFERENCES CONTRACT_TYPES(Name)
);

CREATE TABLE ASSIGNED_TASKS(
ID int(10) not null auto_increment,
EmployeeID varchar(80) not null,
ContractId int(10),
TaskType varchar(50) not null,
-- CONSTRAINTS
PRIMARY KEY (ID),
FOREIGN KEY (EmployeeID) REFERENCES EMPLOYEES(EMAIL),
FOREIGN KEY (TaskType) REFERENCES TASK_TYPES(Name),
FOREIGN KEY (ContractID) REFERENCES CONTRACTS(ID),
UNIQUE (EmployeeID,ContractID,TaskType)
);

CREATE TABLE TIME_ENTRIES(
ID int(20) not null auto_increment,
EntryDate datetime not null,
TaskID int(10),
HoursWorked decimal(2),
-- CONSTRAINTS
PRIMARY KEY (ID),
FOREIGN KEY (TaskID) REFERENCES ASSIGNED_TASKS(ID)
);

CREATE TABLE DELIVERABLE_TYPES(
ContractType varchar(50) not null,
Num int not null,
DaysToDelivery int,
-- CONSTRAINTS
PRIMARY KEY (ContractType,Num),
FOREIGN KEY (ContractType) REFERENCES CONTRACT_TYPES(Name)
);

INSERT INTO DELIVERABLE_TYPES (ContractType, Num, DaysToDelivery) VALUES
('Gold',1,8), ('Gold',2,14),('Gold',3,20),('Silver',1,15), ('Silver',2,15),('Silver',3,20),('Silver',4,28),
('Premium',1,3), ('Premium',2,5),('Premium',3,10),('Diamond',1,6),('Diamond',2,11),('Diamond',3,18);

CREATE TABLE DELIVERABLES(
ID int(10) not null auto_increment,
ContractID int(10) not null,
Num int not null,
DueDate datetime not null,
DeliveredDate datetime not null,
-- CONSTRAINTS
PRIMARY KEY (ID),
UNIQUE (ContractID, Num),
FOREIGN KEY (ContractID) REFERENCES CONTRACTS(ID)
);


