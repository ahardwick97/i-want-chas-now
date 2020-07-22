<?php

namespace App\Controller;

use App\Entity\BasePages;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class ContactUsController extends AbstractController
{

    /**
     * @Route("/pages/contact-us",name="contact-us")
     */

    public function contact()
    {
        $em = $this->getDoctrine()->getManager();
        $page = $em->getRepository(BasePages::class)->findOneBy(['id' => 5]);

        return $this->render("pages/contact-us.html.twig", array(
            'page' => $page,
        ));
    }


}