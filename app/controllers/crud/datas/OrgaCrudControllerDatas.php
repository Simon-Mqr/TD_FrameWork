<?php
namespace controllers\crud\datas;

use Ubiquity\controllers\crud\CRUDDatas;
 /**
  * Class OrgaCrudControllerDatas
  */
class OrgaCrudControllerDatas extends CRUDDatas{
	public function getFieldNames(string $model): array
    {
        return ['name', 'domain'];
    }

    public function getFormFieldNames(string $model, $instance): array
    {
        $fields = parent::getElementFieldNames($model, $instance);
        $fields[] = 'groups';
        $fields[] = 'users';
        return $fields;
    }
}
