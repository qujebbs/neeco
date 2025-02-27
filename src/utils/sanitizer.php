<?php
    class Sanitizer {
        public static function sanitize(array $data, array $rules) {
            $sanitizedData = [];
            
            foreach ($data as $key => $value) {
                if (!isset($rules[$key])) {
                    continue; // Skip fields that don't have defined rules
                }
                $sanitizedData[$key] = self::applyRules($value, explode('|', $rules[$key]));
            }
            
            return $sanitizedData;
        }
    
        private static function applyRules($value, $rules) {
            foreach ($rules as $rule) {
                switch ($rule) {
                    case 'trim':
                        $value = trim($value);
                        break;
                    case 'strip_tags':
                        $value = strip_tags($value);
                        break;
                    case 'htmlspecialchars':
                        $value = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
                        break;
                    case 'lowercase':
                        $value = strtolower($value);
                        break;
                    case 'uppercase':
                        $value = strtoupper($value);
                        break;
                    case 'int':
                        $value = filter_var($value, FILTER_SANITIZE_NUMBER_INT);
                        break;
                    case 'float':
                        $value = filter_var($value, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                        break;
                    case 'email':
                        $value = filter_var($value, FILTER_SANITIZE_EMAIL);
                        break;
                    case 'url':
                        $value = filter_var($value, FILTER_SANITIZE_URL);
                        break;
                }
            }
            return $value;
        }
    }

    ?>