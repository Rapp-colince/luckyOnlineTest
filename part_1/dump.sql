# 1. Спроектировать БД для хранения книг и категорий, к которым эти книги относятся.
CREATE TABLE `books` (
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
    `circulation` int(10) unsigned NOT NULL,
    `cover_type` tinyint(1) unsigned NOT NULL COMMENT '0 - soft, 1 - strong',
    `categories_count` int(10) unsigned NOT NULL DEFAULT 0,
    PRIMARY KEY (`id`),
    KEY `circulation_cover_categories` (`circulation`,`cover_type`,`categories_count`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;


CREATE TABLE `categories` (
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;


CREATE TABLE `books_categories` (
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `book_id` int(10) unsigned NOT NULL,
    `category_id` int(10) unsigned NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `book_category` (`book_id`,`category_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;


# В реальном проекте я бы разделил таблицу books на 2 сущности: книги, и информация о тираже, так как одна книга может издаваться несколько раз, разными тиражами в разных обложках.
# Но так как в условии задачи тираж и обложка называются свойствами книги, то считаем, что это будут данные одной таблицы.


