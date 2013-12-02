<?php

namespace Core\LuckyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="public_home")
     * @Template()
     */
    public function indexAction()
    {
		$request = $this->getRequest();
		$em = $this->getDoctrine()->getManager();
		$form = $this->createForm(new \Core\LuckyBundle\Form\StartType(), null, array(
			'action' => $this->generateUrl('public_home'),
			'method' => 'POST',
		));
		if ($request->getMethod() == 'POST') {
			$form->bind($request);
			if ($form->isValid()) {
				$user = $form->getData();
				$em->persist($user);
				$em->flush();
				return $this->forward('CoreLuckyBundle:Default:payment',  array('start' => true));
			}
		}
        return $this->render('CoreLuckyBundle:Default:index.html.twig',  array('form' => $form->createView()));
    }
	
    public function paymentAction($start)
    {
		$request = $this->getRequest();
		if ($request->getMethod() == 'POST' AND $start === true) {
			return $this->render('CoreLuckyBundle:Default:payment.html.twig');
		}
    }
}
