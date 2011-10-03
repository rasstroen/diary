<?php

// модуль отвечает за отображение баннеров
class log_module extends BaseModule {

    function generateData() {
        global $current_user;
        $params = $this->params;
        $this->target_type = isset($params['target_type']) ? $params['target_type'] : false;
        $this->id_target = isset($params['id_target']) ? $params['id_target'] : 0;

        switch ($this->action) {
            case 'list':
                switch ($this->mode) {
                    default:
                        $this->getLog();
                        break;
                }
                break;
            case 'show':

                break;
            default:
                throw new Exception('no action #' . $this->action . ' for ' . $this->moduleName);
                break;
        }
    }

    function getLog() {
        if ($this->target_type == 'user') {
            $query = 'SELECT * FROM `biber_log` WHERE
            `id_user`=' . $this->id_target . '
            ORDER BY `time` DESC LIMIT 100';
        } else
        if ($this->target_type == 'all') {
            $query = 'SELECT * FROM `biber_log`
            ORDER BY `time` DESC LIMIT 100';
        } else {
            $query = 'SELECT * FROM `biber_log` WHERE
            `target_type`=' . $this->target_type . ' AND
            `id_target`=' . $this->id_target . '
            ORDER BY `time` DESC LIMIT 100';
        }
        $book_ids = array();
        $person_ids = array();
        $uids = array();

        if ($this->target_type == BiberLog::TargetType_book)
            $book_ids[$this->id_target] = $this->id_target;

        if ($this->target_type == BiberLog::TargetType_person)
            $person_ids[$this->id_target] = $this->id_target;

        if ($this->target_type == 'user')
            $uids[$this->id_target] = $this->id_target;


        $arr = Database::sql2array($query);


        foreach ($arr as $row) {
            $uids[$row['id_user']] = $row['id_user'];
            $vals = unserialize($row['data']);
            $values = array();
            foreach ($vals as $field => $v) {
                $values[] = array('name' => $field, 'old' => $v[0], 'new' => $v[1]);
            }
            $book_id = 0;

            $person_id = 0;

            if (in_array($row['target_type'], array(BiberLog::TargetType_book))) {
                $book_ids[$row['id_target']] = $row['id_target'];
                $book_id = $row['id_target'];
            }
            if (in_array($row['target_type'], array(BiberLog::TargetType_person))) {
                $person_ids[$row['id_target']] = $row['id_target'];
                $person_id = $row['id_target'];
            }
            $this->data['logs'][] = array(
                'id' => $row['id'],
                'book_id' => $book_id,
                'author_id' => $person_id,
                'time' => date('Y/m/d H:i:s', $row['time']),
                'type' => BiberLog::$actionTypes[$row['action_type']],
                'id_user' => $row['id_user'],
                'values' => $values,
            );
        }
        $users = Users::getByIdsLoaded($uids);
        foreach ($users as $user) {
            $this->data['users'][$user->id] = array(
                'id' => $user->id,
                'picture' => $user->getAvatar(),
                'nickname' => $user->getNickName(),
            );
        }
        if (count($book_ids))
            $this->data['books'] = $this->getLogBooks($book_ids);
        if (count($person_ids))
            $this->data['authors'] = $this->getLogPersons($person_ids);

        foreach (Config::$langRus as $code => $title) {
            $this->data['lang_codes'][] = array(
                'id' => Config::$langs[$code],
                'code' => $code,
                'title' => $title,
            );
        }
    }

    function getLogPersons($ids) {
        $persons = Persons::getByIdsLoaded($ids);
        $out = array();

        if (is_array($persons))
            foreach ($persons as $person) {
                $out[] = array(
                    'id' => $person->id,
                    'name' => $person->getName(),
                    'picture' => $person->getPicture(),
                    'lastSave' => $person->data['authorlastSave']
                );
            }
        return $out;
    }

    function getLogBooks($ids, $opts = array(), $limit = false) {
        $person_id = isset($opts['person_id']) ? $opts['person_id'] : false;
        $books = Books::getByIdsLoaded($ids);
        Books::LoadBookPersons($ids);
        $out = array();
        /* @var $book Book */
        $i = 0;
        if (is_array($books))
            foreach ($books as $book) {
                if ($limit && ++$i > $limit)
                    return $out;
                list($aid, $aname) = $book->getAuthor(1, 1, 1, $person_id); // именно наш автор, если их там много
                $out[] = array(
                    'id' => $book->id,
                    'cover' => $book->getCover(),
                    'title' => $book->getTitle(true),
                    'author' => $aname,
                    'author_id' => $aid,
                    'lastSave' => $book->data['modify_time'],
                );
            }
        return $out;
    }

}