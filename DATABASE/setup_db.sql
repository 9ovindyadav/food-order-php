Menus - id, name, price, created_at
Users - id, name, email, created_at
Orders - id, menu_id, user_id, created_at

CREATE TABLE users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(30),
            email VARCHAR(30) UNIQUE,
            created_at DATETIME
);

CREATE TABLE menus (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(30),
            price INT(4),
            created_at DATETIME
);

CREATE TABLE orders (
            id INT AUTO_INCREMENT PRIMARY KEY,
            menu_id INT,
            user_id INT,
            created_at DATETIME,
            FOREIGN KEY (menu_id) REFERENCES menus(id),
            FOREIGN KEY (user_id) REFERENCES users(id)
);

INSERT INTO users (name, email, created_at) VALUES ('Govind yadav','govindsvyadav@gmail.com', NOW());

INSERT INTO menus (name, price, created_at) VALUES ('Vada pav',15, NOW());