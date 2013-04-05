<?php

namespace Gajdaw\AngazeBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Gajdaw\AngazeBundle\Entity\Room;
use Gajdaw\AngazeBundle\Form\RoomType;

/**
 * Room controller.
 *
 * @Route("/room")
 */
class RoomController extends Controller
{
    /**
     * Lists all Room entities.
     *
     * @Route("/", name="room")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('GajdawAngazeBundle:Room')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new Room entity.
     *
     * @Route("/", name="room_create")
     * @Method("POST")
     * @Template("GajdawAngazeBundle:Room:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new Room();
        $form = $this->createForm(new RoomType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('room_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new Room entity.
     *
     * @Route("/new", name="room_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Room();
        $form   = $this->createForm(new RoomType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Room entity.
     *
     * @Route("/{id}", name="room_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GajdawAngazeBundle:Room')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Room entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Room entity.
     *
     * @Route("/{id}/edit", name="room_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GajdawAngazeBundle:Room')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Room entity.');
        }

        $editForm = $this->createForm(new RoomType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Room entity.
     *
     * @Route("/{id}", name="room_update")
     * @Method("PUT")
     * @Template("GajdawAngazeBundle:Room:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GajdawAngazeBundle:Room')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Room entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new RoomType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('room_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Room entity.
     *
     * @Route("/{id}", name="room_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('GajdawAngazeBundle:Room')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Room entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('room'));
    }

    /**
     * Creates a form to delete a Room entity by id.
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
