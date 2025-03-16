<?php

namespace Tecgdcs\Screencast;
use Tecgdcs\Screencast\Exception\ValidationRuleNotFoundException;



class Validator
{
    public static function required(string $field_name): bool
    {
        global $messages;
        if (!array_key_exists($field_name, $_REQUEST)) {
            $_SESSION['errors'][$field_name] = sprintf($messages['required'], $field_name);
            return false;
        }

        if (trim($_REQUEST[$field_name]) === '') {
            $_SESSION['errors'][$field_name] = sprintf($messages['required'], $field_name);
            return false;
        }
        return true;
    }


    public static function email(string $field_name): bool
    {
        global $messages;
        if (array_key_exists($field_name, $_REQUEST) &&
            !filter_var(trim($_REQUEST[$field_name]), FILTER_VALIDATE_EMAIL) &&
            trim($_REQUEST[$field_name]) !== '') {
            $_SESSION['errors'][$field_name] = sprintf($messages['email'], $field_name);
            return false;
        }
        return true;
    }


    public static function phone(string $field_name): bool
    {
        if (array_key_exists($field_name, $_REQUEST) &&
            trim($_REQUEST[$field_name]) !== '' &&
            (strlen($_REQUEST[$field_name]) < 9 ||
                !is_numeric(str_replace(['+', '(', ')', ' '], '', $_REQUEST[$field_name])))
        ) {
            global $messages;
            $_SESSION['errors'][$field_name] = sprintf($messages['phone'], $field_name);
            return false;
        }

        return true;
    }


    public static function same(string $verification_field_name, string $original_field_name): bool
    {
        if ((array_key_exists($verification_field_name, $_REQUEST) &&
            array_key_exists($original_field_name, $_REQUEST))) {
            global $messages;
            if (trim($_REQUEST[$verification_field_name]) !== trim($_REQUEST[$original_field_name])) {
                $_SESSION['errors'][$verification_field_name] =
                    sprintf($messages['same'], $verification_field_name, $original_field_name);
                return false;
            }
            return true;
        }
        return false;
    }


    public static function in_collection(string $item_field_name, string $collection_field_name): bool
    {
        $collection = require __DIR__.'/../config/'.$collection_field_name.'.php';
        if (array_key_exists($item_field_name, $_REQUEST) &&
            trim($_REQUEST[$item_field_name]) !== '' &&
            !array_key_exists($_REQUEST[$item_field_name], $collection)
        ) {
            global $messages;
            $_SESSION['errors'][$item_field_name] =
                sprintf($messages['in_collection'], $item_field_name, $collection_field_name);
            return false;
        }
        return true;
    }

    public static function check(array $constraints): void
    {
        try {
            self::parse_constraints($constraints);
        }catch (ValidationRuleNotFoundException $exception){      // pour typer $exception
            die($exception->getMessage());
        }
        // Analyser les contraintes définies dans l'array
        // A partir de cette analyse appeler les méthodes de validation correspondantes

        if (!is_null($_SESSION['errors'])) {
            $_SESSION['old'] = $_REQUEST;
            header('Location: /index.php');
            exit;
        }
    }

    /*    private static function parse_constraints(array $rules):bool
        {
      /*      var_dump($rules);die();/
        //Analyser les $rules
            /*var_dump($constraints);die();/
            var_dump('hello');
            if ($rules){
                foreach ($rules as $rule => $categories){

                        $cat = explode("|", $categories);
                        /*var_dump($category); die();/ // jusque ici = ok
                    foreach ($cat as $category){
                        if (method_exists(Validator::class, $category)){
                            self::$category($rule);
                            /*self::$category($rule.':'.$categories);*/
    /*var_dump($cat);die();*/
    //}
    /* self::$category($rule);*/
    /*var_dump($category);die();/
}
}
return true;
}
return false;

}*/

    private static function parse_constraints(array $constraints): false
    {
        $method = $param1 = $param2 = '';
        foreach ($constraints as $field_name => $rules) {
            /*    var_dump($rules);die();*/
            $array_rules = explode("|", $rules);

            foreach ($array_rules as $method) {
                info($method);
                if (str_contains($method, ':')) {
                    [$method, $param1] = explode(':',
                        $method,
                    );
            }
                if (!method_exists(__CLASS__, $method)) {
                   throw new ValidationRuleNotFoundException('La règle '.$method.' n’existe pas');
                    //die(); // ≠ bonne démarche
                }
                self::$method($field_name, $param1);
            }
        }
        return false;

    }
}