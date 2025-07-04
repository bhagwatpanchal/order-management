# Mini Order Management System (Laravel 12 + Vue 3)

This is a full-stack mini order management system built as part of a task for **GEMGEM**.  
It includes a **Laravel 12 RESTful API backend** and a **Vue 3 frontend**, connected via Axios and styled with Tailwind CSS.

---

## Tech Stack

- **Backend:** Laravel 12, PHP 8.x, Eloquent ORM
- **Frontend:** Vue 3 (Composition API), Axios
- **Database:** SQLite
- **Styling:** Tailwind CSS
- **Testing:** PHPUnit
- **Dev Tools:** Vite, Laravel Artisan, Git, GitHub, Visual Studio Code

---

## API Endpoints

| Method | Endpoint           | Description                     |
|--------|--------------------|---------------------------------|
| POST   | `/api/orders`      | Create a new order              |
| GET    | `/api/orders`      | List all orders (JSON)          |
| PATCH  | `/api/orders/{id}` | Update order status             |

Each order includes:
- `customer_name`
- `item_name`
- `price`
- `status` (pending, paid, cancelled)

---

## Installation & Setup Instructions

1. **Clone the Repository**
   ```bash
   git clone https://github.com/bhagwatpanchal/order-management.git
   cd order-management
   ```

2. **Install Backend (Laravel) Dependencies**
   ```bash
   composer install
   ```

3. **Create SQLite Database File**
   ```bash
   touch database/database.sqlite
   ```

4. **Copy .env and Generate Application Key**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Configure `.env` File**
   Update the database section in your `.env`:
   ```
   DB_CONNECTION=sqlite
   DB_DATABASE=./database/database.sqlite
   ```

6. **Run Database Migrations**
   ```bash
   php artisan migrate
   ```

7. **Start Laravel Development Server**
   ```bash
   php artisan serve
   ```

8. **Install Frontend Dependencies (Vue 3 + Vite)**
   ```bash
   npm install
   ```

9. **Start Frontend Development Server**
   ```bash
   npm run dev
   ```

10. **Tailwind CSS Setup**
    Tailwind CSS is already configured.
    Ensure the following exists in `resources/css/app.css`:
    ```css
    @tailwind base;
    @tailwind components;
    @tailwind utilities;
    ```

11. **Using Tailwind in Vue**
    - Use Tailwind utility classes like `bg-blue-500`, `rounded-md`, etc. directly in Vue components.
    - Tailwind is bundled with Vite. No extra build step is required beyond:
      ```bash
      npm run dev
      ```

12. **Run PHPUnit Tests**
    Run all tests:
    ```bash
    php artisan test
    ```

13. **Create Test File (if needed)**
    ```bash
    php artisan make:test OrderApiTest
    ```

14. **Run Specific Test**
    ```bash
    php artisan test --filter=it_creates_a_new_order
    ```

---

## Known Issues

- No authentication or login functionality (public API)
- No pagination or filtering in order list
- No confirmation on status change
- Basic backend validation; no frontend form validation
- Layout not mobile responsive
- Global state management (Vuex/Pinia) not implemented
- SQLite is used (not suitable for production)

---

##  Testing Features

- Create order via API
- Update order status
- Validate database entries using `assertDatabaseHas`
- Fully working `OrderApiTest` with `#[Test]` attributes (PHPUnit 10+)

---
