<?php
        class Entity {
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

                public function table() {
                        return static::$table;
                }
        }
?>
