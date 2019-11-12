<?php

namespace Brightowl\Bespoke\Controller\Adminhtml\Index;

class Index extends \Magento\Backend\App\Action
{
    
	protected $_resultPageFactory = false;
    protected $_resultPage;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->_resultPageFactory = $resultPageFactory;
    }

    /**
     * Index action
     *
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        $this->_setPageData();

        return $this->getResultPage();
    }

     public function getResultPage()
    {
        if (is_null($this->_resultPage)) {
            $this->_resultPage = $this->_resultPageFactory->create();
        }

        return $this->_resultPage;
    }

    protected function _setPageData()
    {
        $resultPage = $this->getResultPage();
        $resultPage->addBreadcrumb(__('Bespoke inquiries'), __('Bespoke inquiries'));
        $resultPage->addBreadcrumb(__('Bespoke inquiries'), __('Bespoke inquiries'));
        $resultPage->getConfig()->getTitle()->prepend(__('Bespoke inquiries'));


        return $this;
    }


}

?>