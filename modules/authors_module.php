<?php

// модуль отвечает за отображение баннеров
class authors_module extends BaseModule {

    function generateData() {
        global $current_user;
        $params = $this->params;
        $this->user_id = isset($params['user_id']) ? $params['user_id'] : $current_user->id;
        $this->author_id = isset($params['author_id']) ? $params['author_id'] : $current_user->id;

        switch ($this->action) {
            case 'show':
                switch ($this->mode) {
                    default:
                        $this->getAuthor();
                        break;
                }
                break;
            case 'edit':
                switch ($this->mode) {
                    default:
                        $this->getAuthor();
                        $this->getEditingInfo();
                        break;
                }
                break;
            case 'new':
                switch ($this->mode) {
                    default:
                        $this->getEditingInfo();
                        break;
                }
                break;
            case 'list':
                switch ($this->mode) {
                    case 'loved':
                        $this->getLoved();
                        break;
                    default:
                        throw new Exception('no mode #' . $this->mode . ' for ' . $this->moduleName);
                        break;
                }
                break;
            default:
                throw new Exception('no action #' . $this->action . ' for ' . $this->moduleName);
                break;
        }
    }

    function getEditingInfo() {
        foreach (Config::$langRus as $code => $title) {
            $this->data['author']['lang_codes'][] = array(
                'id' => Config::$langs[$code],
                'code' => $code,
                'title' => $title,
            );
        }
    }

    function getAuthor() {
        $id = $this->author_id;
        if (!$id)
            return;
        $person = Persons::getById($id);
        /* @var $person Person */
        $authordata['picture'] = $person->getPicture();

        $langId = $person->data['author_lang'] ? $person->data['author_lang'] : 136;
        foreach (Config::$langs as $code => $id_lang) {
            if ($id_lang == $langId) {
                $langCode = $code;
            }
        }

        $authordata['lang_code'] = $langCode;
        $authordata['id'] = $id;
        $authordata['lang_title'] = Config::$langRus[$langCode];
        $authordata['lang_id'] = $langId;

        $authordata['first_name'] = $person->data['first_name'];
        $authordata['last_name'] = $person->data['last_name'];
        $authordata['middle_name'] = $person->data['middle_name'];
        $authordata['avg_mark'] = $person->getAvgMark();

        $date_b = timestamp_to_ymd($person->data['date_birth']);
        $date_b = (int) $date_b[0] ? (digit2($date_b[2]) . '.' . digit2($date_b[1]) . '.' . $date_b[0]) : '';

        $date_d = timestamp_to_ymd($person->data['date_death']);
        $date_d = (int) $date_d[0] ? (digit2($date_d[2]) . '.' . digit2($date_d[1]) . '.' . $date_d[0]) : '';

        $authordata['date_birth'] = $date_b;
        $authordata['date_death'] = $date_d;
        $authordata['wiki_url'] = $person->data['wiki_url'];
        $authordata['homepage'] = $person->data['homepage'];

        $authordata['bio']['html'] = $person->data['bio'];
        $authordata['bio']['short'] = $person->data['short_bio'];
        $authordata['lastSave'] = $person->data['authorlastSave'];




        $this->data['author'] = $authordata;
    }

    function _list($ids) {
        $persons = Persons::getByIdsLoaded($ids);
        $out = array();
        /* @var $book Book */
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

    function getLoved() {
        $ids = Database::sql2array('SELECT `id` FROM `persons` LIMIT 8', 'id');
        $this->data['authors'] = $this->_list(array_keys($ids));
        $this->data['authors']['title'] = 'Любимые авторы';
        $this->data['authors']['count'] = count($ids);
        $this->data['authors']['link_title'] = 'Все любимые книги';
        $this->data['authors']['link_url'] = '/';
    }

}