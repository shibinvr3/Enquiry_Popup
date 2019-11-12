<?php 
namespace Brightowl\Bespoke\Model\ResourceModel;
class BespokeInquiry extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb{
    public function __construct(
        \Magento\Framework\Model\ResourceModel\Db\Context $context
    ) {
        parent::__construct($context);
    }
	 protected function _construct(){
	 	$this->_init("bespoke_inquiry","entity_id");
	 }
}
 ?>