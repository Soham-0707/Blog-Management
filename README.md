# Blog Management System with AJAX Filtering

A modern Blog Management System built using **Laravel**, **MySQL**, **Bootstrap 5**, **jQuery**, and **AJAX**.

This project allows users to browse blogs dynamically while enabling admins to manage blog content through a secure admin panel.

---

# Features

## User Side Features

- View all blogs dynamically from database
- Blog detail page
- Responsive UI for mobile and desktop
- AJAX Search functionality
- AJAX Category filtering
- AJAX Date filtering
- Dynamic blog cards
- Image support
- Responsive design using Bootstrap 5

---

## Admin Panel Features

- Admin Login Authentication
- Add Blog
- Edit Blog
- Delete Blog
- Upload Blog Images
- Manage Blog Content
- Responsive Admin Dashboard

---

# Technologies Used

| Technology | Purpose |
|---|---|
| Laravel 11 | Backend Framework |
| PHP | Server-side Programming |
| MySQL | Database |
| Bootstrap 5 | Responsive UI |
| jQuery | AJAX Handling |
| AJAX | Dynamic Filtering |
| HTML/CSS | Frontend Design |
| Laravel Breeze | Authentication |

---

# Project Structure

```bash
blog-management/
│
├── app/
│   ├── Http/
│   ├── Models/
│
├── public/
│   ├── uploads/
│
├── resources/
│   ├── views/
│   │   ├── layouts/
│   │   ├── blogs/
│   │   ├── admin/blogs/
│
├── routes/
│   ├── web.php
│
├── database/
│   ├── migrations/
│
└── .env
