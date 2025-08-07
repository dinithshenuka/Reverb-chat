# Reverb Chat

A real-time chat application built with Laravel, Livewire, and Laravel Reverb.  
No third-party WebSocket services required—everything runs on your own server!

---

## Features

- Real-time messaging with Laravel Reverb
- Livewire-powered chat UI
- Private channels for secure, user-specific messaging
- Queue jobs and events for scalable message delivery

---

## Setup Instructions

### 1. Clone the Repository

```sh
git clone https://github.com/dinithshenuka/Reverb-chat.git
cd Reverb-chat
```

### 2. Install PHP Dependencies

```sh
composer install
```

### 3. Install Node.js Dependencies

```sh
npm install
```

### 4. Copy and Configure Environment File

```sh
cp .env.example .env
```
- Set your database credentials.
- Set the following for Reverb:
    ```
    BROADCAST_DRIVER=reverb

    REVERB_APP_ID=your-app-id
    REVERB_APP_KEY=your-app-key
    REVERB_APP_SECRET=your-app-secret
    REVERB_HOST=localhost
    REVERB_PORT=8080
    REVERB_SCHEME=http

    VITE_REVERB_APP_KEY=your-app-key
    VITE_REVERB_HOST=localhost
    VITE_REVERB_PORT=8080
    VITE_REVERB_SCHEME=http
    ```

### 5. Generate Application Key

```sh
php artisan key:generate
```

### 6. Run Migrations

```sh
php artisan migrate
```

### 7. Install Laravel Reverb

```sh
composer require laravel/reverb
```

### 8. Start the Reverb WebSocket Server

```sh
php artisan reverb:start
```

### 9. Build Frontend Assets

```sh
npm run dev
```

### 10. Start the Laravel Development Server

```sh
php artisan serve
```

---

## Usage

- Register and log in.
- Navigate to the Chat page.
- Start chatting in real time!

---

## Notes

- Make sure the Reverb server is running for real-time features.
- If you change `.env` or JS, restart `npm run dev` and `php artisan reverb:start`.
- For private channels, ensure `routes/channels.php` includes:
    ```php
    Broadcast::channel('chat.{userId}', function ($user, $userId) {
        return (int) $user->id === (int) $userId;
    });
    ```

---

## Contributing

Pull requests are welcome! For major changes, please open an issue first.

---


   ```bash
   npm run dev
   ```

7. **Start the Development Server**

   ```bash
   php artisan serve
   ```

   The application will be available at http://localhost:8000.

[MIT](LICENSE)
