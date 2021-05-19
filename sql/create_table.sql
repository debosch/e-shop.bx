CREATE TABLE user
(
	ID    int          not null auto_increment,
	NAME  varchar(100) not null,
	EMAIL varchar(100),
	PHONE varchar(20),
	HASH  int,
	PRIMARY KEY (ID)
);

CREATE TABLE tag
(
	ID   int          not null auto_increment,
	NAME varchar(100) not null,
	PRIMARY KEY (ID)
);

CREATE TABLE image
(
	ID        int          not null auto_increment,
	PATH      varchar(300),
	NAME      varchar(100) not null,
	FILE_NAME varchar(200) not null,
	PRIMARY KEY (ID)
);

CREATE TABLE item
(
	ID                int(11) not null auto_increment,
	NAME              varchar(100)     not null,
	PRICE             DECIMAL(10, 2),
	SHORT_DESCRIPTION varchar(350),
	LONG_DESCRIPTION  varchar(700),
	CREATION          date,
	MODIFY            date,
	ACTIVITY          datetime,
	AMOUNT            int unsigned,
	CATEGORY          varchar(100),
	PRODUCER          varchar(100),
	PRIMARY KEY (ID)
);

CREATE TABLE item_tag
(
	ITEM_ID int not null,
	TAG_ID  int not null,
	PRIMARY KEY (ITEM_ID, TAG_ID),
	INDEX IX_TAG (TAG_ID),
	FOREIGN KEY FK_ITEM_TAG_ITEM (ITEM_ID) references item (ID)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT,
	FOREIGN KEY FK_ITEM_TAG_TAG (TAG_ID) references tag (ID)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT
);

CREATE TABLE item_image
(
	ITEM_ID  int not null,
	IMAGE_ID int not null,
	PRIMARY KEY (ITEM_ID, IMAGE_ID),
	INDEX IX_IMAGE (IMAGE_ID),
	FOREIGN KEY FK_ITEM_IMAGE_ITEM (ITEM_ID) references item (ID)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT,
	FOREIGN KEY FK_ITEM_IMAGE_IMAGE (IMAGE_ID) references image (ID)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT
);

CREATE TABLE orders
(
	ID            int(11) not null auto_increment,
	CREATION      date,
	MODIFY        date,
	COMMENT       varchar(300),
	STATUS        varchar(100),
	ADMIN_COMMENT varchar(300),
	USER_ID       int(11) not null,
	PRIMARY KEY (ID),
	INDEX IX_ORDER_USER (USER_ID),
	FOREIGN KEY FK_ORDER_USER (USER_ID) references user (ID)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT
);

CREATE TABLE admin
(
	ID            int(11)       unsigned not null auto_increment,
	LOGIN         varchar(100)           not null,
	PASSWORD      varchar(100)           not null,
	LAST_ACTIVITY datetime,
	PRIMARY KEY (ID)
);


SET FOREIGN_KEY_CHECKS = 0;

drop database team_a;

select * from item;

delete from item where id = 27;

