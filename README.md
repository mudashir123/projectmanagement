# Project Task Management System

A simple project and task management web application built using **CodeIgniter 3**, Bootstrap 5, and jQuery.

---

## 🚀 Features

- User Registration & Login
- Create, Edit, Delete (Soft) Projects
- Add, Edit, Delete (Soft) Tasks under Projects
- AJAX Task creation and editing
- MaxMind GeoIP integration to detect user city/state
- Responsive Bootstrap UI

---

## 🛠️ Setup Instructions

1. **Clone the repo**

git clone https://github.com/mudashir123/projectmanagement.git

2. **Import the database**

Import database.sql into your MySQL server.

Update /application/config/database.php with your DB credentials.

3. **Configure CodeIgniter**

Open /application/config/config.php and set base_url path:

for example
$config['base_url'] = 'http://localhost/project-management/'

4. **Install GeoIP2 Library**
composer require geoip2/geoip2:~2.0

5.Download GeoLite2-City.mmdb

https://dev.maxmind.com/geoip/geolite2-free-geolocation-data/

Place the .mmdb file inside: application/third_party/GeoIP/