## Requirements

- PHP 8.0+
- Composer
- MySQL or SQLite
- Node.js & NPM (for frontend assets)

## Installation

Follow these steps to get the application running on your local machine:

1. **Clone the Repository**

   ```bash
   git clone https://github.com/dinithshenuka/Reverb-chat.git
   cd Laravel-note-taking-app
   ```

2. **Install Dependencies**

   ```bash
   composer install
   npm install
   ```

3. **Set Up Environment Variables**

   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Configure Database**

   Edit the `.env` file and set up your database connection:

   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=your_database_name
   DB_USERNAME=your_database_username
   DB_PASSWORD=your_database_password
   ```

   For SQLite, you can use:

   ```
   DB_CONNECTION=sqlite
   ```

   And create an empty database file:

   ```bash
   touch database/database.sqlite
   ```

5. **Run Migrations**

   ```bash
   php artisan migrate
   ```

6. **Build Assets (optional)**

   ```bash
   npm run dev
   ```

7. **Start the Development Server**

   ```bash
   php artisan serve
   ```

   The application will be available at http://localhost:8000.

