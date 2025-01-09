# SIGHTSEEING 
A Tourism Analysis System Based on Social Network Analysis [legacy-version](https://github.com/possess0602/exam58/blob/master/readme.md)

## Introduction

SightSeeing is a comprehensive system designed for independent travelers to arrange their trips. It provides various features such as points of interest, hotel pros and cons analysis, Google Maps route optimization, and more. The system helps users quickly plan their trips without the need to browse multiple websites, saving time and effort.

It offers integrated functionality that includes attraction and hotel feature analysis, optimized pathfinding, and customized trip scheduling. This makes it a great tool for users looking to plan personalized trips.

## Quick Starts

### Preparation

To deploy SightSeeing in Docker, follow the instructions below.

1. Clone the repository and navigate to the project directory.
    ```git
    git clone <repository-url>
    cd <project-directory>
    ```

   Navigate to the `volume/web/` directory, copy the `.env.example` file, and rename it to `.env`. Then, modify the following lines in the `.env` file:
    ```.env
    # Database Configuration
    DB_CONNECTION=mysql
    DB_HOST=mysql      # The hostname of your database service, defined in your docker-compose.yml
    DB_PORT=3306       
    DB_DATABASE=homestead
    DB_USERNAME=homestead
    DB_PASSWORD=secret

    # Google OAuth Configuration
    GOOGLE_CLIENT_ID=<your-google-id>
    GOOGLE_CLIENT_SECRET=<your-google-secret>
    GOOGLE_REDIRECT=https://sightseeing.nctu.me/callback

    ```
    Make sure to replace `<your-google-id>` and `<your-google-secret>` with your actual Google OAuth credentials, which are required for [Google API](https://developers.google.com/identity/oauth2/web/guides/get-google-api-clientid?hl=zh-tw) functionality.

3. Start the services with Docker Compose.
    ```bash
    docker-compose up -d
    ```

4. Run the PHP migration to set up the database tables:
    ```bash
    docker exec -it exam58-php php artisan migrate
     ```
    after migration table created successfully, go to **MySQL phpMyAdmin Panel**: [http://localhost:8888](http://localhost:8888), import homestead.sql file [[GDrive]](https://drive.google.com/file/d/1a47WyEq9BpSIl9hXGO_6xh96NPT_2T9T/view?usp=sharing).
### Service Ports

After starting the services, the following ports will be available:
- **Frontend** (Vue Quasar): [http://localhost:80](http://localhost:80)
- **Backend** (PHP Laravel API): [http://localhost:8080/api/](http://localhost:8080/api/)
  - Example GET request: [http://localhost:8080/api/site_dataCity](http://localhost:8080/api/site_dataCity)
- **MySQL phpMyAdmin Panel**: [http://localhost:8888](http://localhost:8888)



## Features Overview

### Trip Scheduling

Registered users can utilize the scheduling feature to efficiently plan their trips.

![2](https://user-images.githubusercontent.com/48153269/192672072-15d27534-eef0-4805-855b-897d097939a6.png)

### Pros and Cons Analysis

The system provides an analysis of the pros and cons of attractions and hotels. This is based on a custom-built tourism vocabulary and SNA (Degree Centrality) analysis method, which helps users understand the key characteristics (pros) and potential issues (cons) of each location.

![step2](https://user-images.githubusercontent.com/48153269/192665673-d0e40df3-168c-41ce-91e9-a0a95b90a10a.png)

### Path Recommendation Analysis

By inputting a point of interest, users can see other places that are frequently visited by travelers who visit the same location, including hotels and restaurants. This helps users discover related attractions and plan their trips accordingly.

![路徑](https://user-images.githubusercontent.com/48153269/192665691-b37602a6-8fe9-49a5-8ebf-397a46dca03e.png)

### Google Maps Route Optimization

Using Google Maps API, the system can suggest the most efficient route for a day, optimizing the order of visiting various attractions.

![googlenap](https://user-images.githubusercontent.com/48153269/192665749-f9547c32-3cf1-45c4-bf4a-f76407a3f556.png)

## Technologies Used

- **Database**: MySQL 5.8 (for storing web scraping data) and Google Firebase (for storing user data)
- **Server**: XAMPP-Apache Server, Node.js
- **Backend Software**: Laravel, R, Python
- **Frontend Software**: Vue.js 2 (with Quasar CLI)

## Acknowledgments

Special thanks to the following developers for their great work:

- [@possess0602](https://github.com/possess0602)
- [@winnieywhsiao](https://github.com/winnieywhsiao)
- Yen-Wen Hsiao
- Chang-Geng Wu
- Dong-Yi Lu
