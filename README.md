# laravel_Task_Management_System
Basic Task Management System with Login 
✨ Key Features
•	Full CRUD Lifecycle: Create, Read, Update, and Delete tasks with a clean Bootstrap UI.
•	Asynchronous Status Toggling: Update task completion status instantly using AJAX (Fetch API) without page reloads.
•	Form Validation: Server-side validation with real-time Bootstrap error feedback for mandatory fields.

## 🛠 Tech Stack
* **Framework:** Laravel 12.53.0
* **Language:** PHP 8.2.12
* **Frontend:** Bootstrap 5.3 (Vanilla JS / Fetch API)
* **Database:** MySQL (with Eloquent ORM & Soft Deletes)
* **Tools:** Composer
🧠 Assumptions
In building this project, I made the following technical assumptions:
•	PHP Version: Assumed PHP 8.2+ as required by Laravel 12.
•	Database: Configured for MySQL (or SQLite if that's what you used).
•	Authentication: Assumed only registered users should manage tasks (handled via auth middleware).
•	Soft Deletes: Assumed "deleting" a task should preserve data in the background for safety rather than permanent removal.
📋 Prerequisites
•	Local Server: XAMPP, supporting PHP 8.2+ and MySQL.
•	Composer: For managing PHP dependencies.
## 👤 Admin Access & Logic
For the purpose of this CRUD, the application identifies the **Administrator** based on the Primary Key:
* **User ID 1** is granted Admin privileges.
* **Admin Features:** Only User ID 1 can view the "all the task added on Admin Dashboard" and delete any task.



### 👤 Admin Account Setup
Since this application uses **User ID 1** for Administrative privileges, you must create at least two users. You can do this quickly via Laravel Tinker:

1. Open Tinker:
   ```bash
   php artisan tinker
2. Run these commands to create the Admin (ID 1):
$user = new App\Models\User();
$user->name = "Admin";
$user->email = "admin@gmail.com";
$user->password = Hash::make('123');
$user->save();

Note: The application uses User ID 1 as the Administrator. To ensure you have access to admin-only features (like deleting any task), the very first user you create must be your Admin account
