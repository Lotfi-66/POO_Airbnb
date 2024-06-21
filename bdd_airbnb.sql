-- Table for storing address information
CREATE TABLE Address (
    id INT AUTO_INCREMENT PRIMARY KEY,
    address VARCHAR(255) NOT NULL,
    zip_code VARCHAR(20) NOT NULL,
    country VARCHAR(100) NOT NULL,
    city VARCHAR(100) NOT NULL
);

-- Table for storing user information
CREATE TABLE User (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    lastname VARCHAR(255) NOT NULL,
    firstname VARCHAR(255) NOT NULL,
    phone VARCHAR(20),
    is_active BOOLEAN NOT NULL,
    address_id INT,
    FOREIGN KEY (address_id) REFERENCES Address(id)
);

-- Table for storing type information
CREATE TABLE Type (
    id INT AUTO_INCREMENT PRIMARY KEY,
    label VARCHAR(255) NOT NULL,
    image_path VARCHAR(255),
    is_active BOOLEAN NOT NULL
);

-- Table for storing residence information
CREATE TABLE Residence (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    price_per_night INT NOT NULL,
    size INT,
    nb_rooms INT,
    nb_beds INT,
    nb_baths INT,
    nb_travelers INT,
    is_active BOOLEAN NOT NULL,
    type_id INT,
    user_id INT,
    address_id INT,
    FOREIGN KEY (type_id) REFERENCES Type(id),
    FOREIGN KEY (user_id) REFERENCES User(id),
    FOREIGN KEY (address_id) REFERENCES Address(id)
);

-- Table for storing equipment information
CREATE TABLE Equipment (
    id INT AUTO_INCREMENT PRIMARY KEY,
    label VARCHAR(255) NOT NULL,
    image_path VARCHAR(255)
);

-- Table for storing reservation information
CREATE TABLE Reservation (
    id INT AUTO_INCREMENT PRIMARY KEY,
    date_start DATE NOT NULL,
    date_end DATE NOT NULL,
    nb_adults INT NOT NULL,
    nb_children INT,
    price_total INT NOT NULL,
    residence_id INT,
    user_id INT,
    FOREIGN KEY (residence_id) REFERENCES Residence(id),
    FOREIGN KEY (user_id) REFERENCES User(id)
);

-- Table for storing the many-to-many relationship between Residence and Equipment
CREATE TABLE Residence_Equipment (
    equipment_id INT,
    residence_id INT,
    PRIMARY KEY (equipment_id, residence_id),
    FOREIGN KEY (equipment_id) REFERENCES Equipment(id),
    FOREIGN KEY (residence_id) REFERENCES Residence(id)
);

-- Table for storing favorite residences for each user
CREATE TABLE Favorite (
    id INT AUTO_INCREMENT PRIMARY KEY,
    residence_id INT,
    user_id INT,
    is_active BOOLEAN NOT NULL,
    FOREIGN KEY (residence_id) REFERENCES Residence(id),
    FOREIGN KEY (user_id) REFERENCES User(id)
);

-- Table for storing media related to residences
CREATE TABLE Media (
    id INT AUTO_INCREMENT PRIMARY KEY,
    image_path VARCHAR(255) NOT NULL,
    residence_id INT,
    FOREIGN KEY (residence_id) REFERENCES Residence(id)
);
