<?php
/*створений на основі патерна Singleton (одинак)
Одинак — це породжувальний патерн проектування, який гарантує,
що клас має лише один екземпляр, та надає глобальну точку доступу до нього.*/


namespace core\base\controllers;

use core\base\settings\Settings;


class RouteController
{

    static private $_instance;

  private function  _clone()
  {
  }
  static public function getInstance(){
      if(self::$_instance instanceof self){
          return self::$_instance;
      }
      return self::$_instance = new self;
  }
    private function  _construct()
    {
    }
}
