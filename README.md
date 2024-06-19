# Blood Bank Website

Welcome to the Blood Bank Website project, designed to facilitate blood donations and requests. This platform allows donors to register and specify their blood type, and enables patients to register and request blood donations according to their specific needs and location. The website includes a dashboard for administrators to manage donations and requests, and provides an API for future integration with a mobile application.

## Features

-   **Donator Registration:** Allow blood donors to register and specify their blood type.
-   **Patient Registration:** Enable patients to register and request blood donations, specifying their required blood type and location (city and governorate).
-   **Matching System:** Facilitate matching between donors and patients based on blood type and location.
-   **Admin Dashboard:** Dashboard for administrators to manage donations, requests, and users.
-   **API:** RESTful API provided for integration with a future mobile application.

## Technologies Used

-   **Backend:** Laravel
-   **Frontend:** HTML, CSS, Bootstrap
-   **API:** RESTful API for mobile application integration

## Screenshots

![Homepage](https://i.imgur.com/rn11gIG.png)

![Admin Dashboard](https://i.imgur.com/m4ePdku.png)

## Installation

Follow these steps to set up the Blood Bank Website project on your local machine:

1. **Clone the repository:**

    ```sh
    git clone https://github.com/yourusername/zeem.git

    ```

2. **Navigate to the project directory:**

    ```sh
    cd zeem

    ```

3. **Install the dependencies:**

    ```sh
    composer install
    npm install

    ```

4. **Generate an application key:**

    ```sh
    php artisan key:generate

    ```

5. **Set up the database:**

    ```sh
    npm run dev
    ```

6. **Compile the assets:**

    ```sh
    php artisan migrate
    ```

7. **Serve the application:**
    ```sh
    php artisan serve
    ```
