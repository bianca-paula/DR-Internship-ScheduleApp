<?php

class UserHelper
{

    const USER_TABLE = "CREATE TABLE User(
        id INT AUTO_INCREMENT PRIMARY KEY,
        email VARCHAR(255) NOT NULL,
        password VARCHAR(255) NOT NULL,
        first_name VARCHAR(255) NOT NULL,
        last_name VARCHAR(255) NOT NULL,
        group_id INT NOT NULL,
        prefix VARCHAR(255),
        UNIQUE KEY (email,first_name,last_name)
    )";
    const USER_ROLE_MOCK_DATA = "INSERT INTO User (email, password, first_name, last_name,group_id) VALUES
                                ('bot.one@gmail.com', '1234', 'Jhon', 'Doe',513),
                                ('bot.two@gmail.com', '1235', 'Jane', 'Doee',514),
                                ('bot.three@gmail.com', '1236', 'Max', 'Mayx',513),
                                ('bot.four@gmail.com', '1237', 'Min', 'Mayx',514), ";

    static function createStructure($db)
    {
        $db->execute(self::USER_TABLE);
    }

    static function insertData($db)
    {
        $db->execute(self::USER_ROLE_MOCK_DATA);
    }
}
