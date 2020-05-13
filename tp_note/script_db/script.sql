CREATE DATABASE 'tp_note';
CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(254) NOT NULL,
  `password` varchar(254) NOT NULL,
  `email` varchar(254) NOT NULL
)

INSERT INTO `users` (`user_id`,`username`,`password`,`email`) VALUES (1,'Adrien','2522f7c9c098302a41f4e8b2bd821d94','test123@test.com') 


ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;