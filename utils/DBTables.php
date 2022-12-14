<?php

function create_role_table(){
    return "CREATE TABLE IF NOT EXISTS Role(
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(20) NOT NULL UNIQUE
    );";
}

function create_app_user_table(){
    return "CREATE TABLE IF NOT EXISTS User(
            id INT AUTO_INCREMENT PRIMARY KEY,
            email VARCHAR(20) NOT NULL UNIQUE,
            password VARCHAR(32) NOT NULL,
            first_name VARCHAR(30) NOT NULL,
            last_name VARCHAR(20) NOT NULL,
            prefix VARCHAR(10)
    );";
}

function create_user_role_table(){
    return "CREATE TABLE IF NOT EXISTS UserRole(
            user_id INT,
            role_id INT,
            FOREIGN KEY (user_id) REFERENCES user(id),
            FOREIGN KEY (role_id) REFERENCES role(id),
            PRIMARY KEY (user_id, role_id)
    );";
}

function create_group_table(){
    return "CREATE TABLE IF NOT EXISTS `Group`(
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(10) NOT NULL
    );";
}

function create_group_user_table(){
    return "CREATE TABLE IF NOT EXISTS GroupUser(
            user_id INT,
            group_id INT,
            FOREIGN KEY (user_id) REFERENCES user(id),
            FOREIGN KEY (group_id) REFERENCES `group`(id),
            PRIMARY KEY (user_id, group_id)
    );";
}

function create_course_table(){
    return "CREATE TABLE IF NOT EXISTS Course(
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(25) NOT NULL,
            type ENUM('Lecture', 'Seminary', 'Laboratory') NOT NULL
    );";
}

function create_group_course_table(){
    return "CREATE TABLE IF NOT EXISTS GroupCourse(
            course_id INT,
            group_id INT,
            FOREIGN KEY (course_id) REFERENCES course(id),
            FOREIGN KEY (group_id) REFERENCES `group`(id),
            PRIMARY KEY (course_id, group_id)
    );";
}

function create_room_table(){
    return "CREATE TABLE IF NOT EXISTS Room(
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(20) NOT NULL UNIQUE,
            capacity INT NOT NULL CHECK(capacity >= 0)
    );";
}

function create_scheduled_course_table(){
    return "CREATE TABLE IF NOT EXISTS ScheduledCourse(
            id INT AUTO_INCREMENT PRIMARY KEY,
            room_id INT NOT NULL,
            course_id INT NOT NULL,
            from_date DATETIME NOT NULL,
            until_date DATETIME NOT NULL,
            FOREIGN KEY (course_id) REFERENCES course(id),
            FOREIGN KEY (room_id) REFERENCES room(id)
    );";
}

function create_course_attendance_table(){
    return "CREATE TABLE IF NOT EXISTS CourseAttendance(
        user_id INT,
        scheduled_course_id INT,
        attended BOOLEAN NOT NULL DEFAULT 1,
        `leave` VARCHAR(100),
        PRIMARY KEY(user_id, scheduled_course_id)
    );";
}

?>