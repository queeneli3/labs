-- =====================================================
-- COMPREHENSIVE DATABASE SETUP FOR ALL LAB EXERCISES
-- =====================================================
-- This file contains all database and table creation commands
-- for lab exercises 2, 3, 5, and 6
-- 
-- Execute this file in MySQL to set up all required databases
-- =====================================================

-- Set character set and collation
SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- =====================================================
-- LAB 2 EXERCISE 1: WebAppDB
-- =====================================================

-- Create database for Lab 2 Exercise 1
CREATE DATABASE IF NOT EXISTS `WebAppDB` 
CHARACTER SET utf8mb4 
COLLATE utf8mb4_general_ci;

USE `WebAppDB`;

-- Create Users table for Lab 2 Exercise 1
CREATE TABLE IF NOT EXISTS `Users` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(100) NOT NULL,
    `email` VARCHAR(150) NOT NULL UNIQUE,
    `age` INT NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- =====================================================
-- LAB 2 EXERCISE 2: LibrarySystemDB
-- =====================================================

-- Create database for Lab 2 Exercise 2
CREATE DATABASE IF NOT EXISTS `LibrarySystemDB` 
CHARACTER SET utf8mb4 
COLLATE utf8mb4_general_ci;

USE `LibrarySystemDB`;

-- Create Authors table for Lab 2 Exercise 2
CREATE TABLE IF NOT EXISTS `Authors` (
    `author_id` INT AUTO_INCREMENT PRIMARY KEY,
    `author_name` VARCHAR(100) NOT NULL,
    `author_email` VARCHAR(150),
    `author_bio` TEXT,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Create Books table for Lab 2 Exercise 2
CREATE TABLE IF NOT EXISTS `Books` (
    `book_id` INT AUTO_INCREMENT PRIMARY KEY,
    `book_title` VARCHAR(200) NOT NULL,
    `author_id` INT NOT NULL,
    `genre` VARCHAR(50),
    `price` DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    `publication_year` YEAR,
    `isbn` VARCHAR(20),
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (`author_id`) REFERENCES `Authors`(`author_id`) ON DELETE CASCADE ON UPDATE CASCADE,
    INDEX `idx_author_id` (`author_id`),
    INDEX `idx_genre` (`genre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- =====================================================
-- LAB 3 EXERCISE 1: EmployeeDB
-- =====================================================

-- Create database for Lab 3 Exercise 1
CREATE DATABASE IF NOT EXISTS `EmployeeDB` 
CHARACTER SET utf8mb4 
COLLATE utf8mb4_general_ci;

USE `EmployeeDB`;

-- Create Department table for Lab 3 Exercise 1
CREATE TABLE IF NOT EXISTS `Department` (
    `dept_id` INT AUTO_INCREMENT PRIMARY KEY,
    `dept_name` VARCHAR(100) NOT NULL,
    `dept_location` VARCHAR(100),
    `dept_budget` DECIMAL(15,2),
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Create Employee table for Lab 3 Exercise 1
CREATE TABLE IF NOT EXISTS `Employee` (
    `emp_id` INT AUTO_INCREMENT PRIMARY KEY,
    `emp_name` VARCHAR(100) NOT NULL,
    `emp_salary` DECIMAL(10,2) NOT NULL,
    `emp_dept_id` INT NOT NULL,
    `emp_email` VARCHAR(150),
    `emp_phone` VARCHAR(20),
    `hire_date` DATE DEFAULT (CURRENT_DATE),
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (`emp_dept_id`) REFERENCES `Department`(`dept_id`) ON DELETE CASCADE ON UPDATE CASCADE,
    INDEX `idx_dept_id` (`emp_dept_id`),
    INDEX `idx_emp_name` (`emp_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- =====================================================
-- LAB 3 EXERCISE 2: StudentDB
-- =====================================================

-- Create database for Lab 3 Exercise 2
CREATE DATABASE IF NOT EXISTS `StudentDB` 
CHARACTER SET utf8mb4 
COLLATE utf8mb4_general_ci;

USE `StudentDB`;

-- Create Students table for Lab 3 Exercise 2
CREATE TABLE IF NOT EXISTS `Students` (
    `student_id` INT AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(100) NOT NULL,
    `email` VARCHAR(150) NOT NULL UNIQUE,
    `phone_number` VARCHAR(20),
    `date_of_birth` DATE,
    `enrollment_date` DATE DEFAULT (CURRENT_DATE),
    `status` ENUM('active', 'inactive', 'graduated') DEFAULT 'active',
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX `idx_email` (`email`),
    INDEX `idx_status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- =====================================================
-- LAB 5 & LAB 6: LibraryDB2 (Enhanced Library System)
-- =====================================================

-- Create database for Lab 5 and Lab 6
CREATE DATABASE IF NOT EXISTS `LibraryDB2` 
CHARACTER SET utf8mb4 
COLLATE utf8mb4_general_ci;

USE `LibraryDB2`;

-- Create users table for authentication system
CREATE TABLE IF NOT EXISTS `users` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `username` VARCHAR(50) NOT NULL UNIQUE,
    `email` VARCHAR(150) NOT NULL UNIQUE,
    `password` VARCHAR(255) NOT NULL,
    `first_name` VARCHAR(50),
    `last_name` VARCHAR(50),
    `role` ENUM('admin', 'librarian', 'member') DEFAULT 'member',
    `is_active` BOOLEAN DEFAULT TRUE,
    `email_verified` BOOLEAN DEFAULT FALSE,
    `last_login` TIMESTAMP NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX `idx_username` (`username`),
    INDEX `idx_email` (`email`),
    INDEX `idx_role` (`role`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Create Books table for Lab 5 and Lab 6
CREATE TABLE IF NOT EXISTS `Books` (
    `book_id` INT AUTO_INCREMENT PRIMARY KEY,
    `title` VARCHAR(200) NOT NULL,
    `author` VARCHAR(100) NOT NULL,
    `genre` VARCHAR(50),
    `year` YEAR,
    `price` DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    `isbn` VARCHAR(20),
    `quantity` INT DEFAULT 1,
    `available_quantity` INT DEFAULT 1,
    `description` TEXT,
    `publisher` VARCHAR(100),
    `language` VARCHAR(30) DEFAULT 'English',
    `created_by` INT,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (`created_by`) REFERENCES `users`(`id`) ON DELETE SET NULL ON UPDATE CASCADE,
    INDEX `idx_title` (`title`),
    INDEX `idx_author` (`author`),
    INDEX `idx_genre` (`genre`),
    INDEX `idx_year` (`year`),
    INDEX `idx_created_by` (`created_by`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Create members table for library membership
CREATE TABLE IF NOT EXISTS `members` (
    `member_id` INT AUTO_INCREMENT PRIMARY KEY,
    `user_id` INT,
    `member_number` VARCHAR(20) UNIQUE,
    `membership_type` ENUM('basic', 'premium', 'student', 'faculty') DEFAULT 'basic',
    `membership_start_date` DATE DEFAULT (CURRENT_DATE),
    `membership_end_date` DATE,
    `max_books_allowed` INT DEFAULT 5,
    `fine_amount` DECIMAL(8,2) DEFAULT 0.00,
    `status` ENUM('active', 'suspended', 'expired') DEFAULT 'active',
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    INDEX `idx_member_number` (`member_number`),
    INDEX `idx_user_id` (`user_id`),
    INDEX `idx_status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Create bookloans table for tracking book borrowing
CREATE TABLE IF NOT EXISTS `bookloans` (
    `loan_id` INT AUTO_INCREMENT PRIMARY KEY,
    `book_id` INT NOT NULL,
    `member_id` INT NOT NULL,
    `loan_date` DATE DEFAULT (CURRENT_DATE),
    `due_date` DATE NOT NULL,
    `return_date` DATE NULL,
    `fine_amount` DECIMAL(8,2) DEFAULT 0.00,
    `status` ENUM('active', 'returned', 'overdue', 'lost') DEFAULT 'active',
    `notes` TEXT,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (`book_id`) REFERENCES `Books`(`book_id`) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (`member_id`) REFERENCES `members`(`member_id`) ON DELETE CASCADE ON UPDATE CASCADE,
    INDEX `idx_book_id` (`book_id`),
    INDEX `idx_member_id` (`member_id`),
    INDEX `idx_loan_date` (`loan_date`),
    INDEX `idx_due_date` (`due_date`),
    INDEX `idx_status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- =====================================================
-- SAMPLE DATA INSERTION
-- =====================================================

-- Insert sample data for WebAppDB
USE `WebAppDB`;
INSERT IGNORE INTO `Users` (`name`, `email`, `age`) VALUES
('John Doe', 'john.doe@email.com', 25),
('Jane Smith', 'jane.smith@email.com', 30),
('Bob Johnson', 'bob.johnson@email.com', 22),
('Alice Brown', 'alice.brown@email.com', 28),
('Charlie Wilson', 'charlie.wilson@email.com', 35);

-- Insert sample data for LibrarySystemDB
USE `LibrarySystemDB`;
INSERT IGNORE INTO `Authors` (`author_name`, `author_email`, `author_bio`) VALUES
('J.K. Rowling', 'jk.rowling@email.com', 'British author, best known for the Harry Potter series'),
('Stephen King', 'stephen.king@email.com', 'American author of horror, supernatural fiction, suspense, and fantasy novels'),
('Agatha Christie', 'agatha.christie@email.com', 'English writer known for her detective novels'),
('George Orwell', 'george.orwell@email.com', 'English novelist and essayist, journalist and critic'),
('Jane Austen', 'jane.austen@email.com', 'English novelist known for her romantic fiction');

INSERT IGNORE INTO `Books` (`book_title`, `author_id`, `genre`, `price`, `publication_year`, `isbn`) VALUES
('Harry Potter and the Philosopher\'s Stone', 1, 'Fantasy', 15.99, 1997, '9780747532699'),
('The Shining', 2, 'Horror', 12.99, 1977, '9780385121675'),
('Murder on the Orient Express', 3, 'Mystery', 10.99, 1934, '9780007119318'),
('1984', 4, 'Dystopian Fiction', 13.99, 1949, '9780451524935'),
('Pride and Prejudice', 5, 'Romance', 9.99, 1813, '9780141439518');

-- Insert sample data for EmployeeDB
USE `EmployeeDB`;
INSERT IGNORE INTO `Department` (`dept_name`, `dept_location`, `dept_budget`) VALUES
('Human Resources', 'Building A, Floor 2', 500000.00),
('Information Technology', 'Building B, Floor 3', 1200000.00),
('Finance', 'Building A, Floor 1', 800000.00),
('Marketing', 'Building C, Floor 2', 600000.00),
('Operations', 'Building B, Floor 1', 900000.00);

INSERT IGNORE INTO `Employee` (`emp_name`, `emp_salary`, `emp_dept_id`, `emp_email`, `emp_phone`) VALUES
('Sarah Johnson', 65000.00, 1, 'sarah.johnson@company.com', '+1-555-0101'),
('Mike Chen', 85000.00, 2, 'mike.chen@company.com', '+1-555-0102'),
('Lisa Rodriguez', 70000.00, 3, 'lisa.rodriguez@company.com', '+1-555-0103'),
('David Kim', 60000.00, 4, 'david.kim@company.com', '+1-555-0104'),
('Emily Davis', 75000.00, 5, 'emily.davis@company.com', '+1-555-0105');

-- Insert sample data for StudentDB
USE `StudentDB`;
INSERT IGNORE INTO `Students` (`name`, `email`, `phone_number`, `date_of_birth`) VALUES
('Alex Thompson', 'alex.thompson@student.edu', '+1-555-1001', '2000-03-15'),
('Maria Garcia', 'maria.garcia@student.edu', '+1-555-1002', '1999-07-22'),
('James Wilson', 'james.wilson@student.edu', '+1-555-1003', '2001-01-10'),
('Emma Taylor', 'emma.taylor@student.edu', '+1-555-1004', '2000-11-05'),
('Ryan Martinez', 'ryan.martinez@student.edu', '+1-555-1005', '1999-09-18');

-- Insert sample data for LibraryDB2
USE `LibraryDB2`;

-- Insert sample users (passwords are hashed for 'password123')
INSERT IGNORE INTO `users` (`username`, `email`, `password`, `first_name`, `last_name`, `role`) VALUES
('admin', 'admin@library.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Admin', 'User', 'admin'),
('librarian1', 'librarian@library.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'John', 'Librarian', 'librarian'),
('member1', 'member1@library.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Alice', 'Reader', 'member'),
('member2', 'member2@library.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Bob', 'Student', 'member'),
('testuser', 'test@library.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Test', 'User', 'member');

-- Insert sample books
INSERT IGNORE INTO `Books` (`title`, `author`, `genre`, `year`, `price`, `isbn`, `quantity`, `available_quantity`, `created_by`) VALUES
('The Great Gatsby', 'F. Scott Fitzgerald', 'Classic Literature', 1925, 12.99, '9780743273565', 3, 3, 1),
('To Kill a Mockingbird', 'Harper Lee', 'Classic Literature', 1960, 14.99, '9780061120084', 2, 2, 1),
('The Catcher in the Rye', 'J.D. Salinger', 'Classic Literature', 1951, 13.99, '9780316769174', 2, 1, 2),
('Lord of the Flies', 'William Golding', 'Classic Literature', 1954, 11.99, '9780571056866', 4, 4, 2),
('Brave New World', 'Aldous Huxley', 'Science Fiction', 1932, 15.99, '9780060850524', 3, 2, 1),
('The Hobbit', 'J.R.R. Tolkien', 'Fantasy', 1937, 16.99, '9780547928227', 5, 5, 1),
('Dune', 'Frank Herbert', 'Science Fiction', 1965, 18.99, '9780441172719', 2, 1, 2),
('The Alchemist', 'Paulo Coelho', 'Philosophy', 1988, 13.99, '9780061122415', 3, 3, 1);

-- Insert sample members
INSERT IGNORE INTO `members` (`user_id`, `member_number`, `membership_type`, `membership_end_date`, `max_books_allowed`) VALUES
(3, 'LIB001', 'premium', '2024-12-31', 10),
(4, 'LIB002', 'student', '2024-06-30', 5),
(5, 'LIB003', 'basic', '2024-12-31', 3);

-- Insert sample book loans
INSERT IGNORE INTO `bookloans` (`book_id`, `member_id`, `loan_date`, `due_date`, `status`) VALUES
(3, 1, '2024-01-15', '2024-02-15', 'active'),
(5, 2, '2024-01-10', '2024-02-10', 'active'),
(7, 1, '2024-01-20', '2024-02-20', 'active');

-- =====================================================
-- ENABLE FOREIGN KEY CHECKS AND FINALIZE
-- =====================================================

SET FOREIGN_KEY_CHECKS = 1;

-- =====================================================
-- COMPLETION MESSAGE
-- =====================================================

SELECT 'Database setup completed successfully!' AS Message,
       'All databases and tables have been created with sample data.' AS Details,
       'You can now run your lab exercises.' AS Instructions;

-- =====================================================
-- SUMMARY OF CREATED DATABASES AND TABLES
-- =====================================================
/*
DATABASES CREATED:
1. WebAppDB - Lab 2 Exercise 1
   - Users table

2. LibrarySystemDB - Lab 2 Exercise 2
   - Authors table
   - Books table (with foreign key to Authors)

3. EmployeeDB - Lab 3 Exercise 1
   - Department table
   - Employee table (with foreign key to Department)

4. StudentDB - Lab 3 Exercise 2
   - Students table

5. LibraryDB2 - Lab 5 & Lab 6
   - users table (authentication system)
   - Books table (enhanced with more fields)
   - members table (library membership)
   - bookloans table (book borrowing system)

FEATURES INCLUDED:
- Proper indexing for performance
- Foreign key constraints for data integrity
- Default values and auto-increment fields
- UTF8MB4 character set for full Unicode support
- Sample data for testing
- Timestamps for audit trails
- Appropriate data types and constraints

USAGE:
Execute this file in MySQL/phpMyAdmin to set up all databases.
Default password for sample users is 'password123'
*/
