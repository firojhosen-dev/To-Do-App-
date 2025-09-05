# To-Do List Application

A full-featured, advanced To-Do List web application built with **PHP**, **MySQL**, **JavaScript**, **HTML**, and **CSS**.

---

# Features

- User Registration and Login (with password hashing)
- Add, Edit, Delete (Soft Delete) and Complete Tasks
- Set Task Deadline and Priority (High, Medium, Low)
- Search, Sort (A-Z, Z-A, Deadline Asc/Desc), and Filter Tasks by Priority
- Responsive UI with Dark Mode toggle
- Drag & Drop Task Reordering
- Export Tasks as CSV, PDF, and JSON
- User-specific task management with secure session authentication
- Task Details view page
- Toast notifications and alerts
- Secure against common vulnerabilities (XSS, CSRF, SQL Injection)
- Pagination support for tasks
- Profile page with user info

---

# Technologies Used

- Backend: PHP 7+
- Database: MySQL
- Frontend: HTML5, CSS3, JavaScript (AJAX, DOM Manipulation)
- Libraries: [FPDF](http://www.fpdf.org/) (for PDF export)

---

# Installation & Setup

1. **Clone the repository:**
    ```bash
    git clone https://github.com/your-username/todo-list-app.git
    cd todo-list-app
    ```

2. **Database Setup:**
   - Create a MySQL database (default name: `todo_app`)
   - Import the `database.sql` file into your MySQL server:
     ```bash
     mysql -u your_username -p todo_app < database.sql
     ```
   - Update the database connection in `config/db.php` with your MySQL credentials.

3. **Configure Web Server:**
   - Place the project in your web root directory (e.g., `htdocs` or `www`).
   - Ensure PHP is installed and configured properly.
   - Start your web server (Apache, Nginx, etc.).

4. **Install Dependencies:**
   - Download and place the FPDF library inside `vendor/fpdf/` folder for PDF export functionality.
   - [FPDF Download Link](http://www.fpdf.org/en/download.php)

5. **Access the Application:**
   - Open your browser and go to `http://localhost/your-project-folder/`
   - Register a new user and start managing your tasks!

---

## 📁 Project Structure Requirement (for Running the Code)

To ensure the project runs successfully, it is important to maintain the correct folder structure. Before running the code, please create the required folders as shown in the file structure below, and place the respective files inside them accordingly. Failure to follow the correct structure may lead to runtime errors or malfunctioning of the application.

---
# Folder Structure


```text
todo-app/
├── config/
│   └── db.php # Database connection
│
├── assets/
│   ├── css/
│   │   ├── addTask.css
│   │   ├── contact.css
│   │   ├── dashboard.css
│   │   └── login_register.css
│   │
│   ├── js/
│   │   ├── addTask.js
│   │   └── login_register.js
│   │
│   ├── style.css # Global stylesheet
│   ├── script.js # Custom JS (dark mode, drag-drop, etc.)
│   └── toast.js # Toast notification handler
│
├── auth/
│   ├── login.php # User login
│   ├── register.php # User registration
│   └── logout.php # Logout and session destroy
│
├── tasks/
│   ├── dashboard.php # Main dashboard with task cards
│   ├── view.php # Single task full description
│   ├── add_task.php # Task creation handler
│   ├── edit_task.php # Task edit handler (AJAX optional)
│   ├── delete_task.php # Soft delete handler
│   └── complete_task.php # Mark task as completed (AJAX)
│
├── includes/
│   ├── header.php # Reusable header
│   ├── footer.php # Reusable footer
│   └── auth_check.php # Session check for protected pages
│
├── exports/
│   ├── export_pdf.php # Export tasks to PDF
│   └── export_csv.php # Export tasks to CSV
│
├── img/
│   ├── CompanyLogo.png
│   ├── FirojProfileLogo.jpg
│   ├── LoginImage.png
│   └── RegisterImage.png
│
├── index.php # Redirect to login or dashboard
├── README.md # Project description
├── database.sql # SQL file to create all tables
└── LICENSE


---

# ⚠ Note:
Please ensure that all files and folders are placed exactly as shown above. Renaming or misplacing them might prevent the project from working as expected.

---

# 🛠 How to Run

1. *Clone the repository or download the ZIP.*
2. *Create the folder structure as shown.*
3. *Place all files in their respective folders.*
4. *Open the project in your preferred editor (e.g., VS Code).*
5. *Run the project using Live Server or any supported method.*

---

# Security Considerations

- Passwords are hashed securely using `password_hash()`.
- Prepared statements used for all database queries (PDO).
- Basic input validation and sanitization in place.
- CSRF protection should be implemented for form submissions (future enhancement).
- XSS prevention by escaping output with `htmlspecialchars()`.

---

# Contribution

Feel free to fork the repository and submit pull requests for improvements or bug fixes.

---

# Creator

## 👨‍💻 About the Creator

This project was created by **Firoj Hosen**, a passionate self-taught Full Stack Web Developer from Bangladesh. With a strong dedication to clean code, practical solutions, and real-world applications, **Firoj** enjoys building tools that are not only functional but also user-friendly.

He specializes in front-end and back-end technologies such as *HTML, CSS, JavaScript, PHP, and MySQL*, and often explores new technologies to improve his skills. This To-Do List Application is a reflection of his commitment to learning and creating useful software that simplifies daily life.

> “I believe in building projects that solve real problems and help people stay productive.”  
> — **Firoj Hosen**

Connect with **Firoj**:  
- GitHub: [https://github.com/firojhosen-dev](https://github.com/yourusername)  
- LinkedIn: [https://www.linkedin.com/in/firojhossendev](https://linkedin.com/in/yourprofile)  
<!-- - Portfolio: [yourwebsite.com](https://yourwebsite.com) -->

---

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.


