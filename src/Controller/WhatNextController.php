<?php

namespace App\Controller;

use App\Entity\BasePages;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class WhatNextController extends AbstractController
{

    /**
     * @Route("/pages/what-next",name="what-next")
     */

    public function contact()
    {
        $em = $this->getDoctrine()->getManager();
        $page = $em->getRepository(BasePages::class)->findOneBy(['id' => 4]);

        return $this->render("pages/what-next.html.twig", array(
            'page' => $page,
        ));
    }


}