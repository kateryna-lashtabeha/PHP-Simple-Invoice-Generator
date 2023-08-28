-- DB CREATING
CREATE DATABASE IF NOT EXISTS TestSPApp;

-- Table Customers
DROP TABLE IF EXISTS `customers`;
CREATE TABLE `customers` (`name` varchar(20) NOT NULL);

ALTER TABLE `customers` ADD `id` INT PRIMARY KEY AUTO_INCREMENT;

-- Table Jobs
DROP TABLE IF EXISTS `jobs`;
CREATE TABLE `jobs` (`name` varchar(100) NOT NULL);

ALTER TABLE `jobs` ADD `id` INT PRIMARY KEY AUTO_INCREMENT;

-- Table Locations
DROP TABLE IF EXISTS `locations`;
CREATE TABLE `locations` (`name` varchar(100) NOT NULL);

ALTER TABLE `locations` ADD `id` INT PRIMARY KEY AUTO_INCREMENT;

-- Table Statuses
DROP TABLE IF EXISTS `statuses`;
CREATE TABLE `statuses` (`status` varchar(20) NOT NULL);

ALTER TABLE `statuses` ADD `id` INT PRIMARY KEY AUTO_INCREMENT;

-- Table Staff
DROP TABLE IF EXISTS `staff`;
CREATE TABLE `staff` (`name` varchar(50) NOT NULL);

ALTER TABLE `staff` ADD `id` INT PRIMARY KEY AUTO_INCREMENT;

-- Table Positions
DROP TABLE IF EXISTS `positions`;
CREATE TABLE `positions` (
  `name` varchar(20) NOT NULL,
  `hourly_regular_rate` decimal(4, 2) NOT NULL,
  `hourly_overtime_rate` decimal(4, 2) NOT NULL,
  `fixed_regular_rate` decimal(4, 2) NOT NULL,
  `fixed_overtime_rate` decimal(4, 2) NOT NULL
);

ALTER TABLE `positions` ADD `id` INT PRIMARY KEY AUTO_INCREMENT;

-- Table Trucks
DROP TABLE IF EXISTS `trucks`;
CREATE TABLE `trucks` (
  `name` varchar(20) NOT NULL,
  `hourly_rate` decimal(4, 4) NOT NULL,
  `fixed_rate` decimal(4, 4) NOT NULL
);

ALTER TABLE `trucks` ADD `id` INT PRIMARY KEY AUTO_INCREMENT;

-- Table Invoices
DROP TABLE IF EXISTS `invoices`;
CREATE TABLE `invoices` (
  `date` date NOT NULL,
  `ordered_by` varchar(20),
  `area` varchar(20),
  `description` varchar(1000) NOT NULL
);

ALTER TABLE `invoices` ADD `id` INT PRIMARY KEY AUTO_INCREMENT;

-- Table Invoice_labours
DROP TABLE IF EXISTS `invoice_labours`;
CREATE TABLE `invoice_labours` (
  `regular_rate_value` decimal(4, 2) DEFAULT 0,
  `regular_hours` decimal(4, 2) DEFAULT 0,
  `overtime_rate_value` decimal(4, 2) DEFAULT 0,
  `overtime_hours` decimal(4, 2) DEFAULT 0
);

ALTER TABLE `invoice_labours` ADD `id` INT PRIMARY KEY AUTO_INCREMENT;

-- Table Invoice_trucks
DROP TABLE IF EXISTS `invoice_trucks`;
CREATE TABLE `invoice_trucks` (
  `truck_quantity` int NOT NULL,
  `truck_rate` decimal(4, 2) NOT NULL,
  `overtime_hours` decimal(4, 2) DEFAULT 0
);

ALTER TABLE `invoice_trucks` ADD `id` INT PRIMARY KEY AUTO_INCREMENT;

-- Table Invoice_misc
DROP TABLE IF EXISTS `invoice_misc`;
CREATE TABLE `invoice_misc` (
  `description` varchar(500) NOT NULL,
  `cost` int NOT NULL,
  `price` int NOT NULL,
  `quantity` int NOT NULL
);

ALTER TABLE `invoice_misc` ADD `id` INT PRIMARY KEY AUTO_INCREMENT;


-- Add FOREINN KEYS
ALTER TABLE jobs ADD COLUMN customer_id INT NOT NULL;
ALTER TABLE jobs ADD FOREIGN KEY (customer_id) REFERENCES customers(id);

ALTER TABLE locations ADD COLUMN job_id INT NOT NULL;
ALTER TABLE locations ADD FOREIGN KEY (job_id) REFERENCES jobs(id);

ALTER TABLE positions ADD COLUMN staff_id INT NOT NULL;
ALTER TABLE positions ADD FOREIGN KEY (staff_id) REFERENCES staff(id);

ALTER TABLE invoices 
  ADD COLUMN customer_id INT NOT NULL,
  ADD COLUMN job_id INT NOT NULL,
  ADD COLUMN location_id INT NOT NULL,
  ADD COLUMN status_id INT NOT NULL;

ALTER TABLE invoices
  ADD FOREIGN KEY (customer_id) REFERENCES customers(id),
  ADD FOREIGN KEY (job_id) REFERENCES jobs(id),
  ADD FOREIGN KEY (location_id) REFERENCES locations(id),
  ADD FOREIGN KEY (status_id) REFERENCES statuses(id);

ALTER TABLE invoice_labours 
  ADD COLUMN invoice_id INT NOT NULL,
  ADD COLUMN staff_id INT NOT NULL,
  ADD COLUMN position_id INT NOT NULL;
  
ALTER TABLE invoice_labours
  ADD FOREIGN KEY (invoice_id) REFERENCES invoices(id),
  ADD FOREIGN KEY (staff_id) REFERENCES staff(id),
  ADD FOREIGN KEY (position_id) REFERENCES positions(id);

ALTER TABLE invoice_trucks ADD COLUMN invoice_id INT NOT NULL;
ALTER TABLE invoice_trucks
  ADD FOREIGN KEY (invoice_id) REFERENCES invoices(id);

ALTER TABLE invoice_misc ADD COLUMN invoice_id INT NOT NULL;
ALTER TABLE invoice_misc
  ADD FOREIGN KEY (invoice_id) REFERENCES invoices(id);


-- Population of DB with test data
INSERT INTO statuses (status) VALUES ('Active'), ('Pending'), ('Closed');

INSERT INTO customers (name) VALUES ('ABC Company'), ('ACME Inc.'), ('Custom Import');

INSERT INTO jobs (name, customer_id) VALUES
  ('#100 CVS Controls material smth.', 1),
  ('#110 Material Controls CVS', 1),
  ('#111 Process of controlling materials', 1),
  ('#114 Delivery 1', 2),
  ('#115 Delivery 2', 2),
  ('#125 Preparing to import', 3),
  ('#250 Classifying goods', 3);

INSERT INTO locations (name, job_id) VALUES
  ('Location 1', 1),
  ('Location 2', 1),
  ('Location 3', 1),
  ('Location 4', 1),
  ('Location 5', 2),
  ('Location 6', 2),
  ('Location 7', 3),
  ('Location 8', 3),
  ('Location 9', 3),
  ('Location 10', 4),
  ('Location 11', 4),
  ('Location 12', 5),
  ('Location 13', 5),
  ('Location 14', 5),
  ('Location 15', 6),
  ('Location 16', 7),
  ('Location 17', 7),
  ('Location 18', 7);

INSERT INTO staff (name) VALUES ('Staff 1'), ('Staff 2'), ('Staff 3');

INSERT INTO positions (name, hourly_regular_rate,	hourly_overtime_rate,	fixed_regular_rate,	fixed_overtime_rate,	staff_id) VALUES
  ('Position 1', 3.5, 4.5, 15, 20, 1),
  ('Position 2', 4.5, 4.8, 25, 35, 1),
  ('Position 3', 3.8, 4.7, 15.5, 22, 2),
  ('Position 4', 3.7, 4.2, 15.4, 21.24, 2),
  ('Position 5', 4.8, 5.7, 17.5, 27.1, 3),
  ('Position 6', 5.5, 6.7, 22.5, 30.0, 3);

INSERT INTO trucks (name, hourly_rate, fixed_rate) VALUES
  ('105 - Truck1', 25, 95),
  ('205 - Truck2', 35, 140),
  ('314 - Truck3', 86, 220);

-- INSERT INTO invoices (date, ordered_by, area, description, customer_id, job_id,	location_id, status_id,	staff_id,	position_id) VALUES ('2023-08-24', 'Mike', 'test', 'A very cool description', '1', '1',	'1', '1',	'1'	'1');
-- INSERT INTO invoice_labours (regular_rate_value, regular_hours, overtime_rate_value, overtime_hours, invoice_id) VALUES (18.0, 2, 25.5, 0, 1);
-- INSERT INTO `invoice_misc` (description, cost, price, quantity, invoice_id) VALUES ('A very long and boring description', 12.99, 15.84, 2, 1);
-- INSERT INTO `invoice_trucks` (truck_quantity, truck_rate, overtime_hours, invoice_id) VALUES (1, 15.00, 0, 1);
