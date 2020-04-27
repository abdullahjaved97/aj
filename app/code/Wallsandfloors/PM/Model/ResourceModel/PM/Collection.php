<?php
namespace Wallsandfloors\PM\Model\ResourceModel\PM;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
	protected $_idFieldName = 'id';
	protected function _construct()
	{
		$this->_init('Wallsandfloors\PM\Model\PM', 'Wallsandfloors\PM\Model\ResourceModel\PM');
	}

}