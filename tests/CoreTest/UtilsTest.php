<?php

class UtilsTest  extends PHPUnit_Framework_TestCase{
    

    
    public function testArraySplit(){

        //////////////
        // test Array

        $en=array(array("name"=>"3","lang"=>"en"),array("name"=>"7","lang"=>"en"),array("name"=>"11","lang"=>"en"));
        $de=array(array("name"=>"5","lang"=>"de"),array("name"=>"6","lang"=>"de"),array("name"=>"9","lang"=>"de"),);
        $fr=array(array("name"=>"1","lang"=>"fr"),array("name"=>"2","lang"=>"fr"),array("name"=>"4","lang"=>"fr"),array("name"=>"10","lang"=>"fr"));

        $a=array(

            array("name"=>"1","lang"=>"fr"),
            array("name"=>"2","lang"=>"fr"),
            array("name"=>"3","lang"=>"en"),
            array("name"=>"4","lang"=>"fr"),
            array("name"=>"5","lang"=>"de"),
            array("name"=>"6","lang"=>"de"),
            array("name"=>"7","lang"=>"en"),
            array("name"=>"9","lang"=>"de"),
            array("name"=>"10","lang"=>"fr"),
            array("name"=>"11","lang"=>"en"),

        );

        $b=\Peek\Utils\ArrayUtils::splitByArg($a,"lang");

        $this->assertEquals($en,$b["en"]);
        $this->assertEquals($de,$b["de"]);
        $this->assertEquals($fr,$b["fr"]);

        $b=\Peek\Utils\ArrayUtils::splitByArg($a,function($item){
            return $item["lang"];
        });

        $this->assertEquals($en,$b["en"]);
        $this->assertEquals($de,$b["de"]);
        $this->assertEquals($fr,$b["fr"]);




        //////////////
        // TEST OBJECT

        $en=array(array("name"=>"3","lang"=>"en"),array("name"=>"7","lang"=>"en"),array("name"=>"11","lang"=>"en"));
        $de=array(array("name"=>"5","lang"=>"de"),array("name"=>"6","lang"=>"de"),array("name"=>"9","lang"=>"de"),);
        $fr=array(array("name"=>"1","lang"=>"fr"),array("name"=>"2","lang"=>"fr"),array("name"=>"4","lang"=>"fr"),array("name"=>"10","lang"=>"fr"));


        $o=array(
            new utilsTestLang("fr","1"),
            new utilsTestLang("fr","2"),
            new utilsTestLang("en","3"),
            new utilsTestLang("fr","4"),
            new utilsTestLang("de","5"),
            new utilsTestLang("de","6"),
            new utilsTestLang("en","7"),
            new utilsTestLang("de","9"),
            new utilsTestLang("fr","10"),
            new utilsTestLang("en","11")
        );

        $b=\Peek\Utils\ArrayUtils::splitByArg($o,"lang");

        $this->assertEquals($en,\Peek\Utils\ArrayUtils::objectToArray($b["en"]));
        $this->assertEquals($de,\Peek\Utils\ArrayUtils::objectToArray($b["de"]));
        $this->assertEquals($fr,\Peek\Utils\ArrayUtils::objectToArray($b["fr"]));

        $b=\Peek\Utils\ArrayUtils::splitByArg($o,"getLang()");

        $this->assertEquals($en,\Peek\Utils\ArrayUtils::objectToArray($b["en"]));
        $this->assertEquals($de,\Peek\Utils\ArrayUtils::objectToArray($b["de"]));
        $this->assertEquals($fr,\Peek\Utils\ArrayUtils::objectToArray($b["fr"]));


        $b=\Peek\Utils\ArrayUtils::splitByArg($o,function($item){
            return $item->getLang();
        });

        $this->assertEquals($en,\Peek\Utils\ArrayUtils::objectToArray($b["en"]));
        $this->assertEquals($de,\Peek\Utils\ArrayUtils::objectToArray($b["de"]));
        $this->assertEquals($fr,\Peek\Utils\ArrayUtils::objectToArray($b["fr"]));

    }

    
}


class utilsTestLang{

    public $name;
    public $lang;

    function __construct($lang, $name)
    {
        $this->lang = $lang;
        $this->name = $name;
    }

    /**
     * @param mixed $lang
     */
    public function setLang($lang)
    {
        $this->lang = $lang;
    }

    /**
     * @return mixed
     */
    public function getLang()
    {
        return $this->lang;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }




}