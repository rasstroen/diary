<?php  /* GENERATED AUTOMATICALLY AT 2011-10-03, DO NOT MODIFY */
class LibPages{
public static $pages = 
array (
  'main' => 
  array (
    'title' => 'Главная ',
    'name' => 'main',
    'params' => 
    array (
      'cache' => false,
      'cache_sec' => 0,
    ),
    'xslt' => 'main.xsl',
    'modules' => 
    array (
    ),
  ),
  'register' => 
  array (
    'title' => 'Регистрация',
    'name' => 'register',
    'params' => 
    array (
      'cache' => false,
      'cache_sec' => 0,
    ),
    'xslt' => 'register/index.xsl',
    'modules' => 
    array (
      0 => 
      array (
        'register' => 
        array (
          'roles' => 
          array (
            '' => '',
          ),
          'action' => 'show',
          'mode' => '',
          'params' => 
          array (
          ),
        ),
      ),
    ),
  ),
  'emailconfirm' => 
  array (
    'title' => 'Подтверждение email',
    'name' => 'emailconfirm',
    'params' => 
    array (
      'cache' => true,
      'cache_sec' => 120,
    ),
    'xslt' => 'misc/email_confirm.xsl',
    'modules' => 
    array (
      0 => 
      array (
        'emailconfirm' => 
        array (
          'roles' => 
          array (
            '' => '',
          ),
          'action' => 'show',
          'mode' => '',
          'params' => 
          array (
            0 => 
            array (
              'name' => 'user_id',
              'type' => 'get',
              'value' => '1',
            ),
            1 => 
            array (
              'name' => 'hash',
              'type' => 'get',
              'value' => '2',
            ),
          ),
        ),
      ),
    ),
  ),
  'backend' => 
  array (
    'title' => 'Админка',
    'name' => 'backend',
    'params' => 
    array (
      'cache' => false,
      'cache_sec' => 0,
    ),
    'xslt' => 'admin/admin.xsl',
    'modules' => 
    array (
      0 => 
      array (
        'backend' => 
        array (
          'roles' => 
          array (
            '' => '',
          ),
          'action' => 'show',
          'mode' => 'meow',
          'params' => 
          array (
          ),
        ),
      ),
    ),
  ),
  'p404' => 
  array (
    'title' => '404',
    'name' => 'p404',
    'params' => 
    array (
      'cache' => true,
      'cache_sec' => 120,
    ),
    'xslt' => 'errors/p404.xsl',
    'modules' => 
    array (
    ),
  ),
  'b' => 
  array (
    'title' => 'short Книга',
    'name' => 'b',
    'params' => 
    array (
      'cache' => false,
      'cache_sec' => 0,
    ),
    'xslt' => '',
    'modules' => 
    array (
    ),
  ),
  'user' => 
  array (
    'title' => 'Профиль',
    'name' => 'user',
    'params' => 
    array (
      'cache' => false,
      'cache_sec' => 0,
    ),
    'xslt' => 'users/user.xsl',
    'modules' => 
    array (
      0 => 
      array (
        'users' => 
        array (
          'roles' => 
          array (
            '' => '',
          ),
          'action' => 'list',
          'mode' => 'followers',
          'params' => 
          array (
            0 => 
            array (
              'name' => 'user_id',
              'type' => 'get',
              'value' => '1',
            ),
          ),
        ),
      ),
      1 => 
      array (
        'users' => 
        array (
          'roles' => 
          array (
            '' => '',
          ),
          'action' => 'list',
          'mode' => 'friends',
          'params' => 
          array (
            0 => 
            array (
              'name' => 'user_id',
              'type' => 'get',
              'value' => '1',
            ),
          ),
        ),
      ),
      2 => 
      array (
        'users' => 
        array (
          'roles' => 
          array (
            '' => '',
          ),
          'action' => 'show',
          'mode' => '',
          'params' => 
          array (
            0 => 
            array (
              'name' => 'user_id',
              'type' => 'get',
              'value' => '1',
            ),
          ),
        ),
      ),
    ),
  ),
  'p502' => 
  array (
    'title' => '502',
    'name' => 'p502',
    'params' => 
    array (
      'cache' => true,
      'cache_sec' => 120,
    ),
    'xslt' => 'errors/p502.xsl',
    'modules' => 
    array (
      0 => 
      array (
        'p502' => 
        array (
          'roles' => 
          array (
            '' => '',
          ),
          'action' => 'show',
          'mode' => 'some',
          'params' => 
          array (
          ),
        ),
      ),
    ),
  ),
  'book' => 
  array (
    'title' => 'Книга',
    'name' => 'book',
    'params' => 
    array (
      'cache' => false,
      'cache_sec' => 0,
    ),
    'xslt' => 'books/book.xsl',
    'modules' => 
    array (
      0 => 
      array (
        'books' => 
        array (
          'roles' => 
          array (
            '' => '',
          ),
          'action' => 'show',
          'mode' => '',
          'params' => 
          array (
            0 => 
            array (
              'name' => 'book_id',
              'type' => 'get',
              'value' => '1',
            ),
          ),
        ),
      ),
      1 => 
      array (
        'reviews' => 
        array (
          'roles' => 
          array (
            '' => '',
          ),
          'action' => 'list',
          'mode' => '',
          'params' => 
          array (
            0 => 
            array (
              'name' => 'target_type',
              'type' => 'val',
              'value' => '0',
            ),
            1 => 
            array (
              'name' => 'target_id',
              'type' => 'get',
              'value' => '1',
            ),
          ),
        ),
      ),
      2 => 
      array (
        'reviews' => 
        array (
          'roles' => 
          array (
            '' => '',
          ),
          'action' => 'new',
          'mode' => '',
          'params' => 
          array (
            0 => 
            array (
              'name' => 'target_type',
              'type' => 'val',
              'value' => '0',
            ),
            1 => 
            array (
              'name' => 'target_id',
              'type' => 'get',
              'value' => '1',
            ),
          ),
        ),
      ),
    ),
  ),
  'me' => 
  array (
    'title' => 'Мой профиль',
    'name' => 'me',
    'params' => 
    array (
      'cache' => false,
      'cache_sec' => 0,
    ),
    'xslt' => 'me/me.xsl',
    'modules' => 
    array (
      0 => 
      array (
        'users' => 
        array (
          'roles' => 
          array (
            '' => '',
          ),
          'action' => 'list',
          'mode' => 'compare_interests',
          'params' => 
          array (
            0 => 
            array (
              'name' => 'user_id',
              'type' => 'current_user',
              'value' => '',
            ),
          ),
        ),
      ),
      1 => 
      array (
        'users' => 
        array (
          'roles' => 
          array (
            '' => '',
          ),
          'action' => 'list',
          'mode' => 'followers',
          'params' => 
          array (
            0 => 
            array (
              'name' => 'user_id',
              'type' => 'current_user',
              'value' => '',
            ),
          ),
        ),
      ),
      2 => 
      array (
        'users' => 
        array (
          'roles' => 
          array (
            '' => '',
          ),
          'action' => 'list',
          'mode' => 'friends',
          'params' => 
          array (
            0 => 
            array (
              'name' => 'user_id',
              'type' => 'current_user',
              'value' => '',
            ),
          ),
        ),
      ),
      3 => 
      array (
        'users' => 
        array (
          'roles' => 
          array (
            '' => '',
          ),
          'action' => 'show',
          'mode' => '',
          'params' => 
          array (
            0 => 
            array (
              'name' => 'user_id',
              'type' => 'current_user',
              'value' => '',
            ),
          ),
        ),
      ),
      4 => 
      array (
        'books' => 
        array (
          'roles' => 
          array (
            '' => '',
          ),
          'action' => 'list',
          'mode' => 'loved',
          'params' => 
          array (
            0 => 
            array (
              'name' => 'user_id',
              'type' => 'current_user',
              'value' => '',
            ),
          ),
        ),
      ),
      5 => 
      array (
        'authors' => 
        array (
          'roles' => 
          array (
            '' => '',
          ),
          'action' => 'list',
          'mode' => 'loved',
          'params' => 
          array (
            0 => 
            array (
              'name' => 'user_id',
              'type' => 'current_user',
              'value' => '',
            ),
          ),
        ),
      ),
    ),
  ),
  'useredit' => 
  array (
    'title' => 'Редактирование профиля',
    'name' => 'useredit',
    'params' => 
    array (
      'cache' => false,
      'cache_sec' => 0,
    ),
    'xslt' => 'users/edit.xsl',
    'modules' => 
    array (
      0 => 
      array (
        'users' => 
        array (
          'roles' => 
          array (
            '' => '',
          ),
          'action' => 'edit',
          'mode' => '',
          'params' => 
          array (
          ),
        ),
      ),
    ),
  ),
  'user_shelves' => 
  array (
    'title' => 'Список полок юзера',
    'name' => 'user_shelves',
    'params' => 
    array (
      'cache' => false,
      'cache_sec' => 0,
    ),
    'xslt' => 'users/shelves.xsl',
    'modules' => 
    array (
      0 => 
      array (
        'books' => 
        array (
          'roles' => 
          array (
            '' => '',
          ),
          'action' => 'list',
          'mode' => 'shelves',
          'params' => 
          array (
            0 => 
            array (
              'name' => 'user_id',
              'type' => 'get',
              'value' => '1',
            ),
          ),
        ),
      ),
    ),
  ),
  'user_shelf' => 
  array (
    'title' => 'Одна полка юзера',
    'name' => 'user_shelf',
    'params' => 
    array (
      'cache' => false,
      'cache_sec' => 0,
    ),
    'xslt' => 'users/shelf.xsl',
    'modules' => 
    array (
      0 => 
      array (
        'books' => 
        array (
          'roles' => 
          array (
            '' => '',
          ),
          'action' => 'list',
          'mode' => 'shelf',
          'params' => 
          array (
            0 => 
            array (
              'name' => 'user_id',
              'type' => 'get',
              'value' => '1',
            ),
            1 => 
            array (
              'name' => 'shelf_type',
              'type' => 'get',
              'value' => '3',
            ),
          ),
        ),
      ),
    ),
  ),
  'author' => 
  array (
    'title' => 'Автор',
    'name' => 'author',
    'params' => 
    array (
      'cache' => false,
      'cache_sec' => 0,
    ),
    'xslt' => 'authors/author.xsl',
    'modules' => 
    array (
      0 => 
      array (
        'books' => 
        array (
          'roles' => 
          array (
            '' => '',
          ),
          'action' => 'list',
          'mode' => 'author_books',
          'params' => 
          array (
            0 => 
            array (
              'name' => 'author_id',
              'type' => 'get',
              'value' => '1',
            ),
          ),
        ),
      ),
      1 => 
      array (
        'authors' => 
        array (
          'roles' => 
          array (
            '' => '',
          ),
          'action' => 'show',
          'mode' => '',
          'params' => 
          array (
            0 => 
            array (
              'name' => 'author_id',
              'type' => 'get',
              'value' => '1',
            ),
          ),
        ),
      ),
    ),
  ),
  'books_new' => 
  array (
    'title' => 'Новые книги',
    'name' => 'books_new',
    'params' => 
    array (
      'cache' => false,
      'cache_sec' => 0,
    ),
    'xslt' => 'books/news.xsl',
    'modules' => 
    array (
      0 => 
      array (
        'books' => 
        array (
          'roles' => 
          array (
            '' => '',
          ),
          'action' => 'list',
          'mode' => 'new',
          'params' => 
          array (
          ),
        ),
      ),
    ),
  ),
  'book_popular' => 
  array (
    'title' => 'Популярные книги',
    'name' => 'book_popular',
    'params' => 
    array (
      'cache' => false,
      'cache_sec' => 0,
    ),
    'xslt' => 'books/popular.xsl',
    'modules' => 
    array (
      0 => 
      array (
        'books' => 
        array (
          'roles' => 
          array (
            '' => '',
          ),
          'action' => 'list',
          'mode' => 'popular',
          'params' => 
          array (
          ),
        ),
      ),
    ),
  ),
  'user_friends' => 
  array (
    'title' => 'Друзья пользователя',
    'name' => 'user_friends',
    'params' => 
    array (
      'cache' => false,
      'cache_sec' => 0,
    ),
    'xslt' => 'users/friends.xsl',
    'modules' => 
    array (
      0 => 
      array (
        'users' => 
        array (
          'roles' => 
          array (
            '' => '',
          ),
          'action' => 'list',
          'mode' => 'friends',
          'params' => 
          array (
            0 => 
            array (
              'name' => 'user_id',
              'type' => 'get',
              'value' => '1',
            ),
          ),
        ),
      ),
    ),
  ),
  'user_followers' => 
  array (
    'title' => 'Поклонники пользователя',
    'name' => 'user_followers',
    'params' => 
    array (
      'cache' => false,
      'cache_sec' => 0,
    ),
    'xslt' => 'users/friends.xsl',
    'modules' => 
    array (
      0 => 
      array (
        'users' => 
        array (
          'roles' => 
          array (
            '' => '',
          ),
          'action' => 'list',
          'mode' => 'followers',
          'params' => 
          array (
            0 => 
            array (
              'name' => 'user_id',
              'type' => 'get',
              'value' => '1',
            ),
          ),
        ),
      ),
    ),
  ),
  'book_edit' => 
  array (
    'title' => 'Редактирование книги',
    'name' => 'book_edit',
    'params' => 
    array (
      'cache' => false,
      'cache_sec' => 0,
    ),
    'xslt' => 'books/edit.xsl',
    'modules' => 
    array (
      0 => 
      array (
        'books' => 
        array (
          'roles' => 
          array (
            '' => '',
          ),
          'action' => 'edit',
          'mode' => '',
          'params' => 
          array (
            0 => 
            array (
              'name' => 'book_id',
              'type' => 'get',
              'value' => '1',
            ),
          ),
        ),
      ),
    ),
  ),
  'book_edit_short' => 
  array (
    'title' => 'short Редактирование книги',
    'name' => 'book_edit_short',
    'params' => 
    array (
      'cache' => false,
      'cache_sec' => 0,
    ),
    'xslt' => 'books/edit.xsl',
    'modules' => 
    array (
    ),
  ),
  'genre' => 
  array (
    'title' => 'Жанр',
    'name' => 'genre',
    'params' => 
    array (
      'cache' => false,
      'cache_sec' => 0,
    ),
    'xslt' => 'genres/genre.xsl',
    'modules' => 
    array (
      0 => 
      array (
        'genres' => 
        array (
          'roles' => 
          array (
            '' => '',
          ),
          'action' => 'show',
          'mode' => '',
          'params' => 
          array (
            0 => 
            array (
              'name' => 'genre_name',
              'type' => 'get',
              'value' => '1',
            ),
          ),
        ),
      ),
    ),
  ),
  'author_edit' => 
  array (
    'title' => 'Редактирование автора',
    'name' => 'author_edit',
    'params' => 
    array (
      'cache' => false,
      'cache_sec' => 0,
    ),
    'xslt' => 'authors/edit.xsl',
    'modules' => 
    array (
      0 => 
      array (
        'authors' => 
        array (
          'roles' => 
          array (
            '' => '',
          ),
          'action' => 'edit',
          'mode' => '',
          'params' => 
          array (
            0 => 
            array (
              'name' => 'author_id',
              'type' => 'get',
              'value' => '1',
            ),
          ),
        ),
      ),
    ),
  ),
  'book_new' => 
  array (
    'title' => 'Добавление книги',
    'name' => 'book_new',
    'params' => 
    array (
      'cache' => false,
      'cache_sec' => 0,
    ),
    'xslt' => 'books/new.xsl',
    'modules' => 
    array (
      0 => 
      array (
        'books' => 
        array (
          'roles' => 
          array (
            '' => '',
          ),
          'action' => 'new',
          'mode' => '',
          'params' => 
          array (
          ),
        ),
      ),
    ),
  ),
  'author_new' => 
  array (
    'title' => 'Добавление автора',
    'name' => 'author_new',
    'params' => 
    array (
      'cache' => false,
      'cache_sec' => 0,
    ),
    'xslt' => 'authors/new.xsl',
    'modules' => 
    array (
      0 => 
      array (
        'authors' => 
        array (
          'roles' => 
          array (
            '' => '',
          ),
          'action' => 'new',
          'mode' => '',
          'params' => 
          array (
          ),
        ),
      ),
    ),
  ),
  'author_edit_short' => 
  array (
    'title' => 'short Редактирование автора',
    'name' => 'author_edit_short',
    'params' => 
    array (
      'cache' => false,
      'cache_sec' => 0,
    ),
    'xslt' => '',
    'modules' => 
    array (
    ),
  ),
  'author_new_short' => 
  array (
    'title' => 'short Добавление автора',
    'name' => 'author_new_short',
    'params' => 
    array (
      'cache' => false,
      'cache_sec' => 0,
    ),
    'xslt' => '',
    'modules' => 
    array (
    ),
  ),
  'author_bibliography' => 
  array (
    'title' => 'Библиография автора',
    'name' => 'author_bibliography',
    'params' => 
    array (
      'cache' => false,
      'cache_sec' => 0,
    ),
    'xslt' => 'authors/bibliography.xsl',
    'modules' => 
    array (
      0 => 
      array (
        'books' => 
        array (
          'roles' => 
          array (
            '' => '',
          ),
          'action' => 'list',
          'mode' => 'bibliography',
          'params' => 
          array (
            0 => 
            array (
              'name' => 'author_id',
              'type' => 'get',
              'value' => '1',
            ),
          ),
        ),
      ),
    ),
  ),
  'book_new_short' => 
  array (
    'title' => 'short Добавление книги',
    'name' => 'book_new_short',
    'params' => 
    array (
      'cache' => false,
      'cache_sec' => 0,
    ),
    'xslt' => '',
    'modules' => 
    array (
    ),
  ),
  'author_short' => 
  array (
    'title' => 'Автор',
    'name' => 'author_short',
    'params' => 
    array (
      'cache' => false,
      'cache_sec' => 0,
    ),
    'xslt' => '',
    'modules' => 
    array (
    ),
  ),
  'me_wall' => 
  array (
    'title' => 'Моя Стена',
    'name' => 'me_wall',
    'params' => 
    array (
      'cache' => false,
      'cache_sec' => 0,
    ),
    'xslt' => 'me/wall.xsl',
    'modules' => 
    array (
      0 => 
      array (
        'events' => 
        array (
          'roles' => 
          array (
            '' => '',
          ),
          'action' => 'list',
          'mode' => '',
          'params' => 
          array (
            0 => 
            array (
              'name' => 'user_id',
              'type' => 'current_user',
              'value' => '',
            ),
            1 => 
            array (
              'name' => 'type',
              'type' => 'var',
              'value' => 'not_self',
            ),
            2 => 
            array (
              'name' => 'select',
              'type' => 'get',
              'value' => '2',
            ),
          ),
        ),
      ),
    ),
  ),
  'series' => 
  array (
    'title' => 'Серии',
    'name' => 'series',
    'params' => 
    array (
      'cache' => false,
      'cache_sec' => 0,
    ),
    'xslt' => 'series/index.xsl',
    'modules' => 
    array (
      0 => 
      array (
        'series' => 
        array (
          'roles' => 
          array (
            '' => '',
          ),
          'action' => 'list',
          'mode' => '',
          'params' => 
          array (
          ),
        ),
      ),
    ),
  ),
  'series_item' => 
  array (
    'title' => 'Серия',
    'name' => 'series_item',
    'params' => 
    array (
      'cache' => false,
      'cache_sec' => 0,
    ),
    'xslt' => 'series/serie.xsl',
    'modules' => 
    array (
      0 => 
      array (
        'series' => 
        array (
          'roles' => 
          array (
            '' => '',
          ),
          'action' => 'show',
          'mode' => '',
          'params' => 
          array (
            0 => 
            array (
              'name' => 'series_id',
              'type' => 'get',
              'value' => '1',
            ),
          ),
        ),
      ),
    ),
  ),
  'series_item_short' => 
  array (
    'title' => 'Серия',
    'name' => 'series_item_short',
    'params' => 
    array (
      'cache' => false,
      'cache_sec' => 0,
    ),
    'xslt' => '',
    'modules' => 
    array (
    ),
  ),
  'magazines' => 
  array (
    'title' => 'Периодика',
    'name' => 'magazines',
    'params' => 
    array (
      'cache' => false,
      'cache_sec' => 0,
    ),
    'xslt' => 'magazines/index.xsl',
    'modules' => 
    array (
      0 => 
      array (
        'magazines' => 
        array (
          'roles' => 
          array (
            '' => '',
          ),
          'action' => 'list',
          'mode' => '',
          'params' => 
          array (
          ),
        ),
      ),
    ),
  ),
  'magazine' => 
  array (
    'title' => 'Журнал',
    'name' => 'magazine',
    'params' => 
    array (
      'cache' => false,
      'cache_sec' => 0,
    ),
    'xslt' => 'magazines/magazine.xsl',
    'modules' => 
    array (
      0 => 
      array (
        'magazines' => 
        array (
          'roles' => 
          array (
            '' => '',
          ),
          'action' => 'show',
          'mode' => '',
          'params' => 
          array (
            0 => 
            array (
              'name' => 'magazine_id',
              'type' => 'get',
              'value' => '1',
            ),
          ),
        ),
      ),
    ),
  ),
  'magazines_' => 
  array (
    'title' => 'Периодика',
    'name' => 'magazines_',
    'params' => 
    array (
      'cache' => false,
      'cache_sec' => 0,
    ),
    'xslt' => '',
    'modules' => 
    array (
    ),
  ),
  'magazine_' => 
  array (
    'title' => 'Журнал',
    'name' => 'magazine_',
    'params' => 
    array (
      'cache' => false,
      'cache_sec' => 0,
    ),
    'xslt' => '',
    'modules' => 
    array (
    ),
  ),
  'wall' => 
  array (
    'title' => 'Стена пользователя',
    'name' => 'wall',
    'params' => 
    array (
      'cache' => false,
      'cache_sec' => 0,
    ),
    'xslt' => 'users/wall.xsl',
    'modules' => 
    array (
      0 => 
      array (
        'events' => 
        array (
          'roles' => 
          array (
            '' => '',
          ),
          'action' => 'list',
          'mode' => '',
          'params' => 
          array (
            0 => 
            array (
              'name' => 'user_id',
              'type' => 'get',
              'value' => '1',
            ),
            1 => 
            array (
              'name' => 'type',
              'type' => 'val',
              'value' => 'self',
            ),
          ),
        ),
      ),
    ),
  ),
  'forum' => 
  array (
    'title' => 'Форум',
    'name' => 'forum',
    'params' => 
    array (
      'cache' => false,
      'cache_sec' => 0,
    ),
    'xslt' => 'forum/forum.xsl',
    'modules' => 
    array (
      0 => 
      array (
        'forum' => 
        array (
          'roles' => 
          array (
            '' => '',
          ),
          'action' => 'list',
          'mode' => '',
          'params' => 
          array (
            0 => 
            array (
              'name' => 'forum_id',
              'type' => 'get',
              'value' => '1',
            ),
          ),
        ),
      ),
    ),
  ),
  'series_edit' => 
  array (
    'title' => 'Серия',
    'name' => 'series_edit',
    'params' => 
    array (
      'cache' => false,
      'cache_sec' => 0,
    ),
    'xslt' => 'series/edit.xsl',
    'modules' => 
    array (
      0 => 
      array (
        'series' => 
        array (
          'roles' => 
          array (
            '' => '',
          ),
          'action' => 'edit',
          'mode' => '',
          'params' => 
          array (
            0 => 
            array (
              'name' => 'series_id',
              'type' => 'get',
              'value' => '1',
            ),
          ),
        ),
      ),
    ),
  ),
  'series_edit_short' => 
  array (
    'title' => 'short Серия',
    'name' => 'series_edit_short',
    'params' => 
    array (
      'cache' => false,
      'cache_sec' => 0,
    ),
    'xslt' => '',
    'modules' => 
    array (
    ),
  ),
  'genres' => 
  array (
    'title' => 'Жанры',
    'name' => 'genres',
    'params' => 
    array (
      'cache' => false,
      'cache_sec' => 0,
    ),
    'xslt' => 'genres/index.xsl',
    'modules' => 
    array (
      0 => 
      array (
        'genres' => 
        array (
          'roles' => 
          array (
            '' => '',
          ),
          'action' => 'list',
          'mode' => '',
          'params' => 
          array (
          ),
        ),
      ),
    ),
  ),
  'user_reviews' => 
  array (
    'title' => 'Отзывы пользователя',
    'name' => 'user_reviews',
    'params' => 
    array (
      'cache' => false,
      'cache_sec' => 0,
    ),
    'xslt' => 'users/reviews.xsl',
    'modules' => 
    array (
      0 => 
      array (
        'reviews' => 
        array (
          'roles' => 
          array (
            '' => '',
          ),
          'action' => 'list',
          'mode' => 'user',
          'params' => 
          array (
            0 => 
            array (
              'name' => 'target_user',
              'type' => 'get',
              'value' => '1',
            ),
          ),
        ),
      ),
    ),
  ),
  'forum_themes' => 
  array (
    'title' => 'Форум - список тем',
    'name' => 'forum_themes',
    'params' => 
    array (
      'cache' => false,
      'cache_sec' => 0,
    ),
    'xslt' => 'forum/themes.xsl',
    'modules' => 
    array (
      0 => 
      array (
        'forum' => 
        array (
          'roles' => 
          array (
            '' => '',
          ),
          'action' => 'list',
          'mode' => 'themes',
          'params' => 
          array (
            0 => 
            array (
              'name' => 'forum_id',
              'type' => 'get',
              'value' => '1',
            ),
            1 => 
            array (
              'name' => 'theme_id',
              'type' => 'get',
              'value' => '2',
            ),
          ),
        ),
      ),
    ),
  ),
  'forum_theme' => 
  array (
    'title' => 'Форум - страница темы',
    'name' => 'forum_theme',
    'params' => 
    array (
      'cache' => false,
      'cache_sec' => 0,
    ),
    'xslt' => 'forum/theme.xsl',
    'modules' => 
    array (
      0 => 
      array (
        'forum' => 
        array (
          'roles' => 
          array (
            '' => '',
          ),
          'action' => 'show',
          'mode' => 'theme',
          'params' => 
          array (
            0 => 
            array (
              'name' => 'forum_id',
              'type' => 'get',
              'value' => '1',
            ),
            1 => 
            array (
              'name' => 'theme_id',
              'type' => 'get',
              'value' => '2',
            ),
          ),
        ),
      ),
    ),
  ),
  'messages' => 
  array (
    'title' => 'Сообщения',
    'name' => 'messages',
    'params' => 
    array (
      'cache' => false,
      'cache_sec' => 0,
    ),
    'xslt' => 'me/messages.xsl',
    'modules' => 
    array (
      0 => 
      array (
        'messages' => 
        array (
          'roles' => 
          array (
            '' => '',
          ),
          'action' => 'list',
          'mode' => '',
          'params' => 
          array (
          ),
        ),
      ),
      1 => 
      array (
        'messages' => 
        array (
          'roles' => 
          array (
            '' => '',
          ),
          'action' => 'new',
          'mode' => '',
          'params' => 
          array (
          ),
        ),
      ),
    ),
  ),
  'messages_thread' => 
  array (
    'title' => 'Сообщения - thread',
    'name' => 'messages_thread',
    'params' => 
    array (
      'cache' => false,
      'cache_sec' => 0,
    ),
    'xslt' => 'me/messages_thread.xsl',
    'modules' => 
    array (
      0 => 
      array (
        'messages' => 
        array (
          'roles' => 
          array (
            '' => '',
          ),
          'action' => 'list',
          'mode' => 'thread',
          'params' => 
          array (
            0 => 
            array (
              'name' => 'thread_id',
              'type' => 'get',
              'value' => '2',
            ),
          ),
        ),
      ),
      1 => 
      array (
        'messages' => 
        array (
          'roles' => 
          array (
            '' => '',
          ),
          'action' => 'new',
          'mode' => '',
          'params' => 
          array (
            0 => 
            array (
              'name' => 'thread_id',
              'type' => 'get',
              'value' => '2',
            ),
          ),
        ),
      ),
    ),
  ),
  'booklog' => 
  array (
    'title' => 'Лог книги',
    'name' => 'booklog',
    'params' => 
    array (
      'cache' => false,
      'cache_sec' => 0,
    ),
    'xslt' => 'books/log.xsl',
    'modules' => 
    array (
      0 => 
      array (
        'log' => 
        array (
          'roles' => 
          array (
            '' => '',
          ),
          'action' => 'list',
          'mode' => 'book',
          'params' => 
          array (
            0 => 
            array (
              'name' => 'target_type',
              'type' => 'var',
              'value' => '1',
            ),
            1 => 
            array (
              'name' => 'id_target',
              'type' => 'get',
              'value' => '1',
            ),
          ),
        ),
      ),
    ),
  ),
  'authorlog' => 
  array (
    'title' => 'Лог автора',
    'name' => 'authorlog',
    'params' => 
    array (
      'cache' => false,
      'cache_sec' => 0,
    ),
    'xslt' => 'authors/log.xsl',
    'modules' => 
    array (
      0 => 
      array (
        'log' => 
        array (
          'roles' => 
          array (
            '' => '',
          ),
          'action' => 'list',
          'mode' => 'author',
          'params' => 
          array (
            0 => 
            array (
              'name' => 'target_type',
              'type' => 'var',
              'value' => '2',
            ),
            1 => 
            array (
              'name' => 'id_target',
              'type' => 'get',
              'value' => '1',
            ),
          ),
        ),
      ),
    ),
  ),
  'userlog' => 
  array (
    'title' => 'Лог юзера',
    'name' => 'userlog',
    'params' => 
    array (
      'cache' => false,
      'cache_sec' => 0,
    ),
    'xslt' => 'users/log.xsl',
    'modules' => 
    array (
      0 => 
      array (
        'log' => 
        array (
          'roles' => 
          array (
            '' => '',
          ),
          'action' => 'list',
          'mode' => 'user',
          'params' => 
          array (
            0 => 
            array (
              'name' => 'id_target',
              'type' => 'get',
              'value' => '1',
            ),
            1 => 
            array (
              'name' => 'target_type',
              'type' => 'var',
              'value' => 'user',
            ),
          ),
        ),
      ),
    ),
  ),
  'log' => 
  array (
    'title' => 'Лог изменений',
    'name' => 'log',
    'params' => 
    array (
      'cache' => false,
      'cache_sec' => 0,
    ),
    'xslt' => 'log/index.xsl',
    'modules' => 
    array (
      0 => 
      array (
        'log' => 
        array (
          'roles' => 
          array (
            '' => '',
          ),
          'action' => 'list',
          'mode' => '',
          'params' => 
          array (
            0 => 
            array (
              'name' => 'target_type',
              'type' => 'var',
              'value' => 'all',
            ),
          ),
        ),
      ),
    ),
  ),
  'waal_post' => 
  array (
    'title' => 'Запись на стене',
    'name' => 'waal_post',
    'params' => 
    array (
      'cache' => false,
      'cache_sec' => 0,
    ),
    'xslt' => 'users/wallitem.xsl',
    'modules' => 
    array (
      0 => 
      array (
        'events' => 
        array (
          'roles' => 
          array (
            '' => '',
          ),
          'action' => 'list',
          'mode' => 'item',
          'params' => 
          array (
            0 => 
            array (
              'name' => 'post_id',
              'type' => 'get',
              'value' => '3',
            ),
            1 => 
            array (
              'name' => 'user_id',
              'type' => 'get',
              'value' => '1',
            ),
          ),
        ),
      ),
    ),
  ),
  'tracker' => 
  array (
    'title' => 'Актиность',
    'name' => 'tracker',
    'params' => 
    array (
      'cache' => false,
      'cache_sec' => 0,
    ),
    'xslt' => 'tracker/index.xsl',
    'modules' => 
    array (
      0 => 
      array (
        'events' => 
        array (
          'roles' => 
          array (
            '' => '',
          ),
          'action' => 'list',
          'mode' => 'last',
          'params' => 
          array (
          ),
        ),
      ),
    ),
  ),
  'magazine_edit' => 
  array (
    'title' => 'Редактирование журнала',
    'name' => 'magazine_edit',
    'params' => 
    array (
      'cache' => false,
      'cache_sec' => 0,
    ),
    'xslt' => 'magazines/edit.xsl',
    'modules' => 
    array (
      0 => 
      array (
        'magazines' => 
        array (
          'roles' => 
          array (
            '' => '',
          ),
          'action' => 'edit',
          'mode' => '',
          'params' => 
          array (
            0 => 
            array (
              'name' => 'magazine_id',
              'type' => 'get',
              'value' => '1',
            ),
          ),
        ),
      ),
    ),
  ),
);
}