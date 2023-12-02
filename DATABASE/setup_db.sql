

CREATE TABLE users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(30),
            email VARCHAR(30) UNIQUE,
            role VARCHAR(20),
            password VARCHAR(100),
            is_active boolean,
            updated_at DATETIME,
            created_at DATETIME
);

INSERT INTO users (name, email, role, password, is_active, updated_at, created_at)
VALUES ('Govind yadav','govindsvyadav@gmail.com','admin', '$2y$12$uVETOmnLx4WzPBJKTKyE7evjpjTq.jZapQoa/pjLiew1.qg7eDZ6C', true,NOW(),NOW());

CREATE TABLE menus (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(30),
            price INT(4),
            created_at DATETIME,
            img VARCHAR(200)
);


CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    status VARCHAR(20),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE order_items (
    order_item_id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT,
    menu_id INT,
    quantity INT,
    FOREIGN KEY (order_id) REFERENCES orders(id),
    FOREIGN KEY (menu_id) REFERENCES menus(id)
);

CREATE TABLE payments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT,
    amount DECIMAL(10, 2),
    status VARCHAR(10),
    FOREIGN KEY (order_id) REFERENCES orders(id)
);


INSERT INTO `menus` (`id`, `name`, `price`, `created_at`, `img`) VALUES
(1, 'Vada pav', 15, '2023-11-29 06:43:04', 'https://res.cloudinary.com/dnkelaevp/image/upload/v1701267618/food_order_system/vada-pav_grzq55.jpg'),
(2, 'Fried chicken', 100, '2023-11-29 13:58:04', 'https://res.cloudinary.com/dnkelaevp/image/upload/v1701267506/food_order_system/fried-chicken_eyblmr.jpg'),
(3, 'Chilli potato', 50, '2023-11-29 13:58:04', 'https://res.cloudinary.com/dnkelaevp/image/upload/v1701267504/food_order_system/chilli-potato_grfkbr.jpg'),
(4, 'Pasta', 150, '2023-11-29 13:58:04', 'https://res.cloudinary.com/dnkelaevp/image/upload/v1701267505/food_order_system/pasta_acuzhk.jpg'),
(5, 'Veg Manchurian', 80, '2023-11-29 14:58:03', 'https://res.cloudinary.com/dnkelaevp/image/upload/v1701269789/food_order_system/veg-manchurian_yuidin.jpg'),
(6, 'Egg Omlette', 50, '2023-11-29 14:58:04', 'https://res.cloudinary.com/dnkelaevp/image/upload/v1701269789/food_order_system/egg-omlete_gih0ma.jpg');