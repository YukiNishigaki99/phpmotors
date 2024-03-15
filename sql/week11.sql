-- Create a images table
CREATE TABLE images(
    imgId INT UNSIGNED NOT NULL AUTO_INCREMENT,
    invId INT UNSIGNED NOT NULL,
    imgName VARCHAR(100) NOT NULL,
    imgPath VARCHAR(150) NOT NULL,
    imgDate TIMESTAMP NOT NULL default current_timestamp(),
    imgPrimary TINYINT(1) NOT NULL default 0,
    PRIMARY KEY (imgId),
    CONSTRAINT FK_inv_images
    FOREIGN KEY (invId) REFERENCES inventory (invId)
);

-- Modify the table to set invId as a foreign key 
ALTER TABLE images (
    FOREIGN KEY (invId) REFERENCES inventory (invId)
)