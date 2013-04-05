<?php

namespace Gajdaw\AngazeBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Gajdaw\AngazeBundle\Entity\Faculty;
use Gajdaw\AngazeBundle\Form\FacultyType;

/**
 * Faculty controller.
 *
 * @Route("/faculty")
 */
class FacultyController extends Controller
{
    /**
     * Lists all Faculty entities.
     *
     * @Route("/", name="faculty")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('GajdawAngazeBundle:Faculty')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new Faculty entity.
     *
     * @Route("/", name="faculty_create")
     * @Method("POST")
     * @Template("GajdawAngazeBundle:Faculty:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new Faculty();
        $form = $this->createForm(new FacultyType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('faculty_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new Faculty entity.
     *
     * @Route("/new", name="faculty_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Faculty();
        $form   = $this->createForm(new FacultyType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Faculty entity.
     *
     * @Route("/{id}", name="faculty_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GajdawAngazeBundle:Faculty')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Faculty entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Faculty entity.
     *
     * @Route("/{id}/edit", name="faculty_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GajdawAngazeBundle:Faculty')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Faculty entity.');
        }

        $editForm = $this->createForm(new FacultyType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Faculty entity.
     *
     * @Route("/{id}", name="faculty_update")
     * @Method("PUT")
     * @Template("GajdawAngazeBundle:Faculty:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GajdawAngazeBundle:Faculty')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Faculty entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new FacultyType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('faculty_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Faculty entity.
     *
     * @Route("/{id}", name="faculty_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('GajdawAngazeBundle:Faculty')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Faculty entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('faculty'));
    }

    /**
     * Creates a form to delete a Faculty entity by id.
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
