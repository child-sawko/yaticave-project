

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";
-- --------------------------------------------------------
-- Структура таблицы `bid`

CREATE TABLE `bid` (
                     `id_bid` int(11) NOT NULL,
                     `id_lot` int(11) DEFAULT NULL,
                     `id_user` int(11) NOT NULL,
                     `date_bid` datetime NOT NULL,
                     `sum` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
-- --------------------------------------------------------
-- Структура таблицы `category`

CREATE TABLE `category` (
                          `id_category` int(11) NOT NULL,
                          `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
-- --------------------------------------------------------

-- Структура таблицы `lot`


CREATE TABLE `lot` (
                     `id_lot` int(11) NOT NULL,
                     `id_winner` int(11) NOT NULL,
                     `id_user` int(11) NOT NULL,
                     `id_category` int(11) NOT NULL,
                     `date_create` datetime NOT NULL,
                     `name` varchar(250) NOT NULL,
                     `description` varchar(1000) NOT NULL,
                     `image_url` varchar(250) NOT NULL,
                     `start_price` int(11) NOT NULL,
                     `date_finish` datetime NOT NULL,
                     `bid_step` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
-- --------------------------------------------------------

-- Структура таблицы `users`


CREATE TABLE `users` (
                       `id_user` int(11) NOT NULL,
                       `date_registration` datetime NOT NULL,
                       `email` varchar(250) NOT NULL,
                       `name` varchar(250) NOT NULL,
                       `password` varchar(100) NOT NULL,
                       `avatar` varchar(250) NOT NULL,
                       `contacts` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- Индексы сохранённых таблиц


-- Индексы таблицы `bid`


ALTER TABLE `bid`
  ADD PRIMARY KEY (`id_bid`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_lot` (`id_lot`);


-- Индексы таблицы `category`

ALTER TABLE `category`
  ADD PRIMARY KEY (`id_category`);


-- Индексы таблицы `lot`

ALTER TABLE `lot`
  ADD PRIMARY KEY (`id_lot`,`id_winner`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_category` (`id_category`),
  ADD KEY `id_winner` (`id_winner`);


-- Индексы таблицы `users`

ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);


-- AUTO_INCREMENT для сохранённых таблиц



-- AUTO_INCREMENT для таблицы `bid`

ALTER TABLE `bid`
  MODIFY `id_bid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;


-- AUTO_INCREMENT для таблицы `category`

ALTER TABLE `category`
  MODIFY `id_category` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;


-- AUTO_INCREMENT для таблицы `lot`


ALTER TABLE `lot`
  MODIFY `id_lot` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;


-- AUTO_INCREMENT для таблицы `users`

ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;


-- Ограничения внешнего ключа сохраненных таблиц



-- Ограничения внешнего ключа таблицы `bid`

ALTER TABLE `bid`
  ADD CONSTRAINT `bid_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bid_ibfk_2` FOREIGN KEY (`id_lot`) REFERENCES `lot` (`id_lot`) ON DELETE CASCADE ON UPDATE CASCADE;

-- Ограничения внешнего ключа таблицы `lot`

ALTER TABLE `lot`
  ADD CONSTRAINT `lot_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lot_ibfk_2` FOREIGN KEY (`id_category`) REFERENCES `category` (`id_category`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `lot_ibfk_3` FOREIGN KEY (`id_winner`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
