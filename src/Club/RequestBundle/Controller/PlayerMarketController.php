<?php

namespace Club\RequestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * @Route("/playermarket")
 */
class PlayerMarketController extends Controller
{
  /**
   * @Route("/")
   * @Template()
   */
  public function indexAction()
  {
    $em = $this->getDoctrine()->getEntityManager();

    $market = $em->getRepository('ClubRequestBundle:Request')->findAll();
    return array(
      'market' => $market
    );
  }

  /**
   * @Route("/new")
   * @Template()
   */
  public function newAction()
  {
    $request = new \Club\RequestBundle\Entity\Request();
    $request->setUser($this->get('security.context')->getToken()->getUser());

    $form = $this->createForm(new \Club\RequestBundle\Form\Request(), $request);
    if ($this->getRequest()->getMethod() == 'POST') {
      $form->bindRequest($this->getRequest());
      if ($form->isValid()) {
        $em = $this->getDoctrine()->getEntityManager();
        $em->persist($request);
        $em->flush();

        $this->get('session')->setFlash('notice', $this->get('translator')->trans('Your changes are saved.'));
        return $this->redirect($this->generateUrl('club_request_playermarket_index'));
      }
    }

    return array(
      'form' => $form->createView()
    );
  }
}
