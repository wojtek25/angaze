<?php

namespace Gajdaw\AngazeBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Gajdaw\AngazeBundle\Entity\Organization;
use Gajdaw\AngazeBundle\Form\OrganizationType;

/**
 * Organization controller.
 *
 * @Route("/organization")
 */
class OrganizationController extends Controller
{
    /**
     * Lists all Organization entities.
     *
     * @Route("/", name="organization")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('GajdawAngazeBundle:Organization')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new Organization entity.
     *
     * @Route("/", name="organization_create")
     * @Method("POST")
     * @Template("GajdawAngazeBundle:Organization:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new Organization();
        $form = $this->createForm(new OrganizationType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('organization_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new Organization entity.
     *
     * @Route("/new", name="organization_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Organization();
        $form   = $this->createForm(new OrganizationType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Organization entity.
     *
     * @Route("/{id}", name="organization_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GajdawAngazeBundle:Organization')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Organization entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Organization entity.
     *
     * @Route("/{id}/edit", name="organization_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GajdawAngazeBundle:Organization')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Organization entity.');
        }

        $editForm = $this->createForm(new OrganizationType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Organization entity.
     *
     * @Route("/{id}", name="organization_update")
     * @Method("PUT")
     * @Template("GajdawAngazeBundle:Organization:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GajdawAngazeBundle:Organization')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Organization entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new OrganizationType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('organization_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Organization entity.
     *
     * @Route("/{id}", name="organization_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('GajdawAngazeBundle:Organization')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Organization entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('organization'));
    }

    /**
     * Creates a form to delete a Organization entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
