# Technical Test: Back-End Knowledge for E-commerce and API Creation

## Objective
Evaluate a programmer's skills in developing web applications using Laravel 8, PHP 8, Docker, and integrating with an external API, as well as developing their own API.

## Instructions

### Prerequisites
- Have Docker and Docker Compose installed.
- An IDE of your choice (e.g., Visual Studio Code, PhpStorm).

### Deliverables
- Source code of the application in a GitHub repository.
- `docker-compose.yml` file for Docker configuration.
- Clear instructions to run the application.
- Development process documentation.

### Part 1: Initial Setup

#### 1. Laravel Project Creation
Create a new Laravel project using Composer.

#### 2. Docker Configuration
Set up a `docker-compose.yml` file to start the application services (including a database, e.g., MySQL).

### Part 2: E-commerce Application Development

#### 1. Model and Migration
Create the following models with their respective migrations:
- **Product**: `name`, `description`, `price`, `stock`, `category_id`, `image`
- **Category**: `name`, `description`
- **Order**: `user_id`, `total_amount`, `status`, `timestamps`
- **OrderItem**: `order_id`, `product_id`, `quantity`, `price`

### Part 3: API Development

#### 1. RESTful API
- Create controllers to handle CRUD operations for products and categories.
- Create controllers to handle the order flow and its items.
- Configure routes in `api.php` to point to the controller actions.
- Create endpoints for the following operations:
  - List products
  - View product details
  - Create, update, and delete a product
  - List categories
  - View category details
  - Create, update, and delete a category
  - Create an order
  - View the status of an order
  - Cancel an order
  - (Optional) Display a random product

### Part 4: Database Population and Integration with an External API

#### 1. Seeder and Factory
Create the corresponding seeders to automatically populate the database with at least 3 categories and 3 products within each category.

#### 2. Fetching Data
Create a console command that connects to an external API to fetch product data and save it to the database. (https://fakestoreapi.com)

### Part 5: Additional Functionality

#### 1. API Documentation
Use Swagger to document the API and provide clear examples of how to interact with the API.

#### 2. User Authentication
Implement user authentication using Laravel Jetstream or Laravel Breeze. Allow only authenticated users to create orders and associate orders with users to provide a history for each user.

#### 3. Query Optimization
Use Eloquent relationships efficiently to optimize access to related data. Implement caching to improve the performance of the most frequent queries.

## Evaluation
1. Code readability and level of organization and optimization.
2. Use of best practices in Laravel and RESTful API.
3. Scalability of the solution.
4. Unit and integration tests.
5. Knowledge of PHP and Docker.
6. Development environment configuration.
7. Provided documentation.

**Good luck!**

