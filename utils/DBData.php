<?php
function insert_role_table(){
    return "INSERT IGNORE INTO Role(name) values('admin'), ('professor'), ('student')";
}

function insert_app_user_table(){
    return "INSERT IGNORE INTO App_User(email, password, first_name, last_name, prefix) values('appadmin@gmail.com', 'admin123', 'Admin', 'Data', 'ADM'), ('appprofessor@gmail.com', 'professor123', 'Professor', 'Data', 'PHD'), ('appstudent@gmail.com', 'student123', 'Student', 'Data', 'STUD')";
}

function insert_user_role_table(){
    return "INSERT IGNORE INTO User_Role(user_id, role_id) values(1, 1), (2, 2), (3, 3)";
}
function insert_group_table(){
    return "INSERT IGNORE INTO `Group`(name) values ('932'), ('211'), ('935')";
}

function insert_group_user_table(){
    return "INSERT IGNORE INTO Group_User(user_id, group_id) values(2, 1), (2, 2), (2, 3), (3, 1)";
}

function insert_course_table(){
    return "INSERT IGNORE INTO Course(name, type) values('AI', 'Lecture'), ('AI', 'Seminary'), ('AI', 'Laboratory'), ('ASC', 'Lecture'), ('ASC', 'Seminary'), ('ASC', 'Laboratory')";
}

function insert_group_course_table(){
    return "INSERT IGNORE INTO Group_Course(course_id, group_id) values(1, 1), (2, 1), (3, 1), (4, 1), (5, 1), (6, 1), (4, 2), (5, 2), (6, 2), (1, 3), (2, 3), (3, 3), (4, 3), (5, 3), (6, 3)";
}

function insert_room_table(){
    return "INSERT IGNORE INTO Room(name, capacity) values('Nicolae Iorga', 200), ('C1', 35), ('C2', 35), ('C3', 15)";
}

function insert_scheduled_course_table(){
    return "INSERT IGNORE INTO Scheduled_Course(room_id, course_id, from_date, until_date) values(1, 1, '2022-10-27 10:00:00', '2020-10-27 12:00:00'), (2, 2, '2022-10-28 14:00:00', '2022-10-28 16:00:00'), (4, 3, '2022-10-28 18:00:00', '2022-10-28 20:00:00')";
}

function insert_course_attendance_table(){
    return "INSERT IGNORE INTO Course_Attendance(user_id, scheduled_course_id) values(2, 1), (3, 1), (3, 2), (3, 3)";
}
?>