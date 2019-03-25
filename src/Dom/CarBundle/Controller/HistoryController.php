<?php

namespace Dom\CarBundle\Controller;

use Dom\CarBundle\Datatables\HistoryDatatable;
use function Sodium\add;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Dom\CarBundle\Entity\History;
use Dom\CarBundle\Form\HistoryType;

use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
/**
 * History controller.
 *
 */
class HistoryController extends Controller
{

	/**
	 * Lists all History entities.
	 *
	 * @param Request $request
	 *
	 * @return Response
	 */
	public function indexAction(Request $request)
	{

		$em   = $this -> getDoctrine() -> getManager();
		$cars = $em -> getRepository('DomCarBundle:Car') -> findAll();

		$isAjax = $request->isXmlHttpRequest();

		// Get your Datatable ...
		//$datatable = $this->get('app.datatable.post');
		//$datatable->buildDatatable();

		// or use the DatatableFactory
		/** @var DatatableInterface $datatable */
		$datatable = $this->get('sg_datatables.factory')->create(HistoryDatatable::class);
		$datatable->buildDatatable();

		if ($isAjax) {
			$responseService = $this->get('sg_datatables.response');
			$responseService->setDatatable($datatable);
			$responseService->getDatatableQueryBuilder();

			return $responseService->getResponse();
		}

		return $this->render('history/index.html.twig', array(
			'datatable' => $datatable,
			'cars'=>$cars
		));
	}

    /**
     * Creates a new History entity.
     *
     */
    public function newAction(Request $request)
    {
        $history = new History();
        $form = $this->createForm('Dom\CarBundle\Form\HistoryType', $history);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($history);
            $em->flush();

            return $this->redirectToRoute('history_show', array('id' => $history->getId()));
        }

        return $this->render('history/new.html.twig', array(
            'history' => $history,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a History entity.
     *
     */
    public function showAction(History $history)
    {
        $deleteForm = $this->createDeleteForm($history);

        return $this->render('history/show.html.twig', array(
            'history' => $history,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing History entity.
     *
     */
    public function editAction(Request $request, History $history)
    {
        $deleteForm = $this->createDeleteForm($history);
        $editForm = $this->createForm('Dom\CarBundle\Form\HistoryType', $history);

        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($history);
            $em->flush();

            return $this->redirectToRoute('history_edit', array('id' => $history->getId()));
        }

        return $this->render('history/edit.html.twig', array(
            'history' => $history,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a History entity.
     *
     */
    public function deleteAction(Request $request, History $history)
    {
        $form = $this->createDeleteForm($history);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($history);
            $em->flush();
        }

        return $this->redirectToRoute('history_index');
    }

    /**
     * Creates a form to delete a History entity.
     *
     * @param History $history The History entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(History $history)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('history_delete', array('id' => $history->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
