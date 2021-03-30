CREATE DATABASE youcode;

USE youcode;

CREATE TABLE users(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    firstName VARCHAR(255) NOT NULL,
    lastName VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    phone VARCHAR(255) NOT NULL UNIQUE,
    pass VARCHAR(255) NOT NULL,
    createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    avatar VARCHAR(255) NOT NULL DEFAULT "images/avatars/user.svg"
) ENGINE=INNODB DEFAULT CHARSET=utf8mb4;

CREATE TABLE roles(
    roleName VARCHAR(255) NOT NULL DEFAULT "client",
    userID INT NOT NULL,
    PRIMARY KEY(roleName),
    FOREIGN KEY(userID) REFERENCES users(id)
) ENGINE=INNODB DEFAULT CHARSET=utf8mb4;

CREATE TABLE categories(
    categoryID INT NOT NULL AUTO_INCREMENT,
    categoryName VARCHAR(255) NOT NULL,
    categoryDescription VARCHAR(500) NOT NULL,
    PRIMARY KEY(categoryID)
) ENGINE=INNODB DEFAULT CHARSET=utf8mb4;

CREATE TABLE products(
    productID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    productName VARCHAR(255) NOT NULL,
    productPrice FLOAT NOT NULL,
    productImage VARCHAR(255) NOT NULL DEFAULT "images/products/default.jpg",
    productDescription VARCHAR(500) NOT NULL,
    productAddedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    productCategoryID INT NOT NULL,
    productQty INT NOT NULL,
    productRating FLOAT NOT NULL,
    FOREIGN KEY(productCategoryID) REFERENCES categories(categoryID)
) ENGINE=INNODB DEFAULT CHARSET=utf8mb4;

CREATE TABLE orders(
    orderID INT NOT NULL AUTO_INCREMENT,
    orderDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    orderCustomer INT NOT NULL,
    orderStatus VARCHAR(255) NOT NULL,
    orderProductID INT NOT NULL,
    PRIMARY KEY(orderID),
    FOREIGN KEY(orderCustomer) REFERENCES users(id),
    FOREIGN KEY(orderProductID) REFERENCES products(productID)
) ENGINE=INNODB DEFAULT CHARSET=utf8mb4;

INSERT INTO users(id,firstName,lastName,email,phone,pass,avatar) VALUES(1,"Hassan","Benhzaine",
"cbenhzaine@gmail.com","0607873886","$2y$10$B8NRe6DFFeXnRIW1JRHFqeLe6TRwaWSybngAUyPTp04FJvxEqcJ0e","images/avatars/user.svg");
INSERT INTO users(id,firstName,lastName,email,phone,pass,avatar) VALUES(2,"Hassan","Benhzaine",
"cbenhzaine@hotmail.com","607873886","$2y$10$B8NRe6DFFeXnRIW1JRHFqeLe6TRwaWSybngAUyPTp04FJvxEqcJ0e","images/avatars/user.svg");

INSERT INTO roles(roleName,userID) VALUES("Administrator",1);
INSERT INTO roles(roleName,userID) VALUES("Client",2);

INSERT INTO categories(categoryID,categoryName,categoryDescription) VALUES(1,"Pas de categorie","Pas de description");
INSERT INTO categories(categoryName,categoryDescription) VALUES("Pizzas","best sandwitches");
INSERT INTO categories(categoryName,categoryDescription) VALUES("Sandwitchs","best sandwitches");

INSERT INTO products(productID,productName,productPrice,productImage,productDescription,productCategoryID,
productQty,productRating) VALUES(1,"Pizza Hut","50","images/products/1.jpg","The best hot pizza",1,1,4.5);

INSERT INTO orders(orderID,orderCustomer,orderStatus,orderProductID) VALUES(1,1,"In progress",1);