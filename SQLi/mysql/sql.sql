CREATE TABLE users(
                      id int,
                      name varchar(255),
                      pwd varchar(255)
);

insert into users values (0,'admin','admin');
insert into users values (1,'zs','123123');
insert into users values (2,'lisi','qaxcadwe');

create table books(
                     id int,
                     title varchar(155),
                     price int
);

insert into books values (0,'渗透测试',100);
insert into books values (1,'代码审计',198);
insert into books values (2,'二进制',99);