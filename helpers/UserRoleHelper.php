<?php
class UserRoleHelper
{
    const USER_ROLE_TABLE = "CREATE TABLE IF NOT EXISTS UserRoles(
            user_id INT NOT NULL,
            role_id INT NOT NULL,
            CONSTRAINT fk_UserRoles_User foreign key (user_id) references User(id),
            CONSTRAINT fk_UserRoles_Role foreign key (role_id) references Role(id),
            CONSTRAINT pk_id PRIMARY KEY (user_id, role_id)
        )";

    const USER_ROLE_INSERT_MOCK_DATA = "INSERT INTO UserRoles (user_id, role_id) VALUES 
                                        (1,1),
                                        (1,2),
                                        (2,1),
                                        (3,3),
                                        (4,3)";

    static function createStructure($db)
    {
        $db->execute(self::USER_ROLE_TABLE);
    }

    static function insertData($db)
    {
        $db->execute(self::USER_ROLE_INSERT_MOCK_DATA);
    }
}
