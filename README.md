# SupportTicketSystem

## Prerequisites
- Ensure you have **Composer** and **Node.js** installed on your system.
- Install a code editor like **VS Code**.

## Installation Steps

### 1. Open the Cloned Project
Open the cloned project in **VS Code** or any code editor of your choice.

### 2. Install PHP Dependencies
Run the following command in the terminal to install required PHP dependencies:
```sh
composer install
```

### 3. Setup Environment File
Create a `.env` file in the project root and copy the contents of `.env.example` into it.

### 4. Generate Application Key
Run the following command to generate an application key inside the `.env` file:
```sh
php artisan key:generate
```

### 5. Configure Database
Update the following lines in the `.env` file with your database credentials:
```env
DB_DATABASE=your_db_name
DB_USERNAME=your_db_user
DB_PASSWORD=your_db_password
```

### 6. Configure Mail
Add your mail credentials inside the `.env` file.

### 7. Migrate Database
Run the following command to create tables in the database:
```sh
php artisan migrate
```

### 8. Install Node Dependencies
Run the following command to install frontend dependencies:
```sh
npm install
```

### 9. Compile Assets
Run the following command to compile frontend assets:
```sh
npm run dev
```

### 10. Serve the Application
Open a separate terminal and run the following command to start the Laravel server:
```sh
php artisan serve
```

### 11. Access the Application
Open your browser and go to:
```
http://127.0.0.1:8000
