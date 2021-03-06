# SQL 1: Вернуть книги, выпущенные в твёрдой обложке, тиражом 5000 экз., которые относятся больше чем к трём категориям
# Классический запрос будет выглядеть так.
SELECT books.name
FROM books, (
    SELECT book_id FROM books_categories GROUP BY book_id HAVING COUNT(*) > 3
) as books_more_3_categories
WHERE books.id = books_more_3_categories.book_id
	AND circulation = 5000
    AND cover_type = 1;

# Проблема этого запроса в том, что с ростом количества книг, будет расти сложность запроса. Например, если книг 1 млн,
# а записей книга—категория 4 млн, то сложность этого запроса будет равна 5млн у.е.
# На средненьком сервере, (за 50 евро в месяц, без SSD), этот запрос будет выполняться минут 5-7.
# Я считаю, что нужно денормализовать таблицу books, добавив в нее количество категорий, в которых эта книга присутствует.
# Связь книга—категория практически никогда не меняется, поэтому обслуживать эту денормализацию будет дешево.
# Поэтому запрос к денормализованной таблице будет выглядеть так:

SELECT books.name
FROM books
WHERE circulation = 500
  AND cover_type = 1
  AND categories_count > 3;
# В этом случае, стоимость запроса составляет 3 у.е (мгновенно)
