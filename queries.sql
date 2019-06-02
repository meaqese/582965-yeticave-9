INSERT INTO
  `categories` (`name`,`signcode`)
VALUES
  ('Доски и лыжи','boards'),('Крепления ','attachment'),('Ботинки','boots'),('Одежда','clothing'),('Инструменты','tools'),('Разное','other');

INSERT INTO
  `users` (`regdate`,`email`,`name`,`password`,`avatar`,`contacts`)
VALUES
  (NOW(),'user01@m.co','Ivan','hashpass','imgur.com/dsfasd.png','ivan'),
  (NOW(),'user02@m.co','Ivanich','hashpassword','imgur.com/asd.png','ivanich');

INSERT INTO
  `lot` (`author_id`,`winner_id`,`category_id`,`dateadd`,`lotname`,`lotdesc`,`imgurl`,`firstprice`,`enddate`,`bidstep`)
VALUES
  ('1','2','1',NOW(),'2014 Rossignol District Snowboard','2014 Rossignol District Snowboard','img/lot-1.jpg','10999',TIMESTAMP('2019-05-25'),'10'),
  ('1','1','1',NOW(),'DC Ply Mens 2016/2017 Snowboard','DC Ply Mens 2016/2017 Snowboard','img/lot-2.jpg','159999',TIMESTAMP('2019-05-24'),'10'),
  ('2','1','2',NOW(),'Крепления Union Contact Pro 2015 года размер L/XL','Крепления Union Contact Pro 2015 года размер L/XL','img/lot-3.jpg','8000',TIMESTAMP('2019-05-19'),'10'),
  ('2','2','3',NOW(),'Ботинки для сноуборда DC Mutiny Charocal','Ботинки для сноуборда DC Mutiny Charocal','img/lot-4.jpg','10999',TIMESTAMP('2019-05-19'),'10'),
  ('1','1','4',NOW(),'Куртка для сноуборда DC Mutiny Charocal','Куртка для сноуборда DC Mutiny Charocal','img/lot-5.jpg','7500',TIMESTAMP('2019-05-25'),'10'),
  ('1','2','6',NOW(),'Маска Oakley Canopy','Маска Oakley Canopy','img/lot-6.jpg','5400',TIMESTAMP('2019-05-25'),'10');

INSERT INTO
  `bids` (`bidate`,`offer`,`user_id`,`lot_id`)
VALUES
  (NOW() - INTERVAL 1 DAY,'11100','2','1'),
  (NOW() - INTERVAL 1 HOUR,'12000','1','1');


/* SELECT QUERIES */

/*Categories*/
SELECT `name` FROM `categories`;

/* NEW AND OPEN LOTS */

SELECT `lotname`,`firstprice`,`imgurl`,cary.name, MAX(bids.offer)
FROM `lot`
INNER JOIN `categories` cary ON cary.id = lot.category_id
INNER JOIN `bids` ON bids.lot_id = lot.id
WHERE `enddate` > TIMESTAMP(NOW())
GROUP BY bids.lot_id
ORDER BY `dateadd` DESC;

/* LOT FROM ID */
SELECT `lotname`, cary.name
FROM `lot`
INNER JOIN  `categories` cary ON cary.id = lot.category_id;

/* UPDATE LOT NAME */
UPDATE `lot` SET `lotname` = 'DC Ply Mens 2019' WHERE `id` = '1';

/* SELECT A BIDS */
SELECT `bidate`,`offer`,users.name, lot.lotname
FROM `bids`
INNER JOIN `lot` ON lot.id = bids.lot_id
INNER JOIN `users` ON users.id = bids.user_id
ORDER BY `bidate` DESC;