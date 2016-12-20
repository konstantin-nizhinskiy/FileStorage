<?php

namespace FileStorageBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DeleteFileController extends Controller
{
    /**
     * @Route("/delete/public/{file}", name="fileDelete", requirements={"file": "\w+"})
     * @Method("DELETE")
     * @param Request $request
     * @param $file
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function indexAction(Request $request,$file)
    {
        //@TODO сделать возможность по ключам авторизоваться через сторонний бек
        $level=$this->container->getParameter('file.storage.dir.level');
        $dirs=str_split($file,2);
        $directory=$this->container->getParameter('file.storage.dir.public');
        $directoryPreView = $this->container->getParameter('file.storage.dir.preview');
        for($i=0;$i<$level;$i++){
            $directory.=$dirs[$i].'/';
            $directoryPreView.=$dirs[$i].'/';
        }
        array_map("unlink", glob($directory.$file.".*"));
        return $this->json(array(
            't'=>'a'
        ));

    }
}
