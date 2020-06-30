<?php

function d($var){
	$type = gettype($var);
	echo "\r\n";
	echo '('.$type.') ';
	if(in_array($type, array('boolean', 'integer', 'double', 'NULL', 'unknown type'))){
		var_dump($var);
	}else{
		echo "\r\n<pre>";
		print_r($var);
		echo "</pre>\r\n";
	}
}

function dd($var){
	d($var);
	die();
}




function util_error_log( $file_name, $msg ){
	file_put_contents($file_name, date('Y-m-d H:i:s')."\t".$msg."\n", FILE_APPEND | LOCK_EX);
}


/**
 * Заменяем в дате название русского месяца на английский
 *
 * @param $string
 *
 * @return mixed
 */
function monthsFromRusToEng($string){
	$string = mb_strtolower($string);
	$months = [
		'января' => 'January',
		'январь' => 'January',
		'февраля' => 'February',
		'февраль' => 'February',
		'марта' => 'March',
		'март' => 'March',
		'апреля' => 'April',
		'апрель' => 'April',
		'мая' => 'May',
		'май' => 'May',
		'июня' => 'June',
		'июнь' => 'June',
		'июля' => 'July',
		'июль' => 'July',
		'августа' => 'August',
		'август' => 'August',
		'сентября' => 'September',
		'сентябрь' => 'September',
		'октября' => 'October',
		'октябрь' => 'October',
		'ноября' => 'November',
		'ноябрь' => 'November',
		'декабря' => 'December',
		'декабрь' => 'December',
	];
	return str_replace(array_keys($months), $months, $string);
}


/**
 * Возвращаем массив с русскими символами
 * @param string $type
 * @return array array
 */
function getSymbolsRus($type){
    $vowel = ['а', 'у', 'о', 'ы', 'и', 'э', 'я', 'ю', 'ё', 'е'];
    $consonant = ['б', 'в', 'г', 'д', 'ж', 'з', 'й', 'к', 'л', 'м', 'н', 'п', 'р', 'с', 'т', 'ф', 'х', 'ц', 'ч', 'ш', 'щ'];
    $auxiliary = ['ь', 'ъ'];

    $result = [];

    switch($type){
        case 'vowel':
            $result = $vowel;
            break;

        case 'consonant':
            $result = $consonant;
            break;

        case 'auxiliary':
            $result = $auxiliary;
            break;

        case 'all':
            $result = array_merge($vowel, $consonant, $auxiliary);
            break;
    }
    return $result;
}


/**
 * Рекурсивное удаление директории
 * @param $dir
 * @return bool
 */
function delFolder($dir){
	$files = array_diff(scandir($dir), array('.','..'));
	foreach ($files as $file) {
		(is_dir("$dir/$file")) ? delFolder("$dir/$file") : unlink("$dir/$file");
	}
	return rmdir($dir);
}


/**
 * Рекурсивно считаем размер папки
 * @param $path
 * @return int
 */
function getDirectorySize($path){
    $bytesTotal = 0;
    $path = realpath($path);
    if($path!==false && $path!=='' && file_exists($path)){
        foreach(new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path, FilesystemIterator::SKIP_DOTS)) as $object){
            $bytesTotal += $object->getSize();
        }
    }
    return $bytesTotal;
}


/**
 * Если входящая ссылка является относительной, то преобразовываем ее в абсолютную.
 * @param $urlCurrent
 * @param $urlBase
 * @return string
 */
function getAbsoluteUrlFromUrl($urlCurrent, $urlBase){
    $urlBaseParse = parse_url($urlBase);
    if($urlCurrent[0] === '/'){
        if($urlCurrent[1] === '/'){
            $urlNew = $urlBaseParse['scheme'].':'.$urlCurrent;
        }else{
            $urlNew = $urlBaseParse['scheme'].'://'.$urlBaseParse['host'].$urlCurrent;
        }
    }else{
        $urlCurrentParse = parse_url($urlCurrent);

        if($urlCurrent===''){
            $urlNew = $urlBase;
        }else{
            if(empty($urlCurrentParse['scheme'])){
                if(empty($urlBaseParse['path'])){
                    $urlNew = rtrim($urlBase, '/').'/'.$urlCurrent;
                }else{
                    $urlNew = preg_replace('#/[^/]*$#', '', $urlBase).'/'.$urlCurrent;
                }
            }else{
                $urlNew = $urlCurrent;
            }
        }
    }
    return $urlNew;
}



function getSqlCompareForRandomField(){
    $randValue = rand(Yii::$app->params['pseudoRandom']['min'], Yii::$app->params['pseudoRandom']['max']);
    if($randValue < Yii::$app->params['pseudoRandom']['middle']){
        $compareOperator = '>';
    }else{
        $compareOperator = '<';
    }
    return $compareOperator.' '.$randValue;
}


/**
 * Определяем версию IE
 * @return int. Если версия не определена (return 0), то другой браузер
 */
function getIeVer(){
    preg_match('/MSIE (.*?);/', $_SERVER['HTTP_USER_AGENT'], $matches);
    if(count($matches)<2){
        preg_match('/Trident\/\d{1,2}.\d{1,2}; rv:([0-9]*)/', $_SERVER['HTTP_USER_AGENT'], $matches);
    }
    if (count($matches)>1){
        if(is_numeric($matches[1])){
            return (int)$matches[1];
        }
    }
    return 0;
}








