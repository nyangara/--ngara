<?php
        require_once 'include/DataFacade.php';

        class Entity {
                protected $data;

                public static function enum_values($type_name) { return DataFacade::enum_values($type_name); }

                public function get($field) {
                        if (array_key_exists($field, $this->data)) {
                                return $this->data[$field];
                        }
                        return null;
                }

                public function is_set($field) {
                        return array_key_exists($field, $this->data);
                }

                public function undef($field) {
                        unset($this->data[$field]);
                        return $this;
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

                public function insert() { return DataFacade::insert($this); }
                public function select() { return DataFacade::select($this); }
                public function update() { return DataFacade::update($this); }
                public function remove() { return DataFacade::remove($this); }

                public static function retrieveAll() { return DataFacade::retrieveAll(get_called_class()); }
                public static function removeAll  () { return DataFacade::removeAll  (get_called_class()); }
        }
?>
