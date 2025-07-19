
CREATE DATABASE IF NOT EXISTS ac_company;
USE ac_company;
CREATE TABLE IF NOT EXISTS jobs (
  id INT AUTO_INCREMENT PRIMARY KEY,
  company_name VARCHAR(100),
  job_received_date DATE,
  job_type VARCHAR(50),
  job_complete_date DATE,
  dealer_name VARCHAR(100),
  brand VARCHAR(50),
  item_description TEXT,
  customer_name VARCHAR(100),
  contact VARCHAR(20),
  address TEXT,
  qty INT,
  complain_number VARCHAR(50),
  outdoor_serial VARCHAR(100),
  technician_name VARCHAR(100),
  remarks TEXT,
  payment_amount DECIMAL(10,2),
  job_completion_status VARCHAR(50),
  last_updated_by VARCHAR(100)
);
