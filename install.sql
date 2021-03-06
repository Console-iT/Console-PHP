CREATE TABLE `users` ( 
`id` INT NOT NULL AUTO_INCREMENT , 
`fullName` VARCHAR(32) NULL , 
`password` VARCHAR(32) NOT NULL , 
`email` VARCHAR(64) NOT NULL , 
`gender` TINYINT NULL COMMENT '1-male 2-female 3-other' , 
`phone` TEXT NULL , 
`typeIdCard` TINYINT NULL COMMENT '1-shenfenzheng 2-passport 3-hkmacao 4-taiwan' , 
`numberIdCard` TEXT NULL , 
`dateOfBirth` DATE NULL ,
PRIMARY KEY (`id`), 
UNIQUE (`email`)
) ENGINE = InnoDB; 

CREATE TABLE `school` ( 
`schoolName` VARCHAR(64) NOT NULL , 
`manager` INT NOT NULL , 
`description` VARCHAR(9999) NULL ,
PRIMARY KEY (`schoolName`) ,
UNIQUE (`manager`)
) ENGINE = InnoDB COMMENT = '学校社团'; 

ALTER TABLE `school` 
ADD FOREIGN KEY (`manager`) 
REFERENCES `users`(`id`) 
ON DELETE RESTRICT 
ON UPDATE RESTRICT;

CREATE TABLE `user-schools` ( 
`userId` INT NOT NULL , 
`school` VARCHAR(64) NOT NULL , 
`schoolType` TINYINT NOT NULL , 
`graduationYear` YEAR NOT NULL , 
INDEX(` userId `) , 
INDEX(`schoolName`)
) ENGINE = InnoDB; 

ALTER TABLE `user-schools` 
ADD CONSTRAINT `user-schools_ibfk_1` 
FOREIGN KEY (`school`) 
REFERENCES `school`(`schoolName`) 
ON DELETE RESTRICT 
ON UPDATE RESTRICT; 

ALTER TABLE `user-schools` 
ADD CONSTRAINT `user-schools_ibfk_2` 
FOREIGN KEY (`userId`) 
REFERENCES `users`(`id`) 
ON DELETE RESTRICT 
ON UPDATE RESTRICT; 

--CHARACTER SET gb2312 COLLATE gb2312_chinese_ci