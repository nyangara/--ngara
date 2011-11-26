<?php
        class Entity {
                public static function table() {
                        return static::$table;
                }

                public static function fields() {
                        return static::$fields;
                }

                public function get($field) {
                        if (array_key_exists($field, $this->data)) {
                                return $this->data[$field];
                        }
                        return null;
                }

                public function set($field, $datum) {
                        if (in_array($field, static::$fields)) {
                                $this->data[$field] = $datum;
                        }
                        return $this;
                }
        }
?>
