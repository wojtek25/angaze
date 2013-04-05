<?php

namespace Gajdaw\AngazeBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Gajdaw\AngazeBundle\Entity\SubjectType;
use Gajdaw\AngazeBundle\Form\SubjectTypeType;

/**
 * SubjectType controller.
 *
 * @Route("/subjecttype")
 */
class SubjectTypeController extends Controller
{
    /**
     * Lists all SubjectType entities.
     *
     * @Route("/", name="subjecttype")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('GajdawAngazeBundle:SubjectType')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new SubjectType entity.
     *
     * @Route("/", name="subjecttype_create")
     * @Method("POST")
     * @Template("GajdawAngazeBundle:SubjectType:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new SubjectType();
        $form = $this->createForm(new SubjectTypeType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('subjecttype_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new SubjectType entity.
     *
     * @Route("/new", name="subjecttype_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new SubjectType();
        $form   = $this->createForm(new SubjectTypeType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a SubjectType entity.
     *
     * @Route("/{id}", name="subjecttype_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GajdawAngazeBundle:SubjectType')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SubjectType entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing SubjectType entity.
     *
     * @Route("/{id}/edit", name="subjecttype_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GajdawAngazeBundle:SubjectType')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SubjectType entity.');
        }

        $editForm = $this->createForm(new SubjectTypeType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing SubjectType entity.
     *
     * @Route("/{id}", name="subjecttype_update")
     * @Method("PUT")
     * @Template("GajdawAngazeBundle:SubjectType:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GajdawAngazeBundle:SubjectType')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SubjectType entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new SubjectTypeType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('subjecttype_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a SubjectType entity.
     *
     * @Route("/{id}", name="subjecttype_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('GajdawAngazeBundle:SubjectType')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find SubjectType entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('subjecttype'));
    }

    /**
     * Creates a form to delete a SubjectType entity by id.
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
