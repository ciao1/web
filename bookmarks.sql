create database bookmarks;
use bookmarks;

create table user(
	username varchar(16) not null primary key,
	passwd char(40) not null,
	email varchar(100) not null
);

create table bookmark(
	username varchar(16) not null,
	bm_URL varchar(255) not null,
	index (username),
	index (bm_URL),
	primary key(username, bm_URL)
);

/*增加一个用户bm_user密码为password，让他可以在localhost主机上登录,
并对数据库bookmarks有查询、插入、修改、删除的权限。*/
grant select, insert, update,delete
	on bookmarks.*
	to bm_user@localhost identified by 'password';