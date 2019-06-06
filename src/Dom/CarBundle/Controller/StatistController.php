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
class StatistController extends Controller
{

	/**
	 * Lists all History entities.
	 *
	 * @param Request $request
	 *
	 * @return Response
	 */
	public function indexAction()
	{

		$em   = $this -> getDoctrine() ->getEntityManager();
		$con=$em->getConnection();
		$sql='
			SELECT (select brand from car where car.id=history.car_id) cars, (select adres from point where point.id=history.point_id) point, avg(DATEDIFF (data_return,data_taking)) as dats from history GROUP BY car_id,point_id
			';
		$datatable = $con->prepare($sql);
		$datatable->execute();

		return $this->render('statist/index.html.twig', array(
			'datatable' =>$datatable->fetchAll()

		));
	}

   }