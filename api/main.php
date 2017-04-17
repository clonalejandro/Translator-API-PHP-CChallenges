<?php
/**
 * Created by IntelliJ IDEA.
 * User: alejandrorioscalera
 * Date: 17/4/17
 * Time: 1:00
 */


namespace clonalejandro;

/**
 * Class main
 *
 * @package clonalejandro
 *
 */

require ("def.php");


class main {


    /** SMALL CONSTRUCTORS
     *
     * @param $base
     * @param $lang
     * @param $text
     * @return string $translation
     *
     */

    public static function translate($base, $lang, $text){

        $request = self::requestTranslator($base, $lang, $text);
        $translation = self::getResultJSON($request);

        return $translation;
    }


    /** REST
     *
     * @param $base
     * @param $lang
     * @param $text
     * @return mixed
     * @throws \Exception
     *
     */

    public static function requestTranslator($base, $lang, $text){

        $link = "https://translate.google.com/translate_a/single?client=at&dt=t&dt=ld&dt=qca&dt=rm&dt=bd&dj=1&hl=es-ES&ie=UTF-8&oe=UTF-8&inputm=2&otf=2&iid=1dd3b944-fa62-4b55-b330-74909a99969e";//Codified

        $field = array(
            'sl' => urlencode($base),
            'tl' => urlencode($lang),
            'q' => urlencode($text)
        );


        if(strlen($field['q']) >= 500)
            throw new \Exception("Max characters exceeded, max value: 5000");


        $fieldstr = '';

        foreach ($field as $key => $res)
            $fieldstr .= $key . '=' . $res . '&';


        rtrim($fieldstr, '&');


        $init = curl_init();

        curl_setopt($init, CURLOPT_URL, $link);
        curl_setopt($init, CURLOPT_POST, count($field));
        curl_setopt($init, CURLOPT_POSTFIELDS, $fieldstr);
        curl_setopt($init, CURLOPT_RETURNTRANSFER, tboolean);
        curl_setopt($init, CURLOPT_ENCODING, charset);
        curl_setopt($init, CURLOPT_SSL_VERIFYPEER, fboolean);
        curl_setopt($init, CURLOPT_SSL_VERIFYHOST, fboolean);
        curl_setopt($init, CURLOPT_USERAGENT, ua);

        $result = curl_exec($init);

        curl_close($init);

        return $result;
    }


    /** OTHERS *
     * @param $json
     * @return string
     */

    protected static function getResultJSON($json){

        $resultarray = json_decode($json, tboolean);
        $results = "";

        foreach ($resultarray["results"] as $r){
            $results .= isset($r['trans']) ? $r["trans"] : '';
        }

        return $results;
    }
}