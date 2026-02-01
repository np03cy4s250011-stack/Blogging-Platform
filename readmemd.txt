# Blog CMS – PHP & MySQL

A simple blogging Content Management System built for the Full Site Implementation assignment. It demonstrates CRUD operations, search, secure coding practices, and an Ajax "Load more posts" feature. [file:41]

## 1. Features

- Create, read, update, and delete blog posts.
- Search posts by keyword or author.
- Ajax "Load more" button to fetch posts without page reload.
- Basic security:
  - Prepared statements to prevent SQL injection.
  - `htmlspecialchars()` output escaping to prevent XSS.
  - CSRF token for form submission.
- Responsive layout with CSS media queries (desktop, tablet, mobile). [file:41][web:47]

## 2. Technology Stack

- PHP (PDO for database access).
- MySQL (or MariaDB).
- HTML5 with semantic tags.
- CSS3 with flexbox and media queries.
- Vanilla JavaScript (Fetch API for Ajax). [file:41][web:59]

## 3. Folder Structure

```text
project_root/
│── config/
│   └── db.php
│── public/
│   ├── index.php
│   ├── add.php
│   ├── edit.php
│   ├── delete.php
│   ├── search.php
│   └── load_more.php
│── assets/
│   ├── css/
│   │   └── style.css
│   └── js/
│       └── app.js
└── includes/
    ├── header.php
    ├── footer.php
    └── functions.php

4. Setup Instructions
Clone or copy project to server

Place the project folder inside the school student server web root (for example htdocs/blog_cms).

Create database

Create a new database, e.g. blog_cms.

Run the SQL below in phpMyAdmin or CLI:
CREATE TABLE posts (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255) NOT NULL,
  author VARCHAR(100) NOT NULL,
  category VARCHAR(100) NOT NULL,
  tags VARCHAR(255) DEFAULT NULL,
  content TEXT NOT NULL,
  created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

Configure database connection

Open config/db.php and set:
$host = 'localhost';
$db   = 'blog_cms';
$user = 'YOUR_DB_USERNAME';
$pass = 'YOUR_DB_PASSWORD';

Access the site

In the browser, go to: http://your-student-server/blog_cms/public/index.php.

These steps align with the assignment requirement to design and implement a dynamic PHP + MySQL site and host it on the student server.

5. Usage
Add a post: Add Post link → fill the form → submit.

Edit a post: On the posts list, click the post title (linked to edit.php) → update fields → submit.

Delete a post: Use delete.php?id=POST_ID, confirm deletion.

Search posts: Use the header search bar or go directly to search.php?q=keyword.

Load more posts: On the home page, press the Load more button; more posts load via Ajax without reloading the page.

6. Security Details
SQL Injection: All database operations use PDO prepared statements with bound parameters.

XSS: Output is escaped using htmlspecialchars() via the e() helper in includes/functions.php.

CSRF: Forms include a hidden csrf_token generated in the session and validated on POST requests.

Validation: Basic server-side validation checks required fields; client-side validation can be extended with HTML5 attributes and JavaScript.

7. Known Issues
No pagination for the search results page yet.

No image upload feature implemented.

No user authentication; any visitor can add/edit/delete posts (can be extended in future).

You can adjust wording (especially section 7) to match your actual database users or any extra features you implement.
