<?php

namespace App\Controller;

use App\Entity\BasePages;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class IndexController extends AbstractController
{

    /**
     * @Route("/pages/index",name="home")
     * * @Route("/")
     */

    public function contact()
    {
        $em = $this->getDoctrine()->getManager();
        $page = $em->getRepository(BasePages::class)->findOneBy(['id' => 1]);

        return $this->render("pages/index.html.twig", array(
            'page' => $page,
        ));
    }


}