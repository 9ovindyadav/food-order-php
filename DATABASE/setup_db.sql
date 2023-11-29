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

CREATE TABLE tables (
    id INT AUTO_INCREMENT PRIMARY KEY,
    capacity INT,
    status bool    
);
INSERT INTO tables (capacity, status) VALUES (4, false);
INSERT INTO tables (capacity, status) VALUES (4, false);
INSERT INTO tables (capacity, status) VALUES (6, false);
INSERT INTO tables (capacity, status) VALUES (6, false);

CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    table_id INT,
    status ENUM('taken', 'preparing', 'ready to serve', 'cancelled'),
    timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (table_id) REFERENCES tables(id)
);

CREATE TABLE order_items (
    order_item_id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT,
    menu_id INT,
    quantity INT,
    FOREIGN KEY (order_id) REFERENCES orders(id),
    FOREIGN KEY (menu_id) REFERENCES menus(id)
);

INSERT INTO users (name, email, created_at) VALUES ('Govind yadav','govindsvyadav@gmail.com', NOW());

INSERT INTO menus (name, price, created_at) VALUES ('Fried chicken',100, NOW());
INSERT INTO menus (name, price, created_at) VALUES ('Chilli potato',50, NOW());
INSERT INTO menus (name, price, created_at) VALUES ('Pasta',150, NOW());