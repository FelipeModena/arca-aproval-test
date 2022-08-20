<?php

namespace CompanyBundle\Controller;

use CompanyBundle\Entity\CompanyEntity;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Companyentity controller.
 *
 */
class CompanyEntityController extends Controller
{
    /**
     * Lists all companyEntity entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $companyEntities = $em->getRepository('CompanyBundle:CompanyEntity')->findAll();

        return $this->render('companyentity/index.html.twig', array(
            'companyEntities' => $companyEntities,
        ));
    }

    /**
     * Creates a new companyEntity entity.
     *
     */
    public function newAction(Request $request)
    {
        $companyEntity = new Companyentity();
        $form = $this->createForm('CompanyBundle\Form\CompanyEntityType', $companyEntity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($companyEntity);
            $em->flush();

            return $this->redirectToRoute('companyentity_show', array('id' => $companyEntity->getId()));
        }

        return $this->render('companyentity/new.html.twig', array(
            'companyEntity' => $companyEntity,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a companyEntity entity.
     *
     */
    public function showAction(CompanyEntity $companyEntity)
    {
        $deleteForm = $this->createDeleteForm($companyEntity);

        return $this->render('companyentity/show.html.twig', array(
            'companyEntity' => $companyEntity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing companyEntity entity.
     *
     */
    public function editAction(Request $request, CompanyEntity $companyEntity)
    {
        $deleteForm = $this->createDeleteForm($companyEntity);
        $editForm = $this->createForm('CompanyBundle\Form\CompanyEntityType', $companyEntity);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('companyentity_edit', array('id' => $companyEntity->getId()));
        }

        return $this->render('companyentity/edit.html.twig', array(
            'companyEntity' => $companyEntity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a companyEntity entity.
     *
     */
    public function deleteAction(Request $request, CompanyEntity $companyEntity)
    {
        $form = $this->createDeleteForm($companyEntity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($companyEntity);
            $em->flush();
        }

        return $this->redirectToRoute('companyentity_index');
    }

    /**
     * Creates a form to delete a companyEntity entity.
     *
     * @param CompanyEntity $companyEntity The companyEntity entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(CompanyEntity $companyEntity)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('companyentity_delete', array('id' => $companyEntity->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
