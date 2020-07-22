<?php


namespace App\Controller\forms;


use App\Entity\PostForm;
use Swift_Mailer;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Routing\Annotation\Route;

class FormController extends AbstractController
{

    public function validateEmail($email)
    {
        return (\filter_var($email, FILTER_VALIDATE_EMAIL));
    }

    /**
     * @Route("/pages/thankyou",name="contact-form")
     * @param Request $request
     * @param Swift_Mailer $mailer
     * @return RedirectResponse|Response
     */
    public function formHandler(Request $request, MailerInterface $mailer)
    {
        if (!$request->isMethod("post")) {
            return $this->redirectToRoute("about");
        }

        $em = $this->getDoctrine()->getManager();
        $page = $em->getRepository(PostForm::class)->findOneBy(['id' => 1]);



        $email = (new TemplatedEmail())
            ->from('noreply@hsdirect.co.uk')
            ->to(new Address('a.hardwick@hsdirect.co.uk'))
            ->subject('Contact request alert')

            // path of the Twig template to render
            ->htmlTemplate('emails/alert_email.html.twig')

            // pass variables (name => value) to the template
            ->context([
                "fullname" => $request->get("fullname"),
                "companyname" => $request->get("companyname"),
                "email2" => $request->get("email"),
                "telephone" => $request->get("telephone"),
                "message" => $request->get("message")
            ])
        ;

        $recipient_email = (new TemplatedEmail())
            ->from('noreply@hsdirect.co.uk')
            ->to(new Address($request->get("email")))
            ->subject('Thank you for getting in contact')

            // path of the Twig template to render
            ->htmlTemplate('emails/recipient_email.html.twig')

            // pass variables (name => value) to the template
            ->context([
                "fullname" => $request->get("fullname"),
            ])
        ;

        $mailer->send($email);
        $mailer->send($recipient_email);


        return $this->render("pages/contact_thank_you.html.twig", array(
            'page' => $page,
        ));

    }

}