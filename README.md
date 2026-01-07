# 📚 BookBlog - Psychology Books Blog

> A modern platform for sharing opinions about psychology and self-development books

![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black)

## 🎯 About the Project

BookBlog is a minimalist web application created for lovers of psychology and self-development books.  The platform allows users to browse reviews, add their own opinions, and engage in discussions through a nested comment system.

> 🎓 **Academic Project** - This application was created as part of the **Network Programming** course at university.

### ✨ Key Features

- 📖 **Educational Article** - Detailed article about the benefits of reading
- 📝 **Review System** - Add reviews for 5 selected books
- 💬 **Nested Comments** - Multi-level comment replies
- 👥 **Authors** - Showcase of popular self-development book authors
- 💭 **Quotes** - Inspiring quotes from books
- 🔐 **Login System** - Simple authentication mechanism
- ⚡ **AJAX** - Add comments without page reload
- 🕐 **Relative Time** - Display time in "X minutes ago" format

## 🛠️ Technologies

- **Backend:** PHP 7.4+
- **Database:** MySQL 5.7+
- **Frontend:** Vanilla JavaScript (ES6+)
- **Styles:** Custom CSS (no frameworks)
- **Server:** Apache (XAMPP/LAMPP)

## 📋 System Requirements

Before installation, make sure you have: 

- **PHP** >= 7.4
- **MySQL** >= 5.7
- **Apache** (or other web server)
- **XAMPP/LAMPP** (recommended) or
- **MAMP** (for macOS)

## 🚀 Installation

### 1. Clone the repository

```bash
git clone https://github.com/yourusername/book-blog.git
cd book-blog
```

### 2. Start the server (XAMPP/LAMPP)

**Linux:**
```bash
sudo /opt/lampp/lampp start
```

**Windows:**
```
Launch XAMPP Control Panel and start Apache and MySQL
```

**macOS:**
```bash
sudo /Applications/XAMPP/xamppfiles/xampp start
```

### 3. Create the database

```bash
# Linux
/opt/lampp/bin/mysql -u root < database.sql

# Windows (in cmd from XAMPP/mysql/bin folder)
mysql -u root < path/to/database.sql

# macOS
/Applications/XAMPP/xamppfiles/bin/mysql -u root < database.sql
```

Or manually in phpMyAdmin:
1. Open http://localhost/phpmyadmin
2. Create database `messages`
3. Import the `database.sql` file

### 4. Configure database connection

Check the MySQL socket path in files:
- `public/pages/book.php`
- `public/submit.php`

Default configuration:
```php
$conn = new mysqli(
    "localhost",  // host
    "root",       // user
    "",           // password
    "messages",   // database
    3306,         // port
    "/opt/lampp/var/mysql/mysql.sock"  // socket (Linux)
);
```

**Socket paths:**
- Linux: `/opt/lampp/var/mysql/mysql.sock`
- macOS: `/Applications/XAMPP/xamppfiles/var/mysql/mysql.sock`
- Windows: leave `null` or remove the parameter

### 5. Run the application

Copy the project folder to the htdocs directory: 

```bash
# Linux
sudo cp -r book-blog /opt/lampp/htdocs/

# Windows
# Copy to C:\xampp\htdocs\

# macOS
sudo cp -r book-blog /Applications/XAMPP/htdocs/
```

Open your browser: `http://localhost/book-blog/public/`

## 📁 Project Structure

```
book-blog/
├── database.sql              # Database schema
├── README.md                 # Documentation
└── public/                   # Public directory
    ├── index.php            # Main entry point (redirect)
    ├── login. php            # Login page
    ├── logout.php           # Logout
    ├── submit.php           # Form handling
    ├── script. js            # JavaScript (AJAX, UI)
    ├── styles.css           # CSS styles
    ├── images/              # Book covers
    │   ├── atomic-habits.jpg
    │   ├── thinking-fast-and-slow.jpg
    │   ├── the-power-of-now.jpeg
    │   ├── mans-search-for-meaning.jpg
    │   └── the-5am-club.jpg
    ├── components/          # Reusable components
    │   └── nav.php         # Navigation
    └── pages/               # Subpages
        ├── home. php        # Home page (article)
        ├── opinions.php    # Book list
        ├── book.php        # Details and comments
        ├── authors.php     # Authors
        └── quotes.php      # Quotes
```

## 💾 Database Structure

### Table: `messages`

| Column | Type | Description |
|---------|-----|------|
| id | INT (PK, AI) | Unique identifier |
| name | VARCHAR(255) | Username |
| message | TEXT | Comment content |
| parent_id | INT (FK, NULL) | Parent comment ID |
| book_id | INT (NULL) | Book ID |
| created_at | TIMESTAMP | Creation date |

## 🎨 UI Features

### Home page
- Comprehensive article about the benefits of reading
- Scientific research and expert quotes
- Practical tips

### Book Reviews
- 5 books with covers
- Ability to add opinions
- Nested comments
- Dynamic show/hide replies

### Authors
- 6 popular authors
- Brief biographies
- Information about their contributions

### Quotes
- 10 inspiring quotes
- Sources and authors

## 🔐 Login

The system doesn't require a password - just provide a username. This is a simplified version for demonstration purposes.

**Default login:**
- Username: any
- Password: any

## 🚧 Known Limitations

- No password verification
- No registration system
- Book data is hardcoded (not in database)
- No admin panel
- No edit/delete for comments

## 🤝 Contributing

Pull requests are welcome! Before adding major changes, please open an issue to discuss your proposals.

## 📄 License

MIT License - you are free to use this project.

---

**Happy Reading! 📖✨**
