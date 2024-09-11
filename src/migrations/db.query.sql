
 /* Student, Cashier, Admin, Admission Committee, Board of Directors tương ứng với sinh viên, thu ngân, admin, ban tuyển sinh, và ban giám hiệu */
create table if not exists users(
    id int primary key auto_increment not null,
    username varchar(255) not null unique,
    email varchar(255) not null unique,
    password varchar(255) not null,
    fullName varchar(255) not null,
    phone varchar(255) not null unique,
    deleted tinyint(1) default 0,
    role ENUM('User', 'Cashier', 'Admin', 'AdmissionCommittee', 'BoardOfDirectors') default "User"
)