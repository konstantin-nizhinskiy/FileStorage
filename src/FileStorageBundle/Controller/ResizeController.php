<?php

namespace FileStorageBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ResizeController extends Controller
{
    /*fs/$2/$3/$2$3$4.$1$5?w=$1*/
    /**
     * @Route("/get/public/{w}x{h}/{file}",
     *          name="fileResizeWH",
     *          requirements={
     *              "w": "\d+",
     *              "h": "\d+",
     *              "file": "\w+"
     *          })
     *
     * @Route("/get/public/{w}/{file}",
     *          name="fileResize",
     *          defaults={
     *              "h": "0"
     *          },
     *          requirements={
     *              "w": "\d+",
     *              "file": "\w+"
     *          })
     * @Route("/get/public/pre/{file}",
     *          name="fileResizeP",
     *          defaults={
     *              "h": "0",
     *              "w": "0"
     *          },
     *          requirements={
     *              "file": "\w+"
     *          })
     * @param Request $request
     * @param $w
     * @param $h
     * @param $file
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function indexAction(Request $request, $w, $h, $file)
    {
        $level = $this->container->getParameter('file.storage.dir.level');
        $dirs = str_split($file, 2);
        $directory = $this->container->getParameter('file.storage.dir.public');

        for ($i = 0; $i < $level; $i++) {
            $directory .= $dirs[$i] . '/';
        }
        if ($w == 0 && $h == 0) {
            $w = $this->container->getParameter('file.storage.preview.default');
        }
        if (!file_exists($directory . $file . '.jpg')) {
            throw $this->createNotFoundException();

        }
        $imagick = new \Imagick($directory . $file . '.jpg');
        $imagick->resizeImage($w, $h, \Imagick::FILTER_LANCZOS, 1);

        if ($this->container->hasParameter('file.storage.preview.save') && $h == 0) {
            if (in_array($w, $this->container->getParameter('file.storage.preview.save'))) {
                $directoryPreView = $this->container->getParameter('file.storage.dir.preview');
                if(!file_exists($directoryPreView)){
                    mkdir($directoryPreView, 0777);
                }
                for ($i = 0; $i < $level; $i++) {
                    $directoryPreView .= $dirs[$i] . '/';
                    if (!file_exists($directoryPreView . '/')) {
                        mkdir($directoryPreView, 0777);
                    }
                }
                file_put_contents($directoryPreView . $file . '.' . $w . '.jpg', $imagick);
            }
        }

        return new Response($imagick->getImageBlob(), 200, array('Content-Type' => 'image/png'));

    }
}
