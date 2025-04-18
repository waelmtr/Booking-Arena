# 🏟️ Sports Arena Reservation System
> A simple app to book sports venues online

This project is a **platform** that allows users to **browse, book, and manage** reservations at various sports arenas. Whether you’re an arena owner or a user, this platform simplifies the process of finding available time slots and managing arena schedules.

---

## 📌 Features

### For **Users**:
- **User Registration and Authentication**: Sign up, log in, and log out using secure authentication (password encryption).
- **Browse Available Arenas**: View a list of available sports arenas with details.
- **Reserve Time Slots**: Book available time slots for a specific arena.

### For **Arena Owners**:
- **Manage Arenas**: Create, update, and delete sports arenas they own.
- **Manage Time Slots**: Set available time slots for arenas.
- **View Bookings**: See all bookings made for their arenas.
- **Manage Statuses** : change status of bookings for canceled or confirmed ,
- **Set Pricing**: Specify the pricing for their arenas based on different time slots.
---
---

## 🛠️ Tech Stack

- **Backend**: PHP 8.x, Laravel 11
- **Database**: MySQL
- **Authentication**: Laravel’s built-in Auth system (sanctum)
- **Testing**: PHPUnit and Mockery

---

## 🖥️ Installation

### **Prerequisites**
- PHP 8.2 or higher
- Composer
- MySQL or another relational database

### **Steps to Set Up Locally**

1. Clone the repository:

    ```bash
    git clone https://github.com/waelmtr/Booking-Arena.git
    cd Booking-Arena
    ```

2. Install PHP and frontend dependencies:

    ```bash
    composer install
    ```

3. Set up the environment file:

    ```bash
    cp .env.example .env
    ```

4. Generate a new application key:

    ```bash
    php artisan key:generate
    ```

5. Configure your `.env` file for database connection (e.g., MySQL):

    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=booking
    DB_USERNAME=root
    DB_PASSWORD=
    ```

6. Run the database migrations (this will create tables like `users`, `bookings`, `arenas` , `sports` , `time_slots`):

    ```bash
    php artisan migrate --seed
    ```

7. Start the development server:

    ```bash
    php artisan serve
    ```

   Visit `http://127.0.0.1:8000` to see the app in action!

---

## 🧪 Running Tests

1. To run all tests:

    ```bash
    php artisan test
    ```

2. To run specific tests:

    ```bash
    php artisan test --filter BookingAccessTest
    ```

---

## 📂 Folder Structure

app/
├── Domain/
│   ├── Arenas/
│   │   ├── Models/
│   │   │   └── Arena.php
│   │   ├── Repositories/
│   │   │   └── ArenaRepositoryInterface.php
│   │   └── Services/
│   │       └── ArenaService.php
│   ├── TimeSlots/
│   │   ├── Models/
│   │   │   └── TimeSlot.php
│   │   ├── Repositories/
│   │   │   └── TimeSlotRepositoryInterface.php
│   │   └── Services/
│   │       └── TimeSlotService.php
│   └── Bookings/
│       ├── Models/
│       │   └── Booking.php
│       ├── Repositories/
│       │   └── BookingRepositoryInterface.php
│       ├── Services/
│       │   └── BookingService.php
│       └── Enums/
│           └── BookingStatus.php
├── Infrastructure/
│   ├── Repositories/
│   │   ├── ArenaRepository.php
│   │   ├── TimeSlotRepository.php
│   │   └── BookingRepository.php
│   └── Events/
│       └── BookingExpired.php
└── Interfaces/
    ├── Http/
    │   ├── Controllers/
    │   │   ├── ArenaController.php
    │   │   ├── TimeSlotController.php
    │   │   └── BookingController.php
    │   ├── Requests/
    │   │   ├── CreateArenaRequest.php
    │   │   ├── CreateTimeSlotRequest.php
    │   │   └── CreateBookingRequest.php
    │   └── Resources/
    │       ├── ArenaResource.php
    │       ├── TimeSlotResource.php
    │       └── BookingResource.php
