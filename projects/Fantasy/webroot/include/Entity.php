<?php
        require_once 'include/Facade.php';

        class Entity {
                protected $data;

                public function get($field) {
                        if (array_key_exists($field, $this->data)) {
                                return $this->data[$field];
                        }
                        return null;
                }

                public function set($field, $datum) {
                        if (in_array($field, $this->fields())) {
                                $this->data[$field] = $datum;
                        }
                        return $this;
                }

                public function set_all($data) {
                        foreach ($data as $field => $datum) {
                                $this->set($field, $datum);
                        }
                }

                public static function table () { return static::$table ; }
                public static function fields() { return static::$fields; }
                public static function pk    () { return static::$pk    ; }

                public function insert() { return Facade::insert($this); }
                public function select() { return Facade::select($this); }
                public function update() { return Facade::update($this); }
                public function remove() { return Facade::remove($this); }

                public static function retrieveAll() { return Facade::retrieveAll(get_called_class()); }
                public static function removeAll  () { return Facade::removeAll  (get_called_class()); }
        }
?>
