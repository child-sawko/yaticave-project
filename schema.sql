-- Запрос на создание всей базы данных, со связями, и ключами.

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";



-- База данных: `bd-yeticave`

CREATE DATABASE bd-yeticave;
use bd-yeticave;
-- --------------------------------------------------------


-- Структура таблицы `bid`


CREATE TABLE `bid` (
                     `data-bid` datetime NOT NULL,
                     `sum` int NOT NULL,
                     `id-users` int NOT NULL,
                     `id-bid` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------


-- Структура таблицы `category`


CREATE TABLE `category` (
                          `id-category` int NOT NULL,
                          `name` varchar(256) NOT NULL,
                          `id-users` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------


-- Структура таблицы `lot`


CREATE TABLE `lot` (
                     `data-create` date NOT NULL,
                     `name` int NOT NULL,
                     `disscription` varchar(512) NOT NULL,
                     `img-url` varchar(1024) NOT NULL,
                     `start-price` int NOT NULL,
                     `step-bid` int NOT NULL,
                     `data-finish` int NOT NULL,
                     `author` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
                     `winner` int NOT NULL,
                     `id-lot` int NOT NULL,
                     `id-category` int NOT NULL,
                     `id-users` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------


-- Структура таблицы `users`


CREATE TABLE `users` (
                       `data-registration` int NOT NULL,
                       `email` int NOT NULL,
                       `username` int NOT NULL,
                       `password` int NOT NULL,
                       `img-avatar` blob NOT NULL,
                       `contacts` varchar(128) NOT NULL,
                       `id-users` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;


-- Индексы сохранённых таблиц



-- Индексы таблицы `bid`

ALTER TABLE `bid`
  ADD PRIMARY KEY (`id-bid`),
  ADD UNIQUE KEY `id-users` (`id-users`),
  ADD UNIQUE KEY `sum` (`sum`);


-- Индексы таблицы `category`

ALTER TABLE `category`
  ADD PRIMARY KEY (`id-category`),
  ADD UNIQUE KEY `id-users` (`id-users`);


-- Индексы таблицы `lot`

ALTER TABLE `lot`
  ADD PRIMARY KEY (`id-lot`),
  ADD UNIQUE KEY `winner` (`winner`),
  ADD UNIQUE KEY `id-category` (`id-category`),
  ADD UNIQUE KEY `id-users` (`id-users`),
  ADD UNIQUE KEY `start-price` (`start-price`);


-- Индексы таблицы `users`

ALTER TABLE `users`
  ADD PRIMARY KEY (`id-users`);


-- AUTO_INCREMENT для сохранённых таблиц



-- AUTO_INCREMENT для таблицы `bid`

ALTER TABLE `bid`
  MODIFY `id-bid` int NOT NULL AUTO_INCREMENT;


-- AUTO_INCREMENT для таблицы `category`

ALTER TABLE `category`
  MODIFY `id-category` int NOT NULL AUTO_INCREMENT;


-- AUTO_INCREMENT для таблицы `lot`

ALTER TABLE `lot`
  MODIFY `id-lot` int NOT NULL AUTO_INCREMENT;


-- AUTO_INCREMENT для таблицы `users`

ALTER TABLE `users`
  MODIFY `id-users` int NOT NULL AUTO_INCREMENT;


-- Ограничения внешнего ключа сохраненных таблиц



-- Ограничения внешнего ключа таблицы `category`

ALTER TABLE `category`
  ADD CONSTRAINT `category_ibfk_1` FOREIGN KEY (`id-category`) REFERENCES `lot` (`id-category`) ON DELETE RESTRICT ON UPDATE RESTRICT;


-- Ограничения внешнего ключа таблицы `users`

ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id-users`) REFERENCES `lot` (`winner`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`id-users`) REFERENCES `lot` (`id-users`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `users_ibfk_3` FOREIGN KEY (`id-users`) REFERENCES `bid` (`id-users`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;
