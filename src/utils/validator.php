<?php

   class Validator {
        private $errors = [];
        private $sanitizedData = [];

        public function validate(array $data, array $rules) {
            foreach ($rules as $field => $fieldRules) {
                $value = $data[$field] ?? null;
                foreach (explode('|', $fieldRules) as $rule) {
                    $this->applyRule($field, $value, $rule);
                }
                $this->sanitizedData[$field] = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
            }
            return empty($this->errors);
        }

        private function applyRule($field, $value, $rule) {
            if ($rule === 'required' && empty($value)) {
                $this->errors[$field][] = "The $field field is required.";
            }
            if (str_starts_with($rule, 'min:')) {
                $min = explode(':', $rule)[1];
                if (strlen($value) < $min) {
                    $this->errors[$field][] = "The $field must be at least $min characters.";
                }
            }
            if (str_starts_with($rule, 'max:')) {
                $max = explode(':', $rule)[1];
                if (strlen($value) > $max) {
                    $this->errors[$field][] = "The $field must be at most $max characters.";
                }
            }
            if ($rule === 'number' && !is_numeric($value)) {
                $this->errors[$field][] = "The $field must be a number.";
            }
            if ($rule === 'date' && !strtotime($value)) {
                $this->errors[$field][] = "The $field must be a valid date.";
            }
        }

        public function getErrors() {
            return $this->errors;
        }

        public function getSanitizedData() {
            return $this->sanitizedData;
        }
    }
?>