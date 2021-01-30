# sql_image
将图片存储在MySQL数据库中并通过php随机返回图片的简易脚本
（一个练习中的烂摊子……）

经多次测试，MySQL中的MyISAM存储引擎最适合存储大量的图片数据

images.php返回随机图片

images_r1.php和images_r2.php是images.php拆分版本，用于部分图片预览图与URL绑定的情况

images.sql是数据库中数据表的初始数据

sql_image.php用于爬取图片保存到数据库，需要配合其他外部脚本实现自动化

sql_image_config.php保存了多数可更改的配置，必填
