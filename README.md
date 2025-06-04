# 🎓 Laravel Student Portal

A web-based student portal built with **Laravel**, allowing students to register, log in, enroll in courses, submit tasks, and download submissions — while teachers can manage students, courses, and assign tasks.

---

## 🚀 Features

### For Students:
- ✅ User registration & login system  
- 🔐 Secure authentication (Login/Logout)  
- 👥 Enroll in courses under preferred teachers  
- 📥 Submit tasks assigned by teachers  
- 📄 Download submitted task files  

### For Teachers:
- 👤 Manage students (add/view/delete)  
- 📚 Create, update, delete, and manage courses  
- 📝 Assign tasks to specific courses or students  
- 📁 View and download submitted tasks from students  

---

## 🛠️ Technologies Used

- **Backend**: [Laravel](https://laravel.com)  (PHP Framework)  
- **Frontend**: Blade Templates / TailwindCSS or Bootstrap *(Optional)*  
- **Database**: MySQL / PostgreSQL / SQLite  
- **Authentication**: Laravel Breeze / Jetstream  
- **File Handling**: Laravel File Storage  

---

## 🧪 Requirements

Make sure you have the following installed:

- PHP >= 8.1  
- Composer  
- Node.js & NPM *(optional, if using frontend assets)*  
- MySQL / PostgreSQL database  
- Laravel Installer  

---

## 📦 Installation Steps

1. **Clone the repository**
   ```bash
   git clone https://github.com/abdelrhman1beseiso/student-portal.git 
   cd student-portal
   composer install**
   npm install && npm run dev
   cp .env.example .env
   php artisan key:generate
   php artisan migrate
   php artisan serve
