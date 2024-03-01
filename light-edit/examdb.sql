SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE TABLE IF NOT EXISTS `phonecontact` (
                                              `id` int(11) NOT NULL AUTO_INCREMENT,
    `name` varchar(100) NOT NULL,
    `phonenumber` int(10) NOT NULL,
    PRIMARY KEY (`id`)
    ) ENGINE = InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=4;

INSERT INTO `phonecontact` (`id`, `name`, `phonenumber`) VALUES
                                                             (1, 'Tuan Anh', 0386636286),
                                                             (2, 'Hoang Phong', 0379007856),
                                                             (3, 'Minh Bui', 0333434754 );