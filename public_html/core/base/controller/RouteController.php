<?php
/*створений на основі патерна Singleton (одинак)
Одинак — це породжувальний патерн проектування, який гарантує,
що клас має лише один екземпляр, та надає глобальну точку доступу до нього.*/


namespace core\base\controller;

use core\base\exception\RouteException;
use core\base\settings\Settings;
use core\base\settings\ShopSettings;


class RouteController
{

    static private $_instance;
    protected $routes;

    protected $controller;
    protected $inputMethod;
    protected $outputMethod;
    protected $parameters;


  private function _clone()
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
        $adress_str =$_SERVER['REQUEST_URI'];
        if(strrpos($adress_str, '/') === strlen($adress_str)-1 && strrpos($adress_str, '/') !== 0){
        $this->redirect(rtrim($adress_str,'/'), 301);
    }
    $path = substr($_SERVER['PHP_SELF'], 0, strpos($_SERVER['PHP_SELF'],'index.php'));
        if ($path === PATH){
            $this->routes = Settings::get('routers');
            if(!$this->routes) throw new RouteException('Сайт знаходиться на технічному обслуговуванні');
            if(strrpos($adress_str, $this->routes['admin']['alias']) === strlen("PATH")){

            }else{
                $url = explode('/', substr($adress_str, strlen(PATH)));
            $hrUrl = $this->routes['user']['hrUrl'];
            $this->controller = $this->routes['user']['path'];
            $route = 'user';
            }

            $this->createRoute($route, $url);
            exit();

        }else{
            try {
                throw new \Exception('Некоректна директорія сайту');
            }catch (\Exception $e){
                exit($e->getMessage());
            }
        }
    }
            private function createRoute($var, $arr){
      $route =[];
      if(!empty($arr[0])){
          if($this->routes[$var]['routes'][$arr[0]]){
              $route = explode('/',$this->routes[$var]['routes'][$arr[0]]);
              $this->controller .= ucfirst($route[0].'Controller');
          }else{
              $this->controller .= ucfirst($arr[0].'Controller');
          }
      }else{
          $this->controller .= $this->routes['default']['controller'];
      }
      $this->inputMethod = $route[1] ? $route [1] : $this->routes['default']['inputMethod'];
      $this->outputMethod = $route[1] ? $route [1] : $this->routes['default']['outputMethod'];

      return;
    }

}
