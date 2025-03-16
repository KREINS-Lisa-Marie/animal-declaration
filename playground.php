<?php
//echo 'test';

/*$tel = '+32 (0)4 666 66 66';

var_dump( is_numeric(str_replace(['+', '(', ')', ' '],'', $tel )));*/

//echo $tel;

$salutations = 'Bonjour %s';

//printf($salutations, 'Dominique');

$message = sprintf($salutations, 'Dominique');
echo $message;




// Manières d'appeler une fonction
/*say_hello();
say_goodbye();*/



/*$to_call = 'say_hello';
call_user_func($to_call);*/



/*$to_call = 'say_hello';
call_user_func($to_call);*/



/*$messages = ['say_hello', 'say_goodbye'];
foreach ($messages as $to_call){
    $to_call();
}*/


/*$messages = ['hello', 'goodbye'];
foreach ($messages as $to_call){
    ('say_'.$to_call)();
}*/


/*$to_call();*/



// methodes d'un objet du core
/*function say_hello()
{
echo 'hello'.PHP_EOL;
}

function say_goodbye()
{
    echo 'goodbye'.PHP_EOL;
}*/


$messages = ['morning'=>'hello', 'evening'=>'goodbye'];
foreach ($messages as $moment => $to_call){
    ('say_'.$to_call)();
}
function say_hello($moment)
{
    echo 'hello its the'.$moment.PHP_EOL;
}

function say_goodbye($moment)
{
    echo 'goodbye its the'.$moment.PHP_EOL;
}

echo bin2hex(random_bytes(32)); // pq on a le double