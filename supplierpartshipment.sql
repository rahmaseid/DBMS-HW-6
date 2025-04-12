CREATE TABLE SUPPLIER (
	Sno char(2) PRIMARY KEY,
    Sname varchar(25) NOT NULL,
    Status INT CHECK (Status > 0),
    City varchar(25)
);

-- Here we are creating the PART table
CREATE TABLE PART(
	Pno char(2) PRIMARY KEY NOT NULL,
    Pname varchar(25) NOT NULL,
    Color varchar(25),
    Weight INT CHECK(Weight >= 1 AND Weight <= 100) NOT NULL,
    City varchar(25),
    UNIQUE (Pname, Color)
);

-- Here we are creating the SHIPMENT table
CREATE TABLE SHIPMENT (
	Sno char(2),
    Pno char(2),
    Qty INT DEFAULT 100,
    Price FLOAT CHECK(Price > 0),
    FOREIGN KEY (Sno) REFERENCES SUPPLIER(Sno),
    FOREIGN KEY (Pno) REFERENCES PART(Pno)

);

INSERT INTO SUPPLIER (Sno, Sname, Status, City) Values
	('s1', 'Smith', 20, 'London'),
    ('s2','Jones', 10, 'Paris'),
    ('s3','Blake', 30, 'Paris'),
    ('s4','Clark', 20, 'London'),
    ('s5','Adams', 30, NULL);
 

-- Here, we'll insert data into PART table
INSERT INTO PART (Pno, Pname, Color, Weight, City) Values
	('p1', 'NUT', 'Red', 12, 'London'),
    ('p2', 'BOLT', 'Green', 17, 'Paris'),
    ('p3', 'SCREW', NULL, 17, 'Rome'),
    ('p4', 'SCREW', 'Red', 14, 'London'),
    ('p5', 'CAM', 'Blue', 12, 'Paris'),
    ('p6', 'COG', 'Red', 19, 'London');


INSERT INTO SHIPMENT (Sno, Pno, Qty, Price) Values
	('s1', 'p1', 300, .005),
    ('s1', 'p2', 200, .009),
    ('s1', 'p3', 400, .004),
    ('s1', 'p4', 200, .009),
    ('s1', 'p5', 100, .01),
    ('s1', 'p6', 100, .01),
    ('s2', 'p1', 300, .006),
    ('s2', 'p2', 400, .004),
    ('s3', 'p2', 400, .009),
    ('s3', 'p3', 200, NULL),
    ('s4', 'p2', 200, .008),
    ('s4', 'p3', NULL, NULL),
    ('s4', 'p4', 300, .006),
    ('s4', 'p5', 400, .003);
