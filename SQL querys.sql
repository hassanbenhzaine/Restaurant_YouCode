CREATE DATABASE youcode;

USE youcode;

CREATE TABLE users(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    firstName VARCHAR(150) NOT NULL,
    lastName VARCHAR(150) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    phone VARCHAR(150) NOT NULL UNIQUE,
    pass VARCHAR(150) NOT NULL,
    createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    avatar VARCHAR(150) NOT NULL DEFAULT "user.svg"
) DEFAULT CHARSET=utf8mb4;

CREATE TABLE roles(
    roleName VARCHAR(150) NOT NULL DEFAULT "client",
    userID INT NOT NULL,
    PRIMARY KEY(roleName),
    FOREIGN KEY(userID) REFERENCES users(id)
) DEFAULT CHARSET=utf8mb4;

CREATE TABLE categories(
    categoryID INT NOT NULL AUTO_INCREMENT,
    categoryName VARCHAR(150) NOT NULL,
    PRIMARY KEY(categoryID)
) DEFAULT CHARSET=utf8mb4;

CREATE TABLE products(
    productID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    productName VARCHAR(150) NOT NULL,
    productPrice FLOAT NOT NULL,
    productImage VARCHAR(150) NOT NULL DEFAULT "default.jpg",
    productDescription VARCHAR(500) NOT NULL,
    productAddedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    productCategoryID INT NOT NULL,
    productQty INT NOT NULL,
    productRating FLOAT NOT NULL DEFAULT 0,
    FOREIGN KEY(productCategoryID) REFERENCES categories(categoryID)
) DEFAULT CHARSET=utf8mb4;

CREATE TABLE orders(
    orderID INT NOT NULL AUTO_INCREMENT,
    orderDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    orderCustomer INT NOT NULL,
    orderStatus VARCHAR(150) NOT NULL,
    orderProductID INT NOT NULL,
    PRIMARY KEY(orderID),
    FOREIGN KEY(orderCustomer) REFERENCES users(id),
    FOREIGN KEY(orderProductID) REFERENCES products(productID)
) DEFAULT CHARSET=utf8mb4;

INSERT INTO users(id,firstName,lastName,email,phone,pass) VALUES(1,"Hassan","Benhzaine",
"cbenhzaine@gmail.com","0607873886","$2y$10$KITIWR4Va9vRbGqCkltxNekNsC8YyM7xBRv6ZI4kjqjFGsw/NJYgC");
INSERT INTO users(id,firstName,lastName,email,phone,pass) VALUES(2,"Hassan","Benhzaine",
"cbenhzaine@hotmail.com","607873886","$2y$10$KITIWR4Va9vRbGqCkltxNekNsC8YyM7xBRv6ZI4kjqjFGsw/NJYgC");

INSERT INTO roles(roleName,userID) VALUES("Administrator",1);
INSERT INTO roles(roleName,userID) VALUES("Client",2);

INSERT INTO categories(categoryID,categoryName) VALUES(1,"Pas de categorie");
INSERT INTO categories(categoryName) VALUES("Burgers");
INSERT INTO categories(categoryName) VALUES("Sandwichs");
INSERT INTO categories(categoryName) VALUES("Pizza");
INSERT INTO categories(categoryName) VALUES("Salades");

INSERT INTO products(productID,productName,productPrice,productImage,productDescription,productCategoryID,
productQty,productRating) VALUES(1,"Menu Double Cheeseburger","48.00","1.jpg","Sandwich + Boisson au choix+ Portion de frites",2,1,2.3);
INSERT INTO products(productName,productPrice,productImage,productDescription,productCategoryID,
productQty,productRating) VALUES("Sandwich Viande HachÃ©e","22.00","2.jpg","Tomates, oignons, laitue, olives, viande hachÃ©e",3,1,4.5);
INSERT INTO products(productName,productPrice,productImage,productDescription,productCategoryID,
productQty,productRating) VALUES("Pizza LÃ©gumes FraÃ®cheur","59.00","3.jpg","Sauce tomate, oignons, poivrons verts, tomates, olives noires, champignons et mozzarella, pÃ¢te fine disponible uniquement en medium et large",4,1,5.0);
INSERT INTO products(productName,productPrice,productImage,productDescription,productCategoryID,
productQty,productRating) VALUES("La CÃ©sar Traditionnelle","70.00","4.jpg","Poulet marinÃ©, romaine, croÃ»tons, Å“uf mollet, parmesan, sauce cÃ©sar",4,1,3.9);

INSERT INTO orders(orderID,orderCustomer,orderStatus,orderProductID) VALUES(1,1,"In progress",1);