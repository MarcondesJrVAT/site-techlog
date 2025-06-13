<?php
/**
 * GUMP
 *
 * @author      Sean Nieuwoudt (http://twitter.com/SeanNieuwoudt)
 * @copyright   Copyright (c) 2014 Wixelhq.com
 * @link        http://github.com/Wixel/GUMP
 * @version     1.0
 * @date updated Sept 19, 2015
 *---------------------------------------------------------------------------------------
 * Modified from SMVC 2.2 - https://github.com/Wixel/GUMP
 * @author Fábio Assunção da Silva - fabioassuncao.com
 * @version 0.0.1
 * @date February 06, 2016
 *---------------------------------------------------------------------------------------
 */

namespace Babita\Helpers;

/**
 * A fast, extensible PHP input validation class
 */
class Gump
{
    /**
     * Validation rules for execution
     *
     * @var array $validationRules
     */
    protected $validationRules = [];

    /**
     * Filter rules for execution
     *
     * @var array $filterRules
     */
    protected $filterRules = [];

    /**
     * Instance attribute containing errors from last run
     *
     * @var array $errors
     */
    protected $errors = [];

    /**
     * Contain readable field names that have been set manually
     *
     * @var array $fields
     */
    protected static $fields = [];

    /**
     * Custom validation methods
     *
     * @var array $validationMethods
     */
    protected static $validationMethods = [];

    /**
     * Customer filter methods
     *
     * @var array $filterMethods
     */
    protected static $filterMethods = [];

    // ** ------------------------- Validation Data ------------------------------- ** //

    /**
     * Basic tags
     * @var string $basicTags
     */
    public static $basicTags = "<br><p><a><strong><b><i><em><img><blockquote><code><dd><dl><hr><h1><h2><h3><h4><h5><h6><label><ul><li><span><sub><sup>";

    /**
     * Noise Words
     * @var string $enNoiseWords
     */
    public static $enNoiseWords = "about,after,all,also,an,and,another,any,are,as,at,be,because,been,before,
                                     being,between,both,but,by,came,can,come,could,did,do,each,for,from,get,
                                     got,has,had,he,have,her,here,him,himself,his,how,if,in,into,is,it,its,it's,like,
                                     make,many,me,might,more,most,much,must,my,never,now,of,on,only,or,other,
                                     our,out,over,said,same,see,should,since,some,still,such,take,than,that,
                                     the,their,them,then,there,these,they,this,those,through,to,too,under,up,
                                     very,was,way,we,well,were,what,where,which,while,who,with,would,you,your,a,
                                     b,c,d,e,f,g,h,i,j,k,l,m,n,o,p,q,r,s,t,u,v,w,x,y,z,$,1,2,3,4,5,6,7,8,9,0,_";

    // *=============== Validation Helpers ===============* //

    /**
     * Shorthand method for inline validation
     *
     * @param array $data The data to be validated
     * @param array $validators The GUMP validators
     * @return mixed true(boolean) or the array of error messages
     */
    public static function isValid(array $data, array $validators)
    {
        $this->validationRules($validators);

        if ($this->run($data) === false) {
            return $this->getReadableErrors(false);
        } else {
            return true;
        }
    }

    /**
     * Shorthand method for running only the data filters
     *
     * @param array $data
     * @param array $filters
     */
    public static function filterInput(array $data, array $filters)
    {
        return $this->filter($data, $filters);
    }

    /**
     * Magic method to generate the validation error messages
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getReadableErrors(true);
    }

    /**
     * Perform XSS clean to prevent cross site scripting
     *
     * @static
     * @access public
     * @param  array $data
     * @return array
     */
    public static function xssClean(array $data)
    {
        foreach ($data as $k => $v) {
            $data[$k] = filter_var($v, FILTER_SANITIZE_STRING);
        }

        return $data;
    }

    /**
     * Adds a custom validation rule using a callback function
     *
     * @access public
     * @param string $rule
     * @param callable $callback
     * @return bool
     */
    public static function addValidator($rule, $callback)
    {
        $method = 'validate' . $rule;

        if (method_exists(__CLASS__, $method) || isset(self::$validationMethods[$rule])) {
            throw new \Exception("Validator rule '$rule' already exists.");
        }

        self::$validationMethods[$rule] = $callback;

        return true;
    }

    /**
     * Adds a custom filter using a callback function
     *
     * @access public
     * @param string $rule
     * @param callable $callback
     * @return bool
     */
    public static function addFilter($rule, $callback)
    {
        $method = 'filter' . $rule;

        if (method_exists(__CLASS__, $method) || isset(self::$filterMethods[$rule])) {
            throw new \Exception("Filter rule '$rule' already exists.");
        }

        self::$filterMethods[$rule] = $callback;

        return true;
    }

    /**
     * Getter/Setter for the validation rules
     *
     * @param array $rules
     * @return array
     */
    public function validationRules(array $rules = [])
    {
        if (empty($rules)) {
            return $this->validationRules;
        }

        $this->validationRules = $rules;
    }

    /**
     * Getter/Setter for the filter rules
     *
     * @param array $rules
     * @return array
     */
    public function filterRules(array $rules = [])
    {
        if (empty($rules)) {
            return $this->filterRules;
        }

        $this->filterRules = $rules;
    }

    /**
     * Run the filtering and validation after each other
     *
     * @param array $data
     * @param array $check_fields
     * @return array
     * @return boolean
     */
    public function run(array $data, $check_fields = false)
    {
        $data = $this->filter($data, $this->filterRules());

        $validated = $this->validate(
            $data, $this->validationRules()
        );

        if ($check_fields === true) {
            $this->checkFields($data);
        }

        if ($validated !== true) {
            return false;
        }

        return $data;
    }

    /**
     * Ensure that the field counts match the validation rule counts
     *
     * @param array $data
     */
    private function checkFields(array $data)
    {
        $ruleset  = $this->validationRules();
        $mismatch = array_diff_key($data, $ruleset);
        $fields   = array_keys($mismatch);

        foreach ($fields as $field) {
            $this->errors[] = [
                'field' => $field,
                'value' => $data[$field],
                'rule'  => 'mismatch',
                'param' => null
            ];
        }
    }

    /**
     * Sanitize the input data
     *
     * @access public
     * @param  array $data
     * @param  array $fields
     * @param  array $utf8_encode
     * @return array
     */
    public function sanitize(array $input, $fields = null, $utf8_encode = true)
    {
        $magic_quotes = (bool)get_magic_quotes_gpc();

        if (is_null($fields)) {
            $fields = array_keys($input);
        }

        $return = [];

        foreach ($fields as $field) {

            if (!isset($input[$field])) {
                continue;
            }

            else{

                $value = $input[$field];

                if (is_string($value)) {

                    if ($magic_quotes === true) {
                        $value = stripslashes($value);
                    }

                    if (strpos($value, "\r") !== false) {
                        $value = trim($value);
                    }

                    if (function_exists('iconv') && function_exists('mb_detect_encoding') && $utf8_encode) {
                        $current_encoding = mb_detect_encoding($value);

                        if ($current_encoding != 'UTF-8' && $current_encoding != 'UTF-16') {
                            $value = iconv($current_encoding, 'UTF-8', $value);
                        }
                    }

                    $value = filter_var($value, FILTER_SANITIZE_STRING);
                }

                $return[$field] = $value;
            }
        }

        return $return;
    }

    /**
     * Return the error array from the last validation run
     *
     * @return array
     */
    public function errors()
    {
        return $this->errors;
    }

    /**
     * Perform data validation against the provided ruleset
     *
     * @access public
     * @param  mixed $input
     * @param  array $ruleset
     * @return mixed
     */
    public function validate(array $input, array $ruleset)
    {
        $this->errors = [];

        foreach ($ruleset as $field => $rules) {

            $rules = explode('|', $rules);

            if (in_array("required", $rules) || (isset($input[$field]) && trim($input[$field]) != '')) {
                foreach ($rules as $rule)
                {
                    $method = null;
                    $param  = null;

                    if (strstr($rule, ',') !== false) {

                        $rule   = explode(',', $rule);
                        $method = 'validate'.$rule[0];
                        $param  = $rule[1];
                        $rule   = $rule[0];

                    }
                    else{
                        $method = 'validate'.$rule;
                    }

                    if (is_callable([$this, $method])) {
                        $result = $this->$method($field, $input, $param);

                        if (is_array($result)) {
                            $this->errors[] = $result;
                        }
                    }
                    elseif (isset(self::$validationMethods[$rule])) {

                        if (isset($input[$field])) {
                            $result = call_user_func(self::$validationMethods[$rule], $field, $input, $param);

                            if (!$result) {

                                $this->errors[] = [
                                    'field' => $field,
                                    'value' => $input[$field],
                                    'rule'  => $method,
                                    'param' => $param
                                ];

                            }
                        }
                    }
                    else{
                        throw new \Exception("Validator method '$method' does not exist.");
                    }
                }
            }
        }

        return (count($this->errors) > 0) ? $this->errors : true;
    }

    /**
     * Set a readable name for a specified field names
     *
     * @param string $fieldClass
     * @param string $readableName
     * @return void
     */
    public static function setFieldName($field, $readableName)
    {
        self::$fields[$field] = $readableName;
    }

    /**
     * Process the validation errors and return human readable error messages
     *
     * @param bool $convertToString = false
     * @param string $fieldClass
     * @param string $errorClass
     * @return array
     * @return string
     */
    public function getReadableErrors($convertToString = false, $fieldClass="field", $errorClass="error-message")
    {
        if (empty($this->errors)) {
            return ($convertToString)? null : [];
        }

        $resp = [];

        foreach ($this->errors as $e) {

            $field = ucwords(str_replace(['_','-'], ' ', $e['field']));
            $param = $e['param'];

            // Let's fetch explicit field names if they exist
            if (array_key_exists($e['field'], self::$fields)) {
                $field = self::$fields[$e['field']];
            }

            switch ($e['rule']) {

                case 'mismatch' :
                    $resp[] = "There is no validation rule for <span class=\"$fieldClass\">$field</span>";
                    break;

                case 'validateRequired':
                    $resp[] = "The <span class=\"$fieldClass\">$field</span> field is required";
                    break;

                case 'validateValidEmail':
                    $resp[] = "The <span class=\"$fieldClass\">$field</span> field is required to be a valid email address";
                    break;

                case 'validateMaxLen':

                    if ($param == 1) {
                        $resp[] = "The <span class=\"$fieldClass\">$field</span> field needs to be shorter than $param character";
                    } else {
                        $resp[] = "The <span class=\"$fieldClass\">$field</span> field needs to be shorter than $param characters";
                    }

                    break;

                case 'validateMinLen':

                    if ($param == 1) {
                        $resp[] = "The <span class=\"$fieldClass\">$field</span> field needs to be longer than $param character";
                    } else {
                        $resp[] = "The <span class=\"$fieldClass\">$field</span> field needs to be longer than $param characters";
                    }

                    break;

                case 'validateExactLen':

                    if ($param == 1) {
                        $resp[] = "The <span class=\"$fieldClass\">$field</span> field needs to be exactly $param character in length";
                    } else {
                        $resp[] = "The <span class=\"$fieldClass\">$field</span> field needs to be exactly $param characters in length";
                    }

                    break;

                case 'validateAlpha':
                    $resp[] = "The <span class=\"$fieldClass\">$field</span> field may only contain alpha characters(a-z)";
                    break;

                case 'validateAlphaNumeric':
                    $resp[] = "The <span class=\"$fieldClass\">$field</span> field may only contain alpha-numeric characters";
                    break;

                case 'validateAlphaDash':
                    $resp[] = "The <span class=\"$fieldClass\">$field</span> field may only contain alpha characters &amp; dashes";
                    break;

                case 'validateNumeric':
                    $resp[] = "The <span class=\"$fieldClass\">$field</span> field may only contain numeric characters";
                    break;

                case 'validateInteger':
                    $resp[] = "The <span class=\"$fieldClass\">$field</span> field may only contain a numeric value";
                    break;

                case 'validateBoolean':
                    $resp[] = "The <span class=\"$fieldClass\">$field</span> field may only contain a true or false value";
                    break;

                case 'validateFloat':
                    $resp[] = "The <span class=\"$fieldClass\">$field</span> field may only contain a float value";
                    break;

                case 'validateValidUrl':
                    $resp[] = "The <span class=\"$fieldClass\">$field</span> field is required to be a valid URL";
                    break;

                case 'validateUrlExists':
                    $resp[] = "The <span class=\"$fieldClass\">$field</span> URL does not exist";
                    break;

                case 'validateValidIp':
                    $resp[] = "The <span class=\"$fieldClass\">$field</span> field needs to contain a valid IP address";
                    break;

                case 'validateValidCc':
                    $resp[] = "The <span class=\"$fieldClass\">$field</span> field needs to contain a valid credit card number";
                    break;

                case 'validateValidName':
                    $resp[] = "The <span class=\"$fieldClass\">$field</span> field needs to contain a valid human name";
                    break;

                case 'validateContains':
                    $resp[] = "The <span class=\"$fieldClass\">$field</span> field needs to contain one of these values: ".implode(', ', $param);
                    break;

                case 'validateStreetAddress':
                    $resp[] = "The <span class=\"$fieldClass\">$field</span> field needs to be a valid street address";
                    break;

                case 'validateDate':
                    $resp[] = "The <span class=\"$fieldClass\">$field</span> field needs to be a valid date";
                    break;

                case 'validateMinNumeric':
                    $resp[] = "The <span class=\"$fieldClass\">$field</span> field needs to be a numeric value, equal to, or higher than $param";
                    break;

                case 'validateMaxNumeric':
                    $resp[] = "The <span class=\"$fieldClass\">$field</span> field needs to be a numeric value, equal to, or lower than $param";
                    break;

                default:
                    $resp[] = "The <span class=\"$fieldClass\">$field</span> field is invalid";
            }
        }

        if (!$convertToString) {

            return $resp;

        } else {

            $buffer = '';

            foreach ($resp as $s) {
                $buffer .= "<span class=\"$errorClass\">$s</span>";
            }

            return $buffer;
        }
    }

    /**
     * Filter the input data according to the specified filter set
     *
     * @access public
     * @param  mixed $input
     * @param  array $filterset
     * @return mixed
     */
    public function filter(array $input, array $filterset)
    {
        foreach ($filterset as $field => $filters) {

            if (!array_key_exists($field, $input)) {
                continue;
            }

            $filters = explode('|', $filters);

            foreach ($filters as $filter) {
                $params = null;

                if (strstr($filter, ',') !== false) {
                    $filter = explode(',', $filter);

                    $params = array_slice($filter, 1, count($filter) - 1);
                    $filter = $filter[0];
                }

                if (is_callable([$this, 'filter'.$filter])) {
                    $method = 'filter'.$filter;
                    $input[$field] = $this->$method($input[$field], $params);
                }

                elseif (function_exists($filter)) {
                    $input[$field] = $filter($input[$field]);
                }

                elseif (isset(self::$filterMethods[$filter])) {
                    $input[$field] = call_user_func(self::$filterMethods[$filter], $input[$field], $params);
                }

                else{
                    throw new \Exception("Filter method '$filter' does not exist.");
                }
            }
        }

        return $input;
    }

    // ** ------------------------- Filters --------------------------------------- ** //

    /**
     * Replace noise words in a string (http://tax.cchgroup.com/help/Avoiding_noise_words_in_your_search.htm)
     *
     * Usage: '<index>' => 'noise_words'
     *
     * @access protected
     * @param  string $value
     * @param  array $params
     * @return string
     */
    protected function filterNoiseWords($value, $params = null)
    {
        $value = preg_replace('/\s\s+/u', ' ',$value);

        $value = " $value ";

        $words = explode(',', self::$enNoiseWords);

        foreach ($words as $word) {
            $word = trim($word);

            $word = " $word "; // Normalize

            if (stripos($value, $word) !== false) {
                $value = str_ireplace($word, ' ', $value);
            }
        }

        return trim($value);
    }

    /**
     * Remove all known punctuation from a string
     *
     * Usage: '<index>' => 'rmpunctuataion'
     *
     * @access protected
     * @param  string $value
     * @param  array $params
     * @return string
     */
    protected function filterRmPunctuation($value, $params = null)
    {
        return preg_replace("/(?![.=$'€%-])\p{P}/u", '', $value);
    }

    /**
     * Sanitize the string by removing any script tags
     *
     * Usage: '<index>' => 'sanitize_string'
     *
     * @access protected
     * @param  string $value
     * @param  array $params
     * @return string
     */
    protected function filterSanitizeString($value, $params = null)
    {
        return filter_var($value, FILTER_SANITIZE_STRING);
    }

    /**
     * Sanitize the string by urlencoding characters
     *
     * Usage: '<index>' => 'urlencode'
     *
     * @access protected
     * @param  string $value
     * @param  array $params
     * @return string
     */
    protected function filterUrlEncode($value, $params = null)
    {
        return filter_var($value, FILTER_SANITIZE_ENCODED);
    }

    /**
     * Sanitize the string by converting HTML characters to their HTML entities
     *
     * Usage: '<index>' => 'htmlencode'
     *
     * @access protected
     * @param  string $value
     * @param  array $params
     * @return string
     */
    protected function filterHtmlEncode($value, $params = null)
    {
        return filter_var($value, FILTER_SANITIZE_SPECIAL_CHARS);
    }

    /**
     * Sanitize the string by removing illegal characters from emails
     *
     * Usage: '<index>' => 'sanitize_email'
     *
     * @access protected
     * @param  string $value
     * @param  array $params
     * @return string
     */
    protected function filterSanitizeEmail($value, $params = null)
    {
        return filter_var($value, FILTER_SANITIZE_EMAIL);
    }

    /**
     * Sanitize the string by removing illegal characters from numbers
     *
     * @access protected
     * @param  string $value
     * @param  array $params
     * @return string
     */
    protected function filterSanitizeNumbers($value, $params = null)
    {
        return filter_var($value, FILTER_SANITIZE_NUMBER_INT);
    }

    /**
     * Filter out all HTML tags except the defined basic tags
     *
     * @access protected
     * @param  string $value
     * @param  array $params
     * @return string
     */
    protected function filterBasicTags($value, $params = null)
    {
        return strip_tags($value, self::$basicTags);
    }

    /**
     * Convert the provided numeric value to a whole number
     *
     * @access protected
     * @param  string $value
     * @param  array $params
     * @return string
     */
    protected function filterWholeNumber($value, $params = null)
    {
        return intval($value);
    }

    // ** ------------------------- Validators ------------------------------------ ** //

    /**
     * Verify that a value is contained within the pre-defined value set
     *
     * Usage: '<index>' => 'contains,value value value'
     *
     * @access protected
     * @param  string $field
     * @param  array $input
     * @param  array $param
     * @return mixed
     */
    protected function validateContains($field, $input, $param = null)
    {
        if (!isset($input[$field])) {
            return;
        }

        $param = trim(strtolower($param));

        $value = trim(strtolower($input[$field]));

        if (preg_match_all('#\'(.+?)\'#', $param, $matches, PREG_PATTERN_ORDER)) {
            $param = $matches[1];
        } else {
            $param = explode(' ', $param);
        }

        if (in_array($value, $param)) { // valid, return nothin g
            return;
        }

        return [
            'field' => $field,
            'value' => $value,
            'rule'  => __FUNCTION__,
            'param' => $param
        ];
    }

    /**
     * Check if the specified key is present and not empty
     *
     * Usage: '<index>' => 'required'
     *
     * @access protected
     * @param  string $field
     * @param  array $input
     * @param  string $param
     * @return mixed
     */
    protected function validateRequired($field, $input, $param = null)
    {
        if (isset($input[$field]) && ($input[$field] === false || $input[$field] === 0 || $input[$field] === 0.0 || $input[$field] === "0" || !empty($input[$field]))) {
                return;
        }

        return [
            'field' => $field,
            'value' => null,
            'rule'  => __FUNCTION__,
            'param' => $param
        ];
    }

    /**
     * Determine if the provided email is valid
     *
     * Usage: '<index>' => 'valid_email'
     *
     * @access protected
     * @param  string $field
     * @param  array $input
     * @param  string $param
     * @return mixed
     */
    protected function validateValidEmail($field, $input, $param = null)
    {
        if (!isset($input[$field]) || empty($input[$field])) {
            return;
        }

        if (!filter_var($input[$field], FILTER_VALIDATE_EMAIL)) {
            return [
                'field' => $field,
                'value' => $input[$field],
                'rule'  => __FUNCTION__,
                'param' => $param
            ];
        }
    }

    /**
     * Determine if the provided value length is less or equal to a specific value
     *
     * Usage: '<index>' => 'max_len,240'
     *
     * @access protected
     * @param  string $field
     * @param  array $input
     * @param  string $param
     * @return mixed
     */
    protected function validateMaxLen($field, $input, $param = null)
    {
        if (!isset($input[$field])) {
            return;
        }

        if (function_exists('mb_strlen')) {
            if (mb_strlen($input[$field]) <= (int)$param) {
                return;
            }
        }
        else{
            if (strlen($input[$field]) <= (int)$param) {
                return;
            }
        }

        return [
            'field' => $field,
            'value' => $input[$field],
            'rule'  => __FUNCTION__,
            'param' => $param
        ];
    }

    /**
     * Determine if the provided value length is more or equal to a specific value
     *
     * Usage: '<index>' => 'min_len,4'
     *
     * @access protected
     * @param  string $field
     * @param  array $input
     * @param  string $param
     * @return mixed
     */
    protected function validateMinLen($field, $input, $param = null)
    {
        if (!isset($input[$field])) {
            return;
        }

        if (function_exists('mb_strlen')) {
            if (mb_strlen($input[$field]) >= (int)$param) {
                return;
            }
        }
        else{
            if (strlen($input[$field]) >= (int)$param) {
                return;
            }
        }

        return [
            'field' => $field,
            'value' => $input[$field],
            'rule'  => __FUNCTION__,
            'param' => $param
        ];
    }

    /**
     * Determine if the provided value length matches a specific value
     *
     * Usage: '<index>' => 'exact_len,5'
     *
     * @access protected
     * @param  string $field
     * @param  array $input
     * @param  string $param
     * @return mixed
     */
    protected function validateExactLen($field, $input, $param = null)
    {
        if (!isset($input[$field])) {
            return;
        }

        if (function_exists('mb_strlen')) {
            if (mb_strlen($input[$field]) == (int)$param) {
                return;
            }
        }
        else{
            if (strlen($input[$field]) == (int)$param) {
                return;
            }
        }

        return [
            'field' => $field,
            'value' => $input[$field],
            'rule'  => __FUNCTION__,
            'param' => $param
        ];
    }

    /**
     * Determine if the provided value contains only alpha characters
     *
     * Usage: '<index>' => 'alpha'
     *
     * @access protected
     * @param  string $field
     * @param  array $input
     * @param  string $param
     * @return mixed
     */
    protected function validateAlpha($field, $input, $param = null)
    {
        if (!isset($input[$field]) || empty($input[$field])) {
            return;
        }

        if (!preg_match("/^([a-zÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ])+$/i", $input[$field]) !== false) {
            return [
                'field' => $field,
                'value' => $input[$field],
                'rule'  => __FUNCTION__,
                'param' => $param
            ];
        }
    }

    /**
     * Determine if the provided value contains only alpha-numeric characters
     *
     * Usage: '<index>' => 'alpha_numeric'
     *
     * @access protected
     * @param  string $field
     * @param  array $input
     * @param  string $param
     * @return mixed
     */
    protected function validateAlphaNumeric($field, $input, $param = null)
    {
        if (!isset($input[$field]) || empty($input[$field])) {
            return;
        }

        if (!preg_match("/^([a-z0-9ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ])+$/i", $input[$field]) !== false) {
            return [
                'field' => $field,
                'value' => $input[$field],
                'rule'  => __FUNCTION__,
                'param' => $param
            ];
        }
    }

    /**
     * Determine if the provided value contains only alpha characters with dashed and underscores
     *
     * Usage: '<index>' => 'alpha_dash'
     *
     * @access protected
     * @param  string $field
     * @param  array $input
     * @param  string $param
     * @return mixed
     */
    protected function validateAlphaDash($field, $input, $param = null)
    {
        if (!isset($input[$field]) || empty($input[$field])) {
            return;
        }

        if (!preg_match("/^([a-z0-9ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ_-])+$/i", $input[$field]) !== false) {
            return [
                'field' => $field,
                'value' => $input[$field],
                'rule'  => __FUNCTION__,
                'param' => $param
            ];
        }
    }

    /**
     * Determine if the provided value is a valid number or numeric string
     *
     * Usage: '<index>' => 'numeric'
     *
     * @access protected
     * @param  string $field
     * @param  array $input
     * @param  string $param
     * @return mixed
     */
    protected function validateNumeric($field, $input, $param = null)
    {
        if (!isset($input[$field]) || empty($input[$field])) {
            return;
        }

        if (!is_numeric($input[$field])) {
            return [
                'field' => $field,
                'value' => $input[$field],
                'rule'  => __FUNCTION__,
                'param' => $param
            ];
        }
    }

    /**
     * Determine if the provided value is a valid integer
     *
     * Usage: '<index>' => 'integer'
     *
     * @access protected
     * @param  string $field
     * @param  array $input
     * @param  string $param
     * @return mixed
     */
    protected function validateInteger($field, $input, $param = null)
    {
        if (!isset($input[$field]) || empty($input[$field])) {
            return;
        }

        if (!filter_var($input[$field], FILTER_VALIDATE_INT)) {
            return [
                'field' => $field,
                'value' => $input[$field],
                'rule'  => __FUNCTION__,
                'param' => $param
            ];
        }
    }

    /**
     * Determine if the provided value is a PHP accepted boolean
     *
     * Usage: '<index>' => 'boolean'
     *
     * @access protected
     * @param  string $field
     * @param  array $input
     * @param  string $param
     * @return mixed
     */
    protected function validateBoolean($field, $input, $param = null)
    {
        if (!isset($input[$field]) || empty($input[$field])) {
            return;
        }

        $bool = filter_var($input[$field], FILTER_VALIDATE_BOOLEAN);

        if (!is_bool($bool)) {
            return [
                'field' => $field,
                'value' => $input[$field],
                'rule'  => __FUNCTION__,
                'param' => $param
            ];
        }
    }

    /**
     * Determine if the provided value is a valid float
     *
     * Usage: '<index>' => 'float'
     *
     * @access protected
     * @param  string $field
     * @param  array $input
     * @param  string $param
     * @return mixed
     */
    protected function validateFloat($field, $input, $param = null)
    {
        if (!isset($input[$field]) || empty($input[$field])) {
            return;
        }

        if (!filter_var($input[$field], FILTER_VALIDATE_FLOAT)) {
            return [
                'field' => $field,
                'value' => $input[$field],
                'rule'  => __FUNCTION__,
                'param' => $param
            ];
        }
    }

    /**
     * Determine if the provided value is a valid URL
     *
     * Usage: '<index>' => 'valid_url'
     *
     * @access protected
     * @param  string $field
     * @param  array $input
     * @param  string $param
     * @return mixed
     */
    protected function validateValidUrl($field, $input, $param = null)
    {
        if (!isset($input[$field]) || empty($input[$field])) {
            return;
        }

        if (!filter_var($input[$field], FILTER_VALIDATE_URL)) {
            return [
                'field' => $field,
                'value' => $input[$field],
                'rule'  => __FUNCTION__,
                'param' => $param
            ];
        }
    }

    /**
     * Determine if a URL exists & is accessible
     *
     * Usage: '<index>' => 'url_exists'
     *
     * @access protected
     * @param  string $field
     * @param  array $input
     * @param  string $param
     * @return mixed
     */
    protected function validateUrlExists($field, $input, $param = null)
    {
        if (!isset($input[$field]) || empty($input[$field])) {
            return;
        }

        $url = parse_url(strtolower($input[$field]));

        if (isset($url['host'])) {
            $url = $url['host'];
        }

        if (function_exists('checkdnsrr') )
        {
            if (checkdnsrr($url) === false) {
                return [
                    'field' => $field,
                    'value' => $input[$field],
                    'rule'  => __FUNCTION__,
                    'param' => $param
                ];
            }
        }
        else{
            if (gethostbyname($url) == $url) {
                return [
                    'field' => $field,
                    'value' => $input[$field],
                    'rule'  => __FUNCTION__,
                    'param' => $param
                ];
            }
        }
    }

    /**
     * Determine if the provided value is a valid IP address
     *
     * Usage: '<index>' => 'valid_ip'
     *
     * @access protected
     * @param  string $field
     * @param  array $input
     * @param  string $param
     * @return mixed
     */
    protected function validateValidIp($field, $input, $param = null)
    {
        if (!isset($input[$field]) || empty($input[$field])) {
            return;
        }

        if (!filter_var($input[$field], FILTER_VALIDATE_IP) !== false) {
            return [
                'field' => $field,
                'value' => $input[$field],
                'rule'  => __FUNCTION__,
                'param' => $param
            ];
        }
    }

    /**
     * Determine if the provided value is a valid IPv4 address
     *
     * What about private networks? http://en.wikipedia.org/wiki/Private_network
     * What about loop-back address? 127.0.0.1
     *
     * Usage: '<index>' => 'valid_ipv4'
     *
     * @access protected
     * @param  string $field
     * @param  array $input
     * @param  string $param
     * @return mixed
     * @see http://pastebin.com/UvUPPYK0
     */
    protected function validateValidIpv4($field, $input, $param = null)
    {
        if (!isset($input[$field]) || empty($input[$field])) {
            return;
        }

        if (!filter_var($input[$field], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
            return [
                'field' => $field,
                'value' => $input[$field],
                'rule'  => __FUNCTION__,
                'param' => $param
            ];
        }
    }

    /**
     * Determine if the provided value is a valid IPv6 address
     *
     * Usage: '<index>' => 'valid_ipv6'
     *
     * @access protected
     * @param  string $field
     * @param  array $input
     * @param  string $param
     * @return mixed
     */
    protected function validateValidIpv6($field, $input, $param = null)
    {
        if (!isset($input[$field]) || empty($input[$field])) {
            return;
        }

        if (!filter_var($input[$field], FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
            return [
                'field' => $field,
                'value' => $input[$field],
                'rule'  => __FUNCTION__,
                'param' => $param
            ];
        }
    }

    /**
     * Determine if the input is a valid credit card number
     *
     * See: http://stackoverflow.com/questions/174730/what-is-the-best-way-to-validate-a-credit-card-in-php
     * Usage: '<index>' => 'valid_cc'
     *
     * @access protected
     * @param  string $field
     * @param  array $input
     * @param  string $param
     * @return mixed
     */
    protected function validateValidCc($field, $input, $param = null)
    {
        if (!isset($input[$field]) || empty($input[$field])) {
            return;
        }

        $number = preg_replace('/\D/', '', $input[$field]);

        if (function_exists('mb_strlen')) {
            $number_length = mb_strlen($number);
        }
        else{
            $number_length = strlen($number);
        }

        $parity = $number_length % 2;

        $total = 0;

        for($i = 0; $i < $number_length; $i++) {
            $digit = $number[$i];

            if ($i % 2 == $parity) {
                $digit *= 2;

                if ($digit > 9) {
                    $digit -= 9;
                }
            }

            $total += $digit;
        }

        if ($total % 10 == 0) {
            return; // Valid
        }

        return [
            'field' => $field,
            'value' => $input[$field],
            'rule'  => __FUNCTION__,
            'param' => $param
        ];
    }

    /**
     * Determine if the input is a valid human name [Credits to http://github.com/ben-s]
     *
     * See: https://github.com/Wixel/GUMP/issues/5
     * Usage: '<index>' => 'valid_name'
     *
     * @access protected
     * @param  string $field
     * @param  array $input
     * @param  string $param
     * @return mixed
     */
    protected function validateValidName($field, $input, $param = null)
    {
        if (!isset($input[$field])|| empty($input[$field])) {
            return;
        }

        if (!preg_match("/^([a-zÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïñðòóôõöùúûüýÿ '-])+$/i", $input[$field]) !== false) {
            return [
                'field' => $field,
                'value' => $input[$field],
                'rule'  => __FUNCTION__,
                'param' => $param
            ];
        }
    }

    /**
     * Determine if the provided input is likely to be a street address using weak detection
     *
     * Usage: '<index>' => 'street_address'
     *
     * @access protected
     * @param  string $field
     * @param  array $input
     * @param  string $param
     * @return mixed
     */
    protected function validateStreetAddress($field, $input, $param = null)
    {
        if (!isset($input[$field])|| empty($input[$field])) {
            return;
        }

        // Theory: 1 number, 1 or more spaces, 1 or more words
        $hasLetter = preg_match('/[a-zA-Z]/', $input[$field]);
        $hasDigit  = preg_match('/\d/'      , $input[$field]);
        $hasSpace  = preg_match('/\s/'      , $input[$field]);

        $passes = $hasLetter && $hasDigit && $hasSpace;

        if (!$passes) {
            return [
                'field' => $field,
                'value' => $input[$field],
                'rule'  => __FUNCTION__,
                'param' => $param
            ];
        }
    }

    /**
     * Determine if the provided value is a valid IBAN
     *
     * Usage: '<index>' => 'iban'
     *
     * @access protected
     * @param  string $field
     * @param  array $input
     * @param  string $param
     * @return mixed
     */
    protected function validateIban($field, $input, $param = null)
    {
        if (!isset($input[$field]) || empty($input[$field])) {
            return;
        }

        static $character = [
            'A' => 10, 'C' => 12, 'D' => 13, 'E' => 14, 'F' => 15, 'G' => 16,
            'H' => 17, 'I' => 18, 'J' => 19, 'K' => 20, 'L' => 21, 'M' => 22,
            'N' => 23, 'O' => 24, 'P' => 25, 'Q' => 26, 'R' => 27, 'S' => 28,
            'T' => 29, 'U' => 30, 'V' => 31, 'W' => 32, 'X' => 33, 'Y' => 34,
            'Z' => 35,
        ];

        if (!preg_match("/\A[A-Z]{2}\d{2} ?[A-Z\d]{4}( ?\d{4}) {1,} ?\d{1,4}\z/", $input[$field])) {
            return [
                'field' => $field,
                'value' => $input[$field],
                'rule'  => __FUNCTION__,
                'param' => $param
            ];
        }

        $iban = str_replace(' ', '', $input[$field]);
        $iban = substr($iban, 4) . substr($iban, 0, 4);
        $iban = strtr($iban, $character);

        if (bcmod($iban, 97) != 1) {
            return [
                'field' => $field,
                'value' => $input[$field],
                'rule'  => __FUNCTION__,
                'param' => $param
            ];
        }
    }

    /**
     * Determine if the provided input is a valid date (ISO 8601)
     *
     * Usage: '<index>' => 'date'
     *
     * @access protected
     * @param string $field
     * @param string $input date ('Y-m-d') or datetime ('Y-m-d H:i:s')
     * @param null   $param
     *
     * @return mixed
     */
    protected function validateDate($field, $input, $param = null)
    {
        if (!isset($input[$field]) || empty($input[$field])) {
            return;
        }

        $cdate1 = date('Y-m-d', strtotime($input[$field]));
        $cdate2 = date('Y-m-d H:i:s', strtotime($input[$field]));


        if ($cdate1 != $input[$field] && $cdate2 != $input[$field]) {
            return [
                'field' => $field,
                'value' => $input[$field],
                'rule'  => __FUNCTION__,
                'param' => $param
            ];
        }
    }

    /**
     * Determine if the provided numeric value is lower or equal to a specific value
     *
     * Usage: '<index>' => 'max_numeric,50'
     *
     * @access protected
     * @param string $field
     * @param array  $input
     * @param null   $param
     *
     * @return mixed
     */
    protected function validateMaxNumeric($field, $input, $param = null)
    {
        if (!isset($input[$field]) || empty($input[$field])) {
            return;
        }

        if (is_numeric($input[$field]) && is_numeric($param) && ($input[$field] <= $param)) {
            return;
        }

        return [
            'field' => $field,
            'value' => $input[$field],
            'rule'  => __FUNCTION__,
            'param' => $param
        ];
    }

    /**
     * Determine if the provided numeric value is higher or equal to a specific value
     *
     * Usage: '<index>' => 'min_numeric,1'
     *
     * @access protected
     * @param string $field
     * @param array  $input
     * @param null   $param
     *
     * @return mixed
     */
    protected function validateMinNumeric($field, $input, $param = null)
    {
        if (!isset($input[$field]) || empty($input[$field])) {
            return;
        }

        if (is_numeric($input[$field]) && is_numeric($param) && ($input[$field] >= $param)) {
            return;
        }

        return [
            'field' => $field,
            'value' => $input[$field],
            'rule'  => __FUNCTION__,
            'param' => $param
        ];
    }

    /**
     * Trims whitespace only when the value is a scalar
     *
     * @param mixed $value
     * @return mixed
     */
    private function trimScalar($value)
    {
        if (is_scalar($value)) {
            $value = trim($value);
        }

        return $value;
    }

} // EOC
