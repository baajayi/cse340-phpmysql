--query 1
INSERT INTO clients (
        clientFirstname,
        clientLastname,
        clientEmail,
        clientPassword,
        comment
    )
Values (
        'Tony',
        'Stark',
        'tony@starent.com',
        'Iam1ronM@n',
        'I am the real Ironman'
    );
--query 2
UPDATE `clients`
SET `clientLevel` = '3'
WHERE `clients`.`clientID` = 1 

--query 3
UPDATE `inventory`
SET `invDescription` = REPLACE(
        `invDescription`,
        'small interior',
        'spacious interior'
    )
WHERE `invMake` = 'GM'
    AND `invModel` = 'Hummer';
--query 4
SELECT `invModel`,
    `carclassification`.`classificationName`
FROM `inventory`
    INNER JOIN `carclassification` ON `inventory`.`classificationId` = `carclassification`.`classificationId`
WHERE `carclassification`.`classificationName` = 'SUV';
--query 5
DELETE FROM `inventory`
WHERE invMake = 'Jeep'
    AND invModel = 'Wrangler';
--query 6
UPDATE `inventory`
SET invImage = CONCAT('/phpmotors', invImage),
    invThumbnail = CONCAT('/phpmotors', invThumbnail);