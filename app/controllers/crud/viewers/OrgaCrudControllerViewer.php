<?php
namespace controllers\crud\viewers;

use Ajax\semantic\widgets\datatable\DataTable;
use Ubiquity\controllers\crud\viewers\ModelViewer;
 /**
  * Class OrgaCrudControllerViewer
  */
class OrgaCrudControllerViewer extends ModelViewer{
	protected function getDataTableRowButtons(): array
    {
        return ['barcode', 'display', 'edit', 'delete'];
    }

    public function getModelDataTable($instances, $model, $totalCount, $page = 1): DataTable
    {
        $dt = parent::getModelDataTable($instances, $model, $totalCount, $page);
        $dt->fieldAsLabel('domain', 'earlybirds', '');
        $dt->setEdition(true);
        return $dt;
    }
}
