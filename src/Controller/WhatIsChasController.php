<?php

namespace App\Controller;

use App\Entity\BasePages;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class WhatIsChasController extends AbstractController
{

    /**
     * @Route("/pages/what-is-chas",name="what-is-chas")
     */

    public function contact()
    {
        $em = $this->getDoctrine()->getManager();
        $page = $em->getRepository(BasePages::class)->findOneBy(['id' => 2]);

        return $this->render("pages/what-is-chas.html.twig", array(
            'page' => $page,
        ));
    }


}