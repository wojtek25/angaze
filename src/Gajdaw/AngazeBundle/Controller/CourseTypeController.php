<?php

namespace Gajdaw\AngazeBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Gajdaw\AngazeBundle\Entity\CourseType;
use Gajdaw\AngazeBundle\Form\CourseTypeType;

/**
 * CourseType controller.
 *
 * @Route("/coursetype")
 */
class CourseTypeController extends Controller
{
    /**
     * Lists all CourseType entities.
     *
     * @Route("/", name="coursetype")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('GajdawAngazeBundle:CourseType')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new CourseType entity.
     *
     * @Route("/", name="coursetype_create")
     * @Method("POST")
     * @Template("GajdawAngazeBundle:CourseType:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new CourseType();
        $form = $this->createForm(new CourseTypeType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('coursetype_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new CourseType entity.
     *
     * @Route("/new", name="coursetype_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new CourseType();
        $form   = $this->createForm(new CourseTypeType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a CourseType entity.
     *
     * @Route("/{id}", name="coursetype_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GajdawAngazeBundle:CourseType')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CourseType entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing CourseType entity.
     *
     * @Route("/{id}/edit", name="coursetype_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GajdawAngazeBundle:CourseType')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CourseType entity.');
        }

        $editForm = $this->createForm(new CourseTypeType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing CourseType entity.
     *
     * @Route("/{id}", name="coursetype_update")
     * @Method("PUT")
     * @Template("GajdawAngazeBundle:CourseType:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GajdawAngazeBundle:CourseType')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CourseType entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new CourseTypeType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('coursetype_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a CourseType entity.
     *
     * @Route("/{id}", name="coursetype_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('GajdawAngazeBundle:CourseType')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find CourseType entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('coursetype'));
    }

    /**
     * Creates a form to delete a CourseType entity by id.
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
