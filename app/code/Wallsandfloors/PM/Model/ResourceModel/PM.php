<?php
namespace Wallsandfloors\PM\Model\ResourceModel;


class PM extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
	protected function _construct()
	{
		$this->_init('promotional_messages', 'id');
	}
	
}