<?php

$famille = array (  'famille1'  =>'Lannister' ,
                    'famille2'  =>'Strak' ,
                    'famille3'  =>'Tragaryen' );


var_dump($famille);
extract($famille);
echo'<br><br><br>';


echo $famille1.'<br>';
echo $famille2.'<br>';
echo $famille3.'<br>';


?>