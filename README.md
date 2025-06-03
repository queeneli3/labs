# Web Application Development Lab Exercises

## 📚 Overview
This repository contains comprehensive lab exercises for a Web Application Development course, covering fundamental to advanced concepts in PHP, MySQL, Object-Oriented Programming, and Web Security.

## 🎯 Course Learning Objectives
- Master PHP fundamentals and database integration
- Understand Object-Oriented Programming principles
- Implement secure web applications
- Learn authentication and session management
- Apply security best practices (CSRF, XSS prevention, SQL injection protection)

## 📁 Repository Structure

```
labs/
├── lab2/                          # Database Integration & Forms
│   ├── lab2_exercise1/           # Basic User Management System
│   └── lab2_exercise2/           # Library Book Management
├── lab3/                          # Advanced Database Operations
│   ├── lab3_exercise1/           # Employee Management System
│   └── lab3_exercise2/           # Student Management System
├── lab4/                          # Object-Oriented Programming
│   ├── lab4_exercise1/           # Basic OOP - Book Class
│   ├── lab4_exercise2/           # Inheritance - Product & Book
│   ├── lab4_exercise3/           # Polymorphism & Interfaces
│   └── lab4_exercise4/           # Advanced OOP - Library System
├── lab5/                          # Authentication & Session Management
└── lab6/                          # Web Security Implementation
├── labs_database_setup.sql       # Complete Database Setup
└── README.md                     # This file
```

## 🗄️ Database Setup

### Quick Setup
Execute the provided SQL file to create all required databases:
```bash
mysql -u root -p < labs_database_setup.sql
```

### Databases Created
1. **WebAppDB** - Lab 2 Exercise 1 (Users table)
2. **LibrarySystemDB** - Lab 2 Exercise 2 (Authors, Books tables)
3. **EmployeeDB** - Lab 3 Exercise 1 (Department, Employee tables)
4. **StudentDB** - Lab 3 Exercise 2 (Students table)
5. **LibraryDB2** - Lab 5 & 6 (users, Books, members, bookloans tables)

## 📋 Lab Exercise Details

### Lab 2: Database Integration & Form Handling
**Learning Focus:** PHP-MySQL integration, form processing, basic CRUD operations

#### Exercise 1: User Management System
- **Database:** WebAppDB
- **Features:** User registration, view users, form validation
- **Files:** `user_form.php`, `process_form.php`, `view_users.php`
- **Key Concepts:** Form handling, input validation, database insertion

#### Exercise 2: Library Book Management
- **Database:** LibrarySystemDB
- **Features:** Author management, book catalog, relational data
- **Files:** `add_book.php`, `process_book.php`, `view_books.php`
- **Key Concepts:** Foreign keys, JOIN operations, relational database design

### Lab 3: Advanced Database Operations
**Learning Focus:** Complex queries, database relationships, error handling

#### Exercise 1: Employee Management System
- **Database:** EmployeeDB
- **Features:** Department-Employee relationships, salary management
- **Files:** `add_employee.php`, `process_employee.php`, `view_employee.php`
- **Key Concepts:** INNER JOIN, foreign key constraints, data relationships

#### Exercise 2: Student Management System
- **Database:** StudentDB
- **Features:** Student enrollment, contact management
- **Files:** `add_student.php`, `insert_student.php`, `view_student.php`
- **Key Concepts:** Data validation, error handling, user feedback

### Lab 4: Object-Oriented Programming
**Learning Focus:** OOP principles, inheritance, polymorphism, interfaces

#### Exercise 1: Basic OOP - Book Class
- **Files:** `Book.php`, `create_book.php`
- **Key Concepts:** Class definition, properties, methods, encapsulation

#### Exercise 2: Inheritance
- **Files:** `Product.php`, `Book.php`, `test_inheritance.php`
- **Key Concepts:** Class inheritance, method overriding, parent-child relationships

#### Exercise 3: Polymorphism & Interfaces
- **Files:** `Product.php`, `Book.php`, `Electronics.php`, `Discountable.php`
- **Key Concepts:** Interfaces, polymorphism, abstract methods

#### Exercise 4: Advanced OOP - Library System
- **Files:** `Book.php`, `Ebook.php`, `Member.php`, `Loanable.php`, `Discountable.php`
- **Key Concepts:** Multiple interfaces, complex inheritance, real-world modeling

### Lab 5: Authentication & Session Management
**Learning Focus:** User authentication, session handling, Google OAuth integration

#### Features Implemented:
- ✅ User registration and login system
- ✅ Session management and authentication checks
- ✅ Google OAuth 2.0 integration
- ✅ Book management with user tracking
- ✅ Secure password hashing
- ✅ Environment variable configuration

#### Key Files:
- `login.php`, `register.php` - Authentication system
- `auth_check.php` - Session management
- `google_login.php`, `google_auth.php` - OAuth integration
- `add_book.php`, `edit_book.php`, `view_books.php` - Book management
- `db_setup.php` - Database configuration with environment loading

#### Security Features:
- Password hashing with `password_hash()`
- Session security with proper checks
- Input validation and sanitization
- Environment-based configuration

### Lab 6: Web Security Implementation
**Learning Focus:** Security best practices, vulnerability prevention, secure coding

#### Security Features Implemented:
- ✅ **CSRF Protection** - Token-based request validation
- ✅ **XSS Prevention** - Input sanitization with `htmlspecialchars()`
- ✅ **SQL Injection Prevention** - Prepared statements
- ✅ **Session Security** - Secure session management
- ✅ **Input Validation** - Server-side validation
- ✅ **Authentication** - Proper access controls

#### Key Files:
- `csrf_token.php` - CSRF token generation and validation
- `test_security.php` - Comprehensive security testing dashboard
- `auth_check.php` - Enhanced authentication with session timeout
- All form files include CSRF protection and input validation

#### Security Testing:
Access `http://localhost/labs/lab6/test_security.php` for comprehensive security assessment

## 🚀 Getting Started

### Prerequisites
- XAMPP/WAMP/LAMP stack
- PHP 8.0+
- MySQL 5.7+
- Web browser

### Installation Steps
1. **Clone/Download** this repository to your web server directory
2. **Start** Apache and MySQL services
3. **Import Database:**
   ```bash
   mysql -u root -p < labs_database_setup.sql
   ```
4. **Configure Environment** (for Lab 5 Google OAuth):
   - Update `.env` file in `lab5/` with your Google OAuth credentials
   - Install dependencies: `composer install` in `lab5/`

### Access URLs
- Lab 2 Ex 1: `http://localhost/labs/lab2/lab2_exercise1/user_form.php`
- Lab 2 Ex 2: `http://localhost/labs/lab2/lab2_exercise2/add_book.php`
- Lab 3 Ex 1: `http://localhost/labs/lab3/lab3_exercise1/add_employee.php`
- Lab 3 Ex 2: `http://localhost/labs/lab3/lab3_exercise2/add_student.php`
- Lab 4: `http://localhost/labs/lab4/lab4_exercise1/create_book.php`
- Lab 5: `http://localhost/labs/lab5/home.php`
- Lab 6: `http://localhost/labs/lab6/home.php`

## 🔧 Technical Implementation

### Database Design
- **Normalized structure** with proper relationships
- **Foreign key constraints** for data integrity
- **Indexes** for performance optimization
- **UTF8MB4** character set for full Unicode support

### Security Implementation
- **Prepared statements** for all database queries
- **CSRF tokens** for form protection
- **XSS prevention** through input sanitization
- **Password hashing** using PHP's `password_hash()`
- **Session security** with proper timeout handling

### Code Quality
- **Consistent coding standards**
- **Error handling** and user feedback
- **Responsive design** for mobile compatibility
- **Clean separation** of concerns

## 📊 Assessment Criteria & Grading Guide

### Lab 2: Database Integration (20 points)
- **Database Design (5 pts):** Proper table structure, relationships, constraints
- **PHP-MySQL Integration (5 pts):** Correct database connections, queries
- **Form Handling (5 pts):** Input validation, error handling, user feedback
- **Code Quality (5 pts):** Clean code, comments, proper structure

### Lab 3: Advanced Database Operations (20 points)
- **Complex Queries (5 pts):** JOIN operations, data relationships
- **Error Handling (5 pts):** Proper exception handling, user-friendly messages
- **Data Validation (5 pts):** Server-side validation, data integrity
- **User Interface (5 pts):** Clean design, usability, responsiveness

### Lab 4: Object-Oriented Programming (25 points)
- **Class Design (7 pts):** Proper encapsulation, properties, methods
- **Inheritance (6 pts):** Correct parent-child relationships, method overriding
- **Polymorphism (6 pts):** Interface implementation, method polymorphism
- **Code Organization (6 pts):** File structure, naming conventions, documentation

### Lab 5: Authentication & Session Management (20 points)
- **Authentication System (5 pts):** Login/register functionality, password security
- **Session Management (5 pts):** Proper session handling, security checks
- **Google OAuth Integration (5 pts):** Working OAuth implementation
- **Security Implementation (5 pts):** Input validation, secure coding practices

### Lab 6: Web Security (15 points)
- **CSRF Protection (4 pts):** Token generation, validation, implementation
- **XSS Prevention (4 pts):** Input sanitization, output encoding
- **SQL Injection Prevention (3 pts):** Prepared statements, secure queries
- **Security Testing (4 pts):** Comprehensive testing, documentation

## 🧪 Testing Instructions for Lecturers

### Automated Testing
1. **Database Setup:** Run `labs_database_setup.sql` to create all databases
2. **Security Assessment:** Access `lab6/test_security.php` for automated security tests
3. **Functionality Testing:** Use provided sample data for testing all features

### Manual Testing Checklist

#### Lab 2 Testing:
- [ ] User registration with validation
- [ ] User data display and formatting
- [ ] Book addition with author relationships
- [ ] Error handling for invalid inputs

#### Lab 3 Testing:
- [ ] Employee-Department relationships
- [ ] Student enrollment process
- [ ] Data integrity and validation
- [ ] JOIN query functionality

#### Lab 4 Testing:
- [ ] Object instantiation and methods
- [ ] Inheritance behavior
- [ ] Interface implementation
- [ ] Polymorphic behavior

#### Lab 5 Testing:
- [ ] User registration and login
- [ ] Session persistence
- [ ] Google OAuth flow (requires setup)
- [ ] Book management with user tracking

#### Lab 6 Testing:
- [ ] CSRF token validation
- [ ] XSS attack prevention
- [ ] SQL injection attempts
- [ ] Security test dashboard

## 🔍 Common Issues & Solutions

### Database Connection Issues
```php
// Check database credentials in each lab's config file
$servername = "localhost";
$username = "root";
$password = "";
```

### Session Management Issues
- Ensure `session_start()` is called before any output
- Check for proper session checks in `auth_check.php`

### Google OAuth Setup (Lab 5)
1. Create Google Cloud Project
2. Enable Google+ API
3. Create OAuth 2.0 credentials
4. Update `.env` file with credentials
5. Run `composer install` in lab5 directory

### Security Testing (Lab 6)
- Access security dashboard at `lab6/test_security.php`
- All tests should show "PASS" status
- Review security recommendations

## 📝 Sample Test Data

### Default Login Credentials (Lab 5 & 6):
- **Username:** admin
- **Password:** password123
- **Email:** admin@library.com

### Sample Data Included:
- **Users:** 5 sample users in WebAppDB
- **Books:** 5 sample books with authors in LibrarySystemDB
- **Employees:** 5 employees across 5 departments in EmployeeDB
- **Students:** 5 enrolled students in StudentDB
- **Library System:** Complete user and book data in LibraryDB2

## 🏆 Expected Learning Outcomes

Upon completion, students should demonstrate:

1. **Database Proficiency:**
   - Design normalized database schemas
   - Write complex SQL queries with JOINs
   - Implement proper data relationships

2. **PHP Development Skills:**
   - Handle forms and user input securely
   - Implement session management
   - Create object-oriented applications

3. **Security Awareness:**
   - Prevent common web vulnerabilities
   - Implement authentication systems
   - Apply security best practices

4. **Professional Development:**
   - Write clean, maintainable code
   - Document code and systems
   - Test and debug applications

## 📞 Support & Documentation

### File Structure Reference:
- **Database schemas:** See `labs_database_setup.sql`
- **Security implementation:** Check `lab6/test_security.php`
- **Authentication flow:** Review `lab5/auth_check.php`
- **OOP examples:** Examine `lab4/` directory structure

### Troubleshooting:
1. **Database errors:** Verify MySQL service and credentials
2. **Session issues:** Check PHP session configuration
3. **Security warnings:** Review input validation and sanitization
4. **OAuth errors:** Verify Google Cloud setup and credentials

---
