drop schema if exists angaze;
create schema angaze default character set utf8 collate utf8_polish_ci;
grant all on angaze.* to editor@localhost identified by 'secretPASSWORD';
flush privileges;
