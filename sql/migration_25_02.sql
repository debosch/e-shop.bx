delete from item_image where IMAGE_ID > 0;
SET FOREIGN_KEY_CHECKS = 0;
select * from item_image;
drop table image;

CREATE TABLE image
(
	ID        int          not null auto_increment,
	PATH      varchar(300),
	NAME      varchar(100) not null,
	FILE_NAME varchar(200) not null,
	PRIMARY KEY (ID)
);

insert into image( NAME, FILE_NAME, PATH) value ('proc1_1', 'proc1_1.jpg', '../resource_images/proc/');
insert into image(NAME, FILE_NAME, PATH) value ('proc1_2', 'proc1_2.jpg', '../resource_images/proc/');
insert into item_image(ITEM_ID, IMAGE_ID) values (1,1),
                                                 (1,2);

insert into image(NAME, FILE_NAME, PATH) values ('proc2_1', 'proc2_1.jpg', '../resource_images/proc/'),
												('proc2_2', 'proc2_2.jpg', '../resource_images/proc/'),
												('proc2_3', 'proc2_3.jpg', '../resource_images/proc/'),
												('proc2_4', 'proc2_4.jpg', '../resource_images/proc/');
insert into item_image(ITEM_ID, IMAGE_ID) values (2,3),
                                                 (2,4),
                                                 (2,5),
                                                 (2,6);

insert into image(NAME, FILE_NAME, PATH) values ('proc3_1', 'proc3_1.jpg', '../resource_images/proc/'),
                                                ('proc3_2', 'proc3_2.jpg', '../resource_images/proc/');
insert into item_image(ITEM_ID, IMAGE_ID) values (3,7),
                                                 (3,8);

insert into image(NAME, FILE_NAME, PATH) values ('proc4_1', 'proc4_1.jpg', '../resource_images/proc/'),
                                                ('proc4_2', 'proc4_2.jpg', '../resource_images/proc/');
insert into item_image(ITEM_ID, IMAGE_ID) values (4,9),
                                                 (4,10);

insert into image(NAME, FILE_NAME, PATH) values ('proc5_1', 'proc5_1.jpg', '../resource_images/proc/'),
                                                ('proc5_2', 'proc5_2.jpg', '../resource_images/proc/');
insert into item_image(ITEM_ID, IMAGE_ID) values (5,11),
                                                 (5,12);

insert into image(NAME, FILE_NAME, PATH) values ('mat1_1', 'mat1_1.jpg', '../resource_images/mat/'),
                                                ('mat1_2', 'mat1_2.jpg', '../resource_images/mat/'),
                                                ('mat1_3', 'mat1_3.jpg', '../resource_images/mat/');
insert into item_image(ITEM_ID, IMAGE_ID) values (6,13),
                                                 (6,14),
                                                 (6,15);

insert into image(NAME, FILE_NAME, PATH) values ('mat2_1', 'mat2_1.jpg', '../resource_images/mat/'),
                                                ('mat2_2', 'mat2_2.jpg', '../resource_images/mat/'),
                                                ('mat2_3', 'mat2_3.jpg', '../resource_images/mat/');
insert into item_image(ITEM_ID, IMAGE_ID) values (7,16),
                                                 (7,17),
                                                 (7,18);

insert into image(NAME, FILE_NAME, PATH) values ('mat3_1', 'mat3_1.jpg', '../resource_images/mat/'),
                                                ('mat3_2', 'mat3_2.jpg', '../resource_images/mat/'),
                                                ('mat3_3', 'mat3_3.jpg', '../resource_images/mat/');
insert into item_image(ITEM_ID, IMAGE_ID) values (8,19),
                                                 (8,20),
                                                 (8,21);

insert into image(NAME, FILE_NAME, PATH) values ('mat4_1', 'mat4_1.png', '../resource_images/mat/'),
                                                ('mat4_2', 'mat4_2.jpg', '../resource_images/mat/'),
                                                ('mat4_3', 'mat4_3.jpg', '../resource_images/mat/');
insert into item_image(ITEM_ID, IMAGE_ID) values (9,22),
                                                 (9,23),
                                                 (9,24);

insert into image(NAME, FILE_NAME, PATH) values ('mat5_1', 'mat5_1.jpg', '../resource_images/mat/'),
                                                ('mat5_2', 'mat5_2.jpg', '../resource_images/mat/'),
                                                ('mat5_3', 'mat5_3.jpg', '../resource_images/mat/');
insert into item_image(ITEM_ID, IMAGE_ID) values (10,25),
                                                 (10,26),
                                                 (10,27);

insert into image(NAME, FILE_NAME, PATH) values ('gpu1_1', 'gpu1_1.jpg', '../resource_images/gpu/'),
                                                ('gpu1_2', 'gpu1_2.jpg', '../resource_images/gpu/'),
                                                ('gpu1_3', 'gpu1_3.jpg', '../resource_images/gpu/'),
                                                ('gpu1_4', 'gpu1_4.jpg', '../resource_images/gpu/');
insert into item_image(ITEM_ID, IMAGE_ID) values (11,28),
                                                 (11,29),
                                                 (11,30),
                                                 (11,31);

insert into image(NAME, FILE_NAME, PATH) values ('gpu2_1', 'gpu2_1.jpg', '../resource_images/gpu/'),
                                                ('gpu2_2', 'gpu2_2.jpg', '../resource_images/gpu/'),
                                                ('gpu2_3', 'gpu2_3.jpg', '../resource_images/gpu/'),
                                                ('gpu2_4', 'gpu2_4.jpg', '../resource_images/gpu/');
insert into item_image(ITEM_ID, IMAGE_ID) values (12,32),
                                                 (12,33),
                                                 (12,34),
                                                 (12,35);

insert into image(NAME, FILE_NAME, PATH) values ('gpu3_1', 'gpu3_1.jpg', '../resource_images/gpu/'),
                                                ('gpu3_2', 'gpu3_2.jpg', '../resource_images/gpu/'),
                                                ('gpu3_3', 'gpu3_3.jpg', '../resource_images/gpu/'),
                                                ('gpu3_4', 'gpu3_4.jpg', '../resource_images/gpu/');
insert into item_image(ITEM_ID, IMAGE_ID) values (13,36),
                                                 (13,37),
                                                 (13,38),
                                                 (13,39);

insert into image(NAME, FILE_NAME, PATH) values ('gpu4_1', 'gpu4_1.jpg', '../resource_images/gpu/'),
                                                ('gpu4_2', 'gpu4_2.jpg', '../resource_images/gpu/');
insert into item_image(ITEM_ID, IMAGE_ID) values (14,40),
                                                 (14,41);

insert into image(NAME, FILE_NAME, PATH) values ('gpu5_1', 'gpu5_1.jpg', '../resource_images/gpu/'),
                                                ('gpu5_2', 'gpu5_2.jpg', '../resource_images/gpu/'),
                                                ('gpu5_3', 'gpu5_3.jpg', '../resource_images/gpu/'),
                                                ('gpu5_4', 'gpu5_4.jpg', '../resource_images/gpu/');
insert into item_image(ITEM_ID, IMAGE_ID) values (15,42),
                                                 (15,43),
                                                 (15,44),
                                                 (15,45);

insert into image(NAME, FILE_NAME, PATH) values ('ram1_1', 'ram1_1.jpg', '../resource_images/ram/'),
                                                ('ram1_2', 'ram1_2.jpg', '../resource_images/ram/');
insert into item_image(ITEM_ID, IMAGE_ID) values (16,46),
                                                 (16,47);

insert into image(NAME, FILE_NAME, PATH) values ('ram2_1', 'ram2_1.jpg', '../resource_images/ram/'),
                                                ('ram2_2', 'ram2_2.jpg', '../resource_images/ram/'),
                                                ('ram2_3', 'ram2_3.jpg', '../resource_images/ram/');
insert into item_image(ITEM_ID, IMAGE_ID) values (17,48),
                                                 (17,49),
                                                 (17,50);

insert into image(NAME, FILE_NAME, PATH) values ('ram3_1', 'ram3_1.jpg', '../resource_images/ram/'),
                                                ('ram3_2', 'ram3_2.jpg', '../resource_images/ram/'),
                                                ('ram3_3', 'ram3_3.jpg', '../resource_images/ram/');
insert into item_image(ITEM_ID, IMAGE_ID) values (18,51),
                                                 (18,52),
                                                 (18,53);

insert into image(NAME, FILE_NAME, PATH) values ('ram4_1', 'ram4_1.jpg', '../resource_images/ram/'),
                                                ('ram4_2', 'ram4_2.jpg', '../resource_images/ram/'),
                                                ('ram4_3', 'ram4_3.jpg', '../resource_images/ram/');
insert into item_image(ITEM_ID, IMAGE_ID) values (19,54),
                                                 (19,55),
                                                 (19,56);

insert into image(NAME, FILE_NAME, PATH) values ('ram5_1', 'ram5_1.jpg', '../resource_images/ram/'),
                                                ('ram5_2', 'ram5_2.jpg', '../resource_images/ram/'),
                                                ('ram5_3', 'ram5_3.jpg', '../resource_images/ram/'),
                                                ('ram5_4', 'ram5_4.jpg', '../resource_images/ram/');
insert into item_image(ITEM_ID, IMAGE_ID) values (20,57),
                                                 (20,58),
                                                 (20,59),
                                                 (20,60);

insert into image(NAME, FILE_NAME, PATH) values ('hd1_1', 'hd1_1.jpg', '../resource_images/hd/'),
                                                ('hd1_2', 'hd1_2.jpg', '../resource_images/hd/');
insert into item_image(ITEM_ID, IMAGE_ID) values (21,61),
                                                 (21,62);

insert into image(NAME, FILE_NAME, PATH) values ('hd2_1', 'hd2_1.jpg', '../resource_images/hd/'),
                                                ('hd2_2', 'hd2_2.jpg', '../resource_images/hd/'),
                                                ('hd2_3', 'hd2_3.jpg', '../resource_images/hd/');
insert into item_image(ITEM_ID, IMAGE_ID) values (22,63),
                                                 (22,64),
                                                 (22,65);

insert into image(NAME, FILE_NAME, PATH) values ('hd3_1', 'hd3_1.jpg', '../resource_images/hd/'),
                                                ('hd3_2', 'hd3_2.jpg', '../resource_images/hd/'),
                                                ('hd3_3', 'hd3_3.jpg', '../resource_images/hd/');
insert into item_image(ITEM_ID, IMAGE_ID) values (23,66),
                                                 (23,67),
                                                 (23,68);

insert into image(NAME, FILE_NAME, PATH) values ('hd4_1', 'hd4_1.jpg', '../resource_images/hd/'),
                                                ('hd4_2', 'hd4_2.jpg', '../resource_images/hd/'),
                                                ('hd4_3', 'hd4_3.jpg', '../resource_images/hd/');
insert into item_image(ITEM_ID, IMAGE_ID) values (24,69),
                                                 (24,70),
                                                 (24,71);

insert into image(NAME, FILE_NAME, PATH) values ('hd5_1', 'hd5_1.jpg', '../resource_images/hd/'),
                                                ('hd5_2', 'hd5_2.jpg', '../resource_images/hd/'),
                                                ('hd5_3', 'hd5_3.jpg', '../resource_images/hd/');
insert into item_image(ITEM_ID, IMAGE_ID) values (25,72),
                                                 (25,73),
                                                 (25,74);
