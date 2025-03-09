# Food order system for Restaurant

## Overview

The Food order system for Restaurant is a web-based application designed for staff usage in a restaurant. It streamlines order processing, menu management, and administrative tasks for staff working at the counter, in the kitchen, and for administrators.

## Tech Stack

- PHP : Server side scripting language for backend development
- MySQL : RDBMS for managing and storing data
- Nginx : Web server for serving the PHP application
- JQuery : JavaScript library for client side scripting
- Docker : Containerization tech for easy deployment and scaling


## Deployment 

The application is deployed and accessible at below URL

[Restaurent Food order system](https://fop.9ovind.in)

## Test Users

### Counter staff
- **Email** - counter@gmail.com
- **Password** - admin 

### Kitchen staff
- **Email** - kitchen@gmail.com
- **Password** - admin 

### Admin
- **Email** - admin@gmail.com
- **Password** - admin 

## Youtube video
[![IMAGE ALT TEXT HERE](https://img.youtube.com/vi/ckw7OoVXdu8/0.jpg)](https://www.youtube.com/watch?v=ckw7OoVXdu8)

## Setup 
### Prerequisites

- Docker
- Docker compose

### Installation
1. Clone the repository
```
git clone https://github.com/9ovindyadav/food-order-php
``` 

2. Navigate to the project directory
```
cd food-order-php
```

3. Create a **.env** file
```
cp .env.example .env
```
Update **.env** file with your MySql config

4. Navigate to docker folder
```
cd docker
```
5. Build and start docker container
```
docker compose up -d --build
```  

6. Access the application
Open your web browser and navigate to **http://localhost:8000**


## Usage

### Counter staff
- Take and create customer orders
- Manage payment status
- View orders

### Kitchen staff
- View Incoming orders
- Update order status when prepared or prepairing
- Update menu status available or not

### Admin
- Log in with admin credentials
- Manage menus ( add, create, update, delete)
- Manage users ( add, create, update, delete)
- View orders
- View statistics of overall data

## Contribuiting
Contributions are welcome! If you'd like to contribute to the project.

## Support 
If you encounter any issue or have questions , please open and issue in the issue section.
