<?php

namespace FileStorageBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class FileLoadController extends Controller
{
    private $code=306;
    /**
     * @Route("/fileLoad", name="fileLoad")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function indexAction(Request $request)
    {
        //@TODO сделать возможность по ключам авторизоваться через сторонний бек
        if(isset($_SERVER['HTTP_ORIGIN']) && $this->container->hasParameter('file.storage.CORS')){
            $http_origin = $_SERVER['HTTP_ORIGIN'];
            if(in_array($http_origin,$this->container->getParameter('file.storage.CORS'))){
                header("Access-Control-Allow-Origin: $http_origin");
            }
        }
     //   header("Access-Control-Allow-Origin: *");
        if(!file_exists($this->container->getParameter('file.storage.dir.public'))){
            mkdir($this->container->getParameter('file.storage.dir.public'), 0777);
        }

        $names=[];
        if(is_array($_FILES['file']['tmp_name'])) {
            foreach ($_FILES['file']['tmp_name'] as $key => $file) {
                $names[]=$this->saveFile($file, $_FILES['file']['type'][$key], $_FILES['file']['name'][$key]);
            }
        }else{
            $names[]=$this->saveFile($_FILES['file']['tmp_name'], $_FILES['file']['type'], $_FILES['file']['name']);
        }
        return $this->json(array(
            'ids'=>$names,
            'code'=>$this->code,
            ),200);
    }
    private  function saveFile($file,$type,$nameFile){
        $level=$this->container->getParameter('file.storage.dir.level');
        $name=hash_file("sha224", $file, FALSE);
        $dirs=str_split($name,2);
        $directory=$this->container->getParameter('file.storage.dir.public');
        for($i=0;$i<$level;$i++){
            $directory.=$dirs[$i].'/';
            if(!file_exists($directory.'/')){
                mkdir($directory, 0777);
            }
        }
        if(strpos( $type, 'image')!==false){

            if(!file_exists($directory.'/'.$name.'.jpg')) {
                /**********Пришлось делать через консоль так как PHP не хавае кривые файл*******************/
                shell_exec('cd ' . $directory . '; convert ' . $file . ' ' .
                    '-thumbnail '.$this->container->getParameter('file.storage.convert.resize').' '.
                    $this->container->getParameter('file.storage.convert.property').
                    $name.'.jpg');

            }
            return $name;
        }
        //@TODO Отключил часть загрузки не рисунков для данного заказа не актуально
        /*else{
            move_uploaded_file($file, $directory.'/'.$name);
            return $name.'.'.pathinfo($nameFile, PATHINFO_EXTENSION);
        }*/
    }
}
