
create table if not exists users(
    id int primary key auto_increment not null,
    username varchar(255) not null unique,
    email varchar(255) not null unique,
    password varchar(255) not null,
    created_at timestamp default current_timestamp
    on update current_timestamp
)