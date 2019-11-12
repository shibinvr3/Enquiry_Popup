<?php 
namespace Brightowl\Bespoke\Model\ResourceModel\BespokeInquiry;
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection{
	
	protected $_idFieldName = 'entity_id';
	
	public function __construct(
        \Magento\Framework\Data\Collection\EntityFactoryInterface $entityFactory,
        \Psr\Log\LoggerInterface $logger,
        \Magento\Framework\Data\Collection\Db\FetchStrategyInterface $fetchStrategy,
        \Magento\Framework\Event\ManagerInterface $eventManager,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\DB\Adapter\AdapterInterface $connection = null,
        \Magento\Framework\Model\ResourceModel\Db\AbstractDb $resource = null
    ) {
        parent::__construct($entityFactory, $logger, $fetchStrategy, $eventManager, $connection, $resource);
        $this->storeManager = $storeManager;
    }
	public function _construct(){
		$this->_init("Brightowl\Bespoke\Model\BespokeInquiry","Brightowl\Bespoke\Model\ResourceModel\BespokeInquiry");
	}
	protected function _initSelect()
    {
        parent::_initSelect();
        return $this;
    }
}
 ?>

