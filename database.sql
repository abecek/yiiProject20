CREATE TABLE `users` (
	`id_user` int(11) unsigned not null,
	`username` varchar(30) not null,
	`email` varchar(35) not null,
	`password_hash` varchar(255) not null,
	`gender` char(1) not null,
	`auth_key` varchar(32) not null,
	`date_register` datetime not null,
	`signature` varchar(255),
	`is_active` tinyint(1) default 0
);

ALTER TABLE `users`
	ADD PRIMARY KEY `id_user_pk`(`id_user`),
	ADD UNIQUE KEY `username_unique`(`username`),
	ADD UNIQUE KEY `email_unique`(`email`);
	
ALTER TABLE `users`
	MODIFY `id_user` int(11) unsigned not null AUTO_INCREMENT;
	
ALTER TABLE `users` 
	ADD CONSTRAINT `gender_chk` CHECK(`gender` = `M` OR `gender` = `K`),
	ADD CONSTRAINT `is_active_chk` CHECK(`is_active` = 0 OR `is_active` = 1 OR `is_active` = 2);
	
CREATE INDEX `username_idx1` ON `users`(`username`);
CREATE INDEX `email_idx1` ON `users`(`email`);

CREATE TABLE `bans`(
	`id_ban` mediumint unsigned PRIMARY KEY,
	`date_expire` datetime,
	`ip_number` varchar(15),
	/* format -> 0.0.0.0 - 255.255.255.255 */
	`description` varchar(300),
	`id_user` int(11) unsigned not null,
	`id_giver` int(11) unsigned not null,
	`id_post` int(11) unsigned
);

ALTER TABLE `bans`
	MODIFY `id_ban` mediumint unsigned not null AUTO_INCREMENT;

ALTER TABLE `bans` 
	ADD CONSTRAINT `id_user_fk1` FOREIGN KEY(`id_user`) REFERENCES `users`(`id_user`),
	ADD CONSTRAINT `id_giver_fk1` FOREIGN KEY(`id_giver`) REFERENCES `users`(`id_user`);
	
CREATE TABLE `threads`(
	`id_thread` mediumint unsigned PRIMARY KEY AUTO_INCREMENT,
	`title` varchar(300) not null,
	`count_displays` mediumint unsigned default 0,
	`state` tinyint(1) default 0,
	/* possible values: 0 - unpublished, 1 - published, 2 - pasted-up, 3 - deleted */ 
	`date_begin` datetime not null,
	`date_end` datetime,
	/* if date_end is null, that means thread is closed and its imposible to add new posts */
	/* `has_thumbnail` tinyint(1) default 0, 
		can be done by checking if thumbnail exists in php code
		so i suppose its not necessary to keep it in database
	*/
	/* `content` varchar(4000) not null, 
		Depends of approach
			frist option: thread has content as itself
			second: only posts have content and its impossible to create thread without first post
		Ive chosen second to simplify for example banning people for only specific post
	*/
	`id_author` int(11) unsigned not null,
	`id_section` smallint unsigned not null	
);

ALTER TABLE `threads`
	ADD CONSTRAINT `id_author_fk1` FOREIGN KEY (`id_author`) REFERENCES `users`(`id_user`),
	ADD CONSTRAINT `state_chk` CHECK(`state` IN (0,1,2,3));
	
CREATE TABLE `posts`(
	`id_post` int(11) unsigned PRIMARY KEY AUTO_INCREMENT,
	`content` varchar(4000) not null,
	`date_post` datetime not null,
	`is_deleted` tinyint(1) default 0,
	/* im not sure that is correct way */
	`id_thread` mediumint unsigned not null,
	`id_author` int(11) unsigned not null
);

ALTER TABLE `posts`
	ADD CONSTRAINT `id_author_fk2` FOREIGN KEY(`id_author`) REFERENCES `users`(`id_user`),
	ADD CONSTRAINT `id_thread_fk1` FOREIGN KEY(`id_thread`) REFERENCES `threads`(`id_thread`),
	ADD CONSTRAINT `is_deleted_chk` CHECK(`is_deleted` = 0 OR `is_deleted` = 1);
	
	
ALTER TABLE `bans`
	ADD CONSTRAINT `id_post_fk1` FOREIGN KEY(`id_post`) REFERENCES `posts`(`id_post`);
	
ALTER TABLE `bans` ADD COLUMN `id_message` int(11) unsigned;

/* 
	After adding foregin key to id_post is modified to "not null", im not sure ??
	Fix below
 */
alter table `bans` modify `id_post` int(11) unsigned default null;

CREATE table `sections` (
	`id_section` smallint unsigned PRIMARY KEY AUTO_INCREMENT,
	`name` varchar(50) not null,
	`description` varchar(250),
	`child_of` smallint unsigned null
);

ALTER TABLE `sections`
	ADD CONSTRAINT `child_of_inner_fk1` FOREIGN KEY(`child_of`) REFERENCES `sections`(`id_section`);
	
ALTER TABLE `threads`
	ADD CONSTRAINT `id_section_fk1` FOREIGN KEY(`id_section`) REFERENCES `sections`(`id_section`);

	
CREATE TABLE `chatbox_messages`(
	`id_message` int unsigned PRIMARY KEY AUTO_INCREMENT,
	`content` varchar(300) not null,
	`date_message` datetime not null,
	`id_author` int(11) unsigned not null
);

ALTER TABLE `chatbox_messages` 
	ADD CONSTRAINT `id_author_fk3` FOREIGN KEY(`id_author`) REFERENCES `users`(`id_user`);

ALTER TABLE `bans`
	ADD CONSTRAINT `id_message_fk1` FOREIGN KEY(`id_message`) REFERENCES `chatbox_messages`(`id_message`);
	
	
/*
	todo: Dodac ROLE!!!
*/
alter table `users` add column `rank` tinyint unsigned default 0;


