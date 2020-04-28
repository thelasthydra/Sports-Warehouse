-- SEVER SIDE SCRIPT

DROP TABLE IF EXISTS Item;
DROP TABLE IF EXISTS Category;
DROP TABLE IF EXISTS User;

CREATE TABLE Item (
	itemID	 	INT auto_increment,
	itemName 	VARCHAR(255) NOT NULL,
	photo 		VARCHAR(50),
	price 		DECIMAL(10,2) NOT NULL,
	salePrice 	DECIMAL(10,2),
    onSale 		BOOLEAN NOT NULL,
	description TEXT,
	featured 	BOOLEAN NOT NULL,
	categoryID	INT,

	PRIMARY KEY (itemID)
);

CREATE TABLE Category (
	categoryID 	INT auto_increment,
	categoryName 	VARCHAR(50) NOT NULL,

	PRIMARY KEY (categoryID)
);

CREATE TABLE User (
	userID 		INT auto_increment,
	username	VARCHAR(50),
	password	VARCHAR(255),

	PRIMARY KEY (userID) 	
);

CREATE TABLE ShoppingOrder(
	orderID 	INT auto_increment,
	firstName 	VARCHAR(50) NOT NULL,
	lastName 	VARCHAR(50) NOT NULL,
	address 	VARCHAR(255) NOT NULL,
	phone 		VARCHAR(25) NOT NULL,
	email 		VARCHAR(255),
	creditCard 	CHAR(16) NOT NULL,
	expireMonth CHAR(2) NOT NULL,
	expireYear 	CHAR(2) NOT NULL,
	cardHolder 	VARCHAR(101) NOT NULL,

	PRIMARY KEY (orderID)
);

CREATE TABLE OrderItem(
	itemID 		INT,
	buyPrice 	DECIMAL(10,2),
	qty 		INT,
	orderID 	INT,

	PRIMARY KEY (itemID, orderID)
);

ALTER TABLE Item ADD CONSTRAINT item_category_fk FOREIGN KEY (categoryID) REFERENCES Category(categoryID);


ALTER TABLE OrderItem ADD CONSTRAINT orderitem_item_fk FOREIGN KEY (itemID) REFERENCES Item(itemID);
ALTER TABLE OrderItem ADD CONSTRAINT orderitem_shoppingorder_fk FOREIGN KEY (orderID) REFERENCES ShoppingOrder(orderID);


-- CATEGORIES
INSERT INTO Category(categoryName) VALUES ("Shoes");
INSERT INTO Category(categoryName) VALUES ("Helmets");
INSERT INTO Category(categoryName) VALUES ("Pants");
INSERT INTO Category(categoryName) VALUES ("Tops");
INSERT INTO Category(categoryName) VALUES ("Balls");
INSERT INTO Category(categoryName) VALUES ("Equipment");
INSERT INTO Category(categoryName) VALUES ("Training Gear");
-- ITEMS
INSERT INTO Item(itemName, photo, price, salePrice, onSale, description, featured, categoryID) VALUES ("adidas Euro16 Top Soccer Ball", "soccer-ball.png", 46.00, 34.95, true, "A Thing Used To Play Soccer With", true, 5);
INSERT INTO Item(itemName, photo, price, salePrice, onSale, description, featured, categoryID) VALUES ("Pro-tec Classic Skate Helmet", "skate-helmet.png", 70.00, price * .85, false, "A Thing To Protect Your Head", true, 2);
INSERT INTO Item(itemName, photo, price, salePrice, onSale, description, featured, categoryID) VALUES ("Nike Sport 600ml Water Bottle", "water-bottle.png", 17.5, 15.00, true, "A Thing To Drink From", true, 7);
INSERT INTO Item(itemName, photo, price, salePrice, onSale, description, featured, categoryID) VALUES ("Sting ArmaPlus Boxing Gloves", "boxing-gloves.png", 79.95, price * .85, false, "A Thing To Protect Your Hands While Punching Someone Else's Face", true, 6);
INSERT INTO Item(itemName, photo, price, salePrice, onSale, description, featured, categoryID) VALUES ("Asics Gel Lethal Tigreor 8 IT Men's", "football-boots.png", 160.00, price * .85, false, "A Thing To Put On Your Feet While Playing Sports", true, 1);
