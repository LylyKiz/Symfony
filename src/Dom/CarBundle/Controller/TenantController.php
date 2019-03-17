<?php

namespace Dom\CarBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Dom\CarBundle\Entity\Tenant;

/**
 * Tenant controller.
 *
 */
class TenantController extends Controller
{
    /**
     * Lists all Tenant entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $tenants = $em->getRepository('DomCarBundle:Tenant')->findAll();

        return $this->render('tenant/index.html.twig', array(
            'tenants' => $tenants,
        ));
    }

    /**
     * Finds and displays a Tenant entity.
     *
     */
    public function showAction(Tenant $tenant)
    {
	    $deleteForm = $this->createDeleteForm($tenant);

        return $this->render('tenant/show.html.twig', array(
            'tenant' => $tenant,
            'delete_form' => $deleteForm->createView(),
        ));
    }

	/**
	 * Creates a new Tenant entity.
	 *
	 */
	public function newAction(Request $request)
	{
		$tenant = new Tenant();
		$form = $this->createForm('Dom\CarBundle\Form\TenantType', $tenant);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($tenant);
			$em->flush();

			return $this->redirectToRoute('tenant_show', array('id' => $tenant->getId()));
		}

		return $this->render('tenant/new.html.twig', array(
			'tenant' => $tenant,
			'form' => $form->createView(),
		));
	}

	/**
	 * Displays a form to edit an existing Tenant entity.
	 *
	 */
	public function editAction(Request $request, Tenant $tenant)
	{
		$deleteForm = $this->createDeleteForm($tenant);
		$editForm = $this->createForm('Dom\CarBundle\Form\TenantType', $tenant);
		$editForm->handleRequest($request);

		if ($editForm->isSubmitted() && $editForm->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($tenant);
			$em->flush();

			return $this->redirectToRoute('tenant_edit', array('id' => $tenant->getId()));
		}

		return $this->render('tenant/edit.html.twig', array(
			'tenant' => $tenant,
			'edit_form' => $editForm->createView(),
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Deletes a Tenant entity.
	 *
	 */
	public function deleteAction(Request $request, Tenant $tenant)
	{
		$form = $this->createDeleteForm($tenant);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->remove($tenant);
			$em->flush();
		}

		return $this->redirectToRoute('tenant_index');
	}

	/**
	 * Creates a form to delete a Tenant entity.
	 *
	 * @param Tenant $tenant The Tenant entity
	 *
	 * @return \Symfony\Component\Form\Form The form
	 */
	private function createDeleteForm(Tenant $tenant)
	{
		return $this->createFormBuilder()
			->setAction($this->generateUrl('tenant_delete', array('id' => $tenant->getId())))
			->setMethod('DELETE')
			->getForm()
			;
	}
}
