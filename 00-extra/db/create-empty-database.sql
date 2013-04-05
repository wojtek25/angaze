drop schema if exists symfony;
create schema symfony default character set utf8 collate utf8_polish_ci;
grant all on symfony.* to editor@localhost identified by 'secretPASSWORD';
flush privileges;