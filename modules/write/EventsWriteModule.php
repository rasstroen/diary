<?php

// пишем комментарии
class EventsWriteModule extends BaseWriteModule {

    function write() {
        switch (Request::$post['action']) {
            case 'comment_new':
                $this->addComment();
                break;
        }
    }

    function addComment() {
        global $current_user;
        if (!$current_user->id)
            return;
        $comment = isset(Request::$post['comment']) ? Request::$post['comment'] : false;
        $comment = trim(prepare_review($comment, ''));
        if (!$comment)
            throw new Exception('comment body expected');

        $post_id = Request::$post['id'];
        if ($post_id) {
            MongoDatabase::addEventComment($post_id, $current_user->id, $comment);
        }
    }

}