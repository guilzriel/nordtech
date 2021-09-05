## Database Structure

### table universities
```
CREATE TABLE `domains` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `id_university` int(255) DEFAULT NULL,
  `domain_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_university` (`id_university`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
```

### table domains
```
CREATE TABLE `domains` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `id_university` int(255) DEFAULT NULL,
  `domain_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_university` (`id_university`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4735 DEFAULT CHARSET=utf8;
```

### table web_pages
```
CREATE TABLE `web_pages` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `id_university` int(255) NOT NULL,
  `url` varchar(2083) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_university` (`id_university`)
) ENGINE=InnoDB AUTO_INCREMENT=4677 DEFAULT CHARSET=utf8;
```
