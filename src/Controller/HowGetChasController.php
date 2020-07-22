<?php

namespace App\Controller;

use App\Entity\BasePages;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class HowGetChasController extends AbstractController
{

    /**
     * @Route("/pages/how-get-chas",name="how-get-chas")
     */

    public function contact()
    {
        $em = $this->getDoctrine()->getManager();
        $page = $em->getRepository(BasePages::class)->findOneBy(['id' => 3]);

        return $this->render("pages/how-get-chas.html.twig", array(
            'page' => $page,
        ));
    }


}