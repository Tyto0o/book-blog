# 📚 BookBlog - Blog o Książkach Psychologicznych

> Nowoczesna platforma do dzielenia się opiniami o książkach z zakresu psychologii i samorozwoju

![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black)

## 🎯 O Projekcie

BookBlog to minimalistyczna aplikacja webowa stworzona dla miłośników książek psychologicznych i o samorozwoju. Platforma umożliwia użytkownikom przeglądanie recenzji, dodawanie własnych opinii oraz prowadzenie dyskusji w formie zagnieżdżonych komentarzy.

> 🎓 **Projekt akademicki** - Aplikacja powstała w ramach przedmiotu **Programowanie Sieciowe** na studiach.

### ✨ Główne Funkcjonalności

- 📖 **Artykuł edukacyjny** - Szczegółowy artykuł o korzyściach płynących z czytania
- 📝 **System opinii** - Dodawanie opinii o 5 wybranych książkach
- 💬 **Komentarze zagnieżdżone** - Wielopoziomowe odpowiedzi na komentarze
- 👥 **Autorzy** - Prezentacja popularnych autorów książek o samorozwoju
- 💭 **Cytaty** - Inspirujące cytaty z książek
- 🔐 **System logowania** - Prosty mechanizm uwierzytelniania
- ⚡ **AJAX** - Dodawanie komentarzy bez przeładowania strony
- 🕐 **Czas względny** - Wyświetlanie czasu w formacie "X minut temu"

## 🛠️ Technologie

- **Backend:** PHP 7.4+
- **Baza danych:** MySQL 5.7+
- **Frontend:** Vanilla JavaScript (ES6+)
- **Style:** Custom CSS (bez frameworków)
- **Serwer:** Apache (XAMPP/LAMPP)

## 📋 Wymagania Systemowe

Przed instalacją upewnij się, że masz zainstalowane:

- **PHP** >= 7.4
- **MySQL** >= 5.7
- **Apache** (lub inny serwer WWW)
- **XAMPP/LAMPP** (zalecane) lub
- **MAMP** (dla macOS)

## 🚀 Instalacja

### 1. Sklonuj repozytorium

```bash
git clone https://github.com/yourusername/book-blog.git
cd book-blog
```

### 2. Uruchom serwer (XAMPP/LAMPP)

**Linux:**
```bash
sudo /opt/lampp/lampp start
```

**Windows:**
```
Uruchom XAMPP Control Panel i wystartuj Apache i MySQL
```

**macOS:**
```bash
sudo /Applications/XAMPP/xamppfiles/xampp start
```

### 3. Utwórz bazę danych

```bash
# Linux
/opt/lampp/bin/mysql -u root < database.sql

# Windows (w cmd z folderu XAMPP/mysql/bin)
mysql -u root < ścieżka/do/database.sql

# macOS
/Applications/XAMPP/xamppfiles/bin/mysql -u root < database.sql
```

Lub ręcznie w phpMyAdmin:
1. Otwórz http://localhost/phpmyadmin
2. Utwórz bazę danych `messages`
3. Zaimportuj plik `database.sql`

### 4. Konfiguracja połączenia z bazą danych

Sprawdź ścieżkę do socketu MySQL w plikach:
- `public/pages/book.php`
- `public/submit.php`

Domyślna konfiguracja:
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

**Ścieżki socketów:**
- Linux: `/opt/lampp/var/mysql/mysql.sock`
- macOS: `/Applications/XAMPP/xamppfiles/var/mysql/mysql.sock`
- Windows: pozostaw `null` lub usuń parametr

### 5. Uruchom aplikację

Skopiuj folder projektu do katalogu htdocs:

```bash
# Linux
sudo cp -r book-blog /opt/lampp/htdocs/

# Windows
# Skopiuj do C:\xampp\htdocs\

# macOS
sudo cp -r book-blog /Applications/XAMPP/htdocs/
```

Otwórz przeglądarkę: `http://localhost/book-blog/public/`

## 📁 Struktura Projektu

```
book-blog/
├── database.sql              # Schemat bazy danych
├── README.md                 # Dokumentacja
└── public/                   # Publiczny katalog
    ├── index.php            # Główny punkt wejścia (przekierowanie)
    ├── login.php            # Strona logowania
    ├── logout.php           # Wylogowanie
    ├── submit.php           # Obsługa formularzy
    ├── script.js            # JavaScript (AJAX, UI)
    ├── styles.css           # Style CSS
    ├── images/              # Okładki książek
    │   ├── atomic-habits.jpg
    │   ├── thinking-fast-and-slow.jpg
    │   ├── the-power-of-now.jpeg
    │   ├── mans-search-for-meaning.jpg
    │   └── the-5am-club.jpg
    ├── components/          # Komponenty wielokrotnego użytku
    │   └── nav.php         # Nawigacja
    └── pages/               # Podstrony
        ├── home.php        # Strona główna (artykuł)
        ├── opinions.php    # Lista książek
        ├── book.php        # Szczegóły i komentarze
        ├── authors.php     # Autorzy
        └── quotes.php      # Cytaty
```

## 💾 Struktura Bazy Danych

### Tabela: `messages`

| Kolumna | Typ | Opis |
|---------|-----|------|
| id | INT (PK, AI) | Unikalny identyfikator |
| name | VARCHAR(255) | Nazwa użytkownika |
| message | TEXT | Treść komentarza |
| parent_id | INT (FK, NULL) | ID komentarza nadrzędnego |
| book_id | INT (NULL) | ID książki |
| created_at | TIMESTAMP | Data utworzenia |

## 🎨 Funkcjonalności UI

### Strona główna
- Rozbudowany artykuł o korzyściach czytania
- Badania naukowe i cytaty ekspertów
- Praktyczne wskazówki

### Opinie o książkach
- 5 książek z okładkami
- Możliwość dodawania opinii
- Zagnieżdżone komentarze
- Dynamiczne pokazywanie/ukrywanie odpowiedzi

### Autorzy
- 6 popularnych autorów
- Krótkie biografie
- Informacje o ich wkładzie

### Cytaty
- 10 inspirujących cytatów
- Źródła i autorzy

## 🔐 Logowanie

System nie wymaga hasła - wystarczy podać login. To uproszczona wersja do celów demonstracyjnych.

**Domyślne logowanie:**
- Login: dowolny
- Hasło: dowolne

## 🚧 Znane Ograniczenia

- Brak weryfikacji hasła
- Brak systemu rejestracji
- Dane książek są hardcoded (nie w bazie)
- Brak panelu admina
- Brak edycji/usuwania komentarzy

## 🤝 Wkład w Projekt

Pull requesty są mile widziane! Przed dodaniem dużych zmian, otwórz issue aby przedyskutować propozycje.

## 📄 Licencja

MIT License - możesz swobodnie używać tego projektu.

---

**Happy Reading! 📖✨**