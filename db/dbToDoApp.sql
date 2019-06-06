DROP DATABASE IF EXISTS dbToDoApp;
CREATE DATABASE IF NOT EXISTS dbToDoApp;
USE dbToDoApp;

CREATE TABLE users(
	idUser int primary key auto_increment,
    fullName varchar(100) not null,
    userName varchar(50) not null,
    userPhoto varchar(100),
    userMail varchar(100) not null,
    userPass varchar(30) not null
);

CREATE TABLE task(
	idTask int primary key auto_increment,
    idUser int,
    taskTitle varchar(50) not null,
    taskBody text,
    taskPriority int not null,
    foreign key(idUser) references users(idUser)
);

-- drop procedure spGetUserLogin;

DELIMITER //
CREATE PROCEDURE spGetUserLogin(
	in userIn varchar(100),
    in pass varchar(30)
)
BEGIN
	select * 
    from users where userMail = userIn 
    and userPass = pass; 
END //
DELIMITER ;
-- call spGetUserLogin('steven97cr@outlook.com','qleimporta');
--  drop procedure spAddUser;
DELIMITER //
CREATE PROCEDURE spAddUser(
	in fullName varchar(100),
    in userName varchar(50),
    in userPhoto varchar(100),
    in userMail varchar(100),
    in userPass varchar(30)
)
BEGIN
	insert into users(fullName, userName, userPhoto, userMail, userPass)
    values(fullName, userName,userPhoto, userMail, userPass);
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE spGetTask(
	in taskID int
)
BEGIN
	select * from task where idTask = taskID;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE spGetTasks(
	in userID int
)
BEGIN
	select * from task where idUser = userID;
END //
DELIMITER ;
-- drop procedure spAddTask;
DELIMITER //
CREATE PROCEDURE  spAddTask(
	in userID int,
    in taskTitle varchar(50),
    in taskBody text,
    in taskPriority int 
)
BEGIN
	insert into task(idUser, taskTitle, taskBody, taskPriority)
    values(userID, taskTitle, taskBody, taskPriority);
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE spEditTask(
	in taskID int,
    in taskTitle varchar(50),
    in taskBody text,
    in taskPriority int
)
BEGIN
	update task t set
    t.taskTitle = taskTitle,
    t.taskBody  = taskBody,
    t.taskPriority = taskPriority
    where idTask = taskID;
    select * from task where idTask = taskID; 
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE spDeleteTask(
	in taskID int
)
BEGIN
	delete from task
    where idTask = taskID;
END //
DELIMITER ;

select * from users;
call spAddTask(1,'Dormir','Tengo que dormir',3);
select * from task;

