<?php
namespace Brightowl\Bespoke\Controller\Index;
use Brightowl\Bespoke\Model\BespokeInquiry;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NotFoundException;
use Magento\Framework\Exception\InputException;
/**
 * Class Bespoke
 * @package Brightowl\Bespoke\Controller\Index
 */
class Index extends \Magento\Framework\App\Action\Action
{

	/**
     * @var bespokeInquiry
     */
	protected $_bespokeInquiry;
	 /**
     * @var resultRedirect
     */
    protected $resultRedirect;
   
   	/**
     * @var formKeyValidator
     */
    protected $formKeyValidator;

    /**
     * @var messageManager
     */
    protected $messageManager;

    /**
     * @var storeManager
     */
    protected $_storeManager;

    public function __construct(\Magento\Framework\App\Action\Context $context,
    \Magento\Store\Model\StoreManagerInterface $storeManager,      
    \Magento\Framework\Data\Form\FormKey\Validator $formKeyValidator,
    \Magento\Framework\Message\ManagerInterface $messageManager,	
    \Brightowl\Bespoke\Model\BespokeInquiry $bespokeInquiry){
        parent::__construct($context);
        $this->_storeManager = $storeManager;
        $this->formKeyValidator = $formKeyValidator;
        $this->_bespokeInquiry = $bespokeInquiry;
        $this->messageManager = $messageManager;
    }
     /**
     * Inquiry Form submit
     */
    public function execute()
    {
        $response = [];
        if(!$this->getRequest()->isPost()&&!$this->getRequest()->isAjax()) {
           throw new NotFoundException(__('Page not found.'));
        }
        try{
            $this->validatedParams();
            $post = $this->getRequest()->getPostValue();
            $this->_bespokeInquiry->addData([
                "name" => $post['name'],
                "email" => $post['email'],
                "phone" => $post['phone'],
                "description" => $post['description'],
                "from_date" => $post['from_date'],
                "to_date" => $post['to_date'],
                "venue" => $post['venue'],
                "event_size" => $post['event_size'],
                "budget_range" =>  $post['budget_range'],
                "flowers_of_choice" => $post['flowers_of_choice'],
                "invoicing_information" => $post['invoicing_information'],
                "store_id" => $this->getStoreId(),
                "is_active" => true
                ]);
            $saveData = $this->_bespokeInquiry->save();
            if($saveData){
                $response['types'] = 'mage-success';
                $response['message'] = __('Your request submitted successfully');
            }
        }catch (\Exception $e) {
            $response['types'] = 'mage-error';
            $response['message'] = $e->getMessage();
        }
        return $this->getResponse()->setContent(json_encode($response));
    }
    /**
     * Get website identifier
     *
     * @return string|int|null
     */
    public function getStoreId()
    {
        return $this->_storeManager->getStore()->getId();
    }
     /**
     * Validate form
     * @return error exception
     */
    private function validatedParams()
    {
        $request = $this->getRequest();
        if(!$this->formKeyValidator->validate($request)){
        	 throw new InputException(__('Invalid form key'));
        }
        if (trim($request->getParam('name')) === '') {
            throw new InputException(__('Name is missing'));
        }
        if (trim($request->getParam('email')) === '') {
            throw new InputException(__('email is missing'));
        }
        if (false === \strpos($request->getParam('email'), '@')) {
            throw new InputException(__('Invalid email address'));
        }
        if (trim($request->getParam('phone')) === '') {
            throw new InputException(__('Phone number is missing'));
        }
        //Add your more validations here
        return $request->getParams();
    }

}