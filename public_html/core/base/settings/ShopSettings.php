<?php


namespace core\base\settings;
use core\base\settings\Settings;

class ShopSettings
{
    static private $_instance;
    private $baseSettings;

    private $templateArr =[
    'text' => ['prise', 'short'],
    'templates' => ['goods_content']
];
    static public function get($property){
        return self::instance()->$property;
    }

    static public function instance(){
        if(self::$_instance instanceof self){
            return self::$_instance;
        }
        self::$_instance = new self();
        self::$_instance->baseSettings = Settings::instance();
        $baseProperties = self::$_instance->baseSettings->clueProperties(get_class());
        self::$_instance->setProperty($baseProperties);

        return self::$_instance = new self;
    }
    protected function setProperty($properties){
        if($properties){
            foreach ($properties as $name => $property){
                $this->$name = $property;

            }
        }
    }

    private function _construct()
    {
    }
    private function _clone()
    {
    }
}