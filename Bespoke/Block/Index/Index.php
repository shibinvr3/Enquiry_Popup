<?php

namespace Brightowl\Bespoke\Block\Index;


class Index extends \Magento\Framework\View\Element\Template {

	/**
     * @var StoreManager
     */
	protected $_storeManager;
    
    /**
     * @var UrlInterface
     */
    protected $_urlInterface;
    /**
     * @param \Magento\Backend\Block\Widget\Context $context
     * @param \Magento\Framework\Data\Form\FormKey $formKey
     * @param array $data
     */
    public function __construct(
    	\Magento\Catalog\Block\Product\Context $context, 
    	\Magento\Store\Model\StoreManagerInterface $storeManager,
    	\Magento\Framework\Data\Form\FormKey $formKey,
        \Magento\Framework\UrlInterface $urlInterface, 
    	array $data = []){
    	$this->_storeManager = $storeManager;
    	$this->formKey = $formKey;
        $this->_urlInterface = $urlInterface;
        parent::__construct($context, $data);

    }
    protected function _prepareLayout()
    {
        return parent::_prepareLayout();
    }
    /**
     * get ajax url
     *
     * @return string
     */
    public function getInquiryUrl(){
    	return $this->_urlInterface->getUrl('bespoke/index');
    }

    /**
     * get form key
     *
     * @return string
     */
    public function getFormKey()
    {
         return $this->formKey->getFormKey();
    }
}