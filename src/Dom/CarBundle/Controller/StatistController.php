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
	public function indexAction(Request $request)
	{

		//разница между датами
		/*CREATE TABLE dbo.Duration
	(startDate datetime2, endDate datetime2);

INSERT INTO dbo.Duration(startDate, endDate)
    VALUES ('2007-05-06 12:10:09', '2007-05-07 12:10:09');

SELECT DATEDIFF(day, startDate, endDate) AS 'Duration'
    FROM dbo.Duration;
-- Returns: 1 */



		$em   = $this -> getDoctrine() -> getManager();
		$cars = $em -> getRepository('DomCarBundle:Car') -> findAll();

		$points = $em->getRepository('DomCarBundle:Point')->findAll();
		$history = $em->getRepository('DomCarBundle:History')->findAll();
		/*foreach ($cars as $key_cars => $value_cars) {*/

			foreach ($history as $key_history => $value_history) {
				$mas[$value_history->getCar()->getId()][] =  date_diff($value_history->getDataReturn(),$value_history->getDataTaking());

			}
		/*}*/

	//var_dump($history);
			/*foreach ($history as $key_history => $value_history) {
				foreach ($value_history as $key2_history => $value2_history) {
					foreach ($cars as $key_cars => $value_cars) {
						if($history[$key_history][$value_history]['car_id']=$cars['id']){
							$datatable[]=$cars['id'];
						}
					}
				}
			}*/


		return $this->render('statist/index.html.twig', array(
			'datatable' =>$datatable,

		));
	}

   }