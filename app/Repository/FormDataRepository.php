<?php
/**
 * Created by PhpStorm.
 * User: piyush sharma
 * Date: 08-10-2015
 * Time: 23:28
 */

namespace App\Repository;


class FormDataRepository {

    /**
     * Returns country List
     * @return array
     */
    public static function countryList()
    {
        return ["europe"=>"Europe",
        "africa"=>"Africa",
        "other"=>"Other"];
    }


    public static function jsonCountryList()
    {
        $countryList = self::countryList();
        $jsonCountryList = array();
        foreach($countryList as $country=>$countryName)
        {
            array_push($jsonCountryList,["key"=>$country,"country"=>$countryName]);
        }
        return $jsonCountryList;
    }

}