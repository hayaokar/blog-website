
# Laravel Blog Website

## Table of Contents

1. [Introduction](#introduction)
2. [Features](#features)
3. [Installation](#installation)
4. [Configuration](#configuration)
5. [Usage](#usage)
6. [Contributing](#contributing)
7. [License](#license)
8. [Contact](#contact)

## Introduction

Welcome to the Laravel Blog Website project! This project is a dynamic and powerful blogging platform built using Laravel 10, a PHP framework. It has two main parts: the front end and the back end. The front end is dynamically modifiable, allowing users to create, edit, and delete blog posts, as well as manage categories and tags.

## Features

- User authentication and authorization
- Create, read, update, and delete (CRUD) operations for blog posts
- Manage categories and tags
- Comment system
- Responsive design
- Admin panel for managing posts and users
- Dynamic front end to easily modify content

## Installation

To get a local copy up and running, follow these simple steps:

### Prerequisites

- PHP >= 7.3
- Composer
- MySQL
- Node.js & npm

### Steps

1. Clone the repository
   ```sh
   git clone https://github.com/hayaokar/blog-website
   cd laravel-blog
   ```

2. Install Composer dependencies
   ```sh
   composer install
   ```

3. Install NPM dependencies
   ```sh
   npm install
   npm run dev
   ```

4. Run the migrations
   ```sh
   php artisan migrate
   ```

5. Seed the database (optional, for testing)
   ```sh
   php artisan db:seed
   ```

6. Serve the application
   ```sh
   php artisan serve
   ```

## Configuration

Make sure to configure your `.env` file with the correct database credentials and other settings.

## Usage

Once the application is running, you can access it in your web browser at `http://localhost:8000`. 

## Contributing

Contributions are what make the open-source community such an amazing place to learn, inspire, and create. Any contributions you make are **greatly appreciated**.

1. Fork the Project
2. Create your Feature Branch (`git checkout -b feature/AmazingFeature`)
3. Commit your Changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the Branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## License

Distributed under the MIT License. See `LICENSE` for more information.

## Contact

Haya Okar - [hayaokar20@hotmail.com](mailto:hayaokar20@hotmail.com)


