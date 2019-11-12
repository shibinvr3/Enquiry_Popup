<?php
namespace Brightowl\Bespoke\Ui\Component\Listing\DataProviders\Brightowl\Bespoke\Selector;

class Bespoke extends \Magento\Ui\DataProvider\AbstractDataProvider
{    
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        \Brightowl\Bespoke\Model\ResourceModel\BespokeInquiry\CollectionFactory $collectionFactory,
        array $meta = [],
        array $data = []
    ) { 
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        $this->collection = $collectionFactory->create();
    }


}
