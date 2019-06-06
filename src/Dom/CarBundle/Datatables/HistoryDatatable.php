<?php

namespace Dom\CarBundle\Datatables;

use Sg\DatatablesBundle\Datatable\AbstractDatatable;
use Sg\DatatablesBundle\Datatable\Style;
use Sg\DatatablesBundle\Datatable\Column\Column;
use Sg\DatatablesBundle\Datatable\Column\BooleanColumn;
use Sg\DatatablesBundle\Datatable\Column\ActionColumn;
use Sg\DatatablesBundle\Datatable\Column\MultiselectColumn;
use Sg\DatatablesBundle\Datatable\Column\VirtualColumn;
use Sg\DatatablesBundle\Datatable\Column\NumberColumn;
use Sg\DatatablesBundle\Datatable\Column\DateTimeColumn;
use Sg\DatatablesBundle\Datatable\Column\ImageColumn;
use Sg\DatatablesBundle\Datatable\Filter\TextFilter;
use Sg\DatatablesBundle\Datatable\Filter\NumberFilter;
use Sg\DatatablesBundle\Datatable\Filter\SelectFilter;
use Sg\DatatablesBundle\Datatable\Filter\DateRangeFilter;
use Sg\DatatablesBundle\Datatable\Editable\CombodateEditable;
use Sg\DatatablesBundle\Datatable\Editable\SelectEditable;
use Sg\DatatablesBundle\Datatable\Editable\TextareaEditable;
use Sg\DatatablesBundle\Datatable\Editable\TextEditable;

/**
 * Class HistoryDatatable
 *
 * @package Dom\CarBundle\Datatables
 */
class HistoryDatatable extends AbstractDatatable
{
    /**
     * {@inheritdoc}
     */
    public function buildDatatable(array $options = array())
    {
        $this->language->set(array(
            'cdn_language_by_locale' => true,
            'language' => 'ru'
        ));

        $this->ajax->set(array(
        ));

        $this->options->set(array(
            'individual_filtering' => true,
            'individual_filtering_position' => 'head',
            'order_cells_top' => true,
        ));

        $this->features->set(array(
        ));

        $this->columnBuilder
	        ->add('car.brand', Column::class, array(
		        'title' => 'Автомобиль',
	        ))
	        ->add('tenant.fullName', Column::class, array(
		        'title' => 'Арендатор',
	        ))
	        ->add('point.adres', Column::class, array(
		        'title' => 'Точка проката',
	        ))
            /*->add('id', Column::class, array(
                'title' => 'Id',
                ))*/
            ->add('dataTaking', DateTimeColumn::class, array(
                'title' => 'Дават взятия в прокат',
                'default_content' => 'No value',
                'date_format' => 'L',
                'editable' => array(CombodateEditable::class, array(
	                'format' => 'YYYY-MM-DD',
	                'view_format' => 'DD.MM.YYYY',
	                //'pk' => 'cid'
                )),
                ))
            ->add('dataReturn', DateTimeColumn::class, array(
                'title' => 'Дата возврата в прокат',
                'default_content' => 'No value',
                'date_format' => 'L',
                'editable' => array(CombodateEditable::class, array(
	                'format' => 'YYYY-MM-DD HH:MM:SS',
	                'view_format' => 'DD.MM.YYYY',
	                //'pk' => 'cid'
                )),
                'filter' => array(DateRangeFilter::class, array(
	                'cancel_button' => false,
                )),
                ))
           /* ->add('car.id', Column::class, array(
                'title' => 'Car Id',
                ))*/
           /* ->add('car.number', Column::class, array(
                'title' => 'Car Number',
                ))
            ->add('car.createdAt', Column::class, array(
                'title' => 'Car CreatedAt',
                ))
            ->add('car.updatedAt', Column::class, array(
                'title' => 'Car UpdatedAt',
                ))*/
           /* ->add('tenant.id', Column::class, array(
                'title' => 'Tenant Id',
                ))*/
           /*->add('tenant.createdAt', Column::class, array(
                'title' => 'Tenant CreatedAt',
                ))
            ->add('tenant.updatedAt', Column::class, array(
                'title' => 'Tenant UpdatedAt',
                ))*/
            ->add(null, ActionColumn::class, array(
                'title' => 'Действия',
                'actions' => array(
                    array(
                        'route' => 'history_show',
                        'route_parameters' => array(
                            'id' => 'id'
                        ),
                        'label' => 'Просмотр',
                        'attributes' => array(
                        	'rel' => 'tooltip',
                            'title' => $this->translator->trans('sg.datatables.actions.show'),
                            'class' => 'btn btn-primary',
                            'role' => 'button',
                            'button_value'=>'Просмотр'
                        ),
                    ),
                    array(
                        'route' => 'history_edit',
                        'route_parameters' => array(
                            'id' => 'id'
                        ),
                        'label' => 'Редактировать',
                        'attributes' => array(
                            'rel' => 'tooltip',
                            'title' => $this->translator->trans('sg.datatables.actions.edit'),
                            'class' => 'btn btn-primary',
                            'role' => 'button'
                        ),
                    )
                )
            ))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getEntity()
    {
        return 'Dom\CarBundle\Entity\History';
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'history_datatable';
    }
}
