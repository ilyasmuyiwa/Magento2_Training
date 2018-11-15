<?php
/**
 * Created by PhpStorm.
 * User: liyassoladogun
 * Date: 11/15/18
 * Time: 8:15 PM
 */

namespace Training\S2v3\Controller\Api;


use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;
use \Magento\Framework\HTTP\ZendClientFactory;
use Magento\Store\Model\StoreManagerInterface;

class Rest extends Action
{
    /** @var ZendClientFactory */
   private $clientFactory;

    /**
     * @var JsonFactory
     */
   private $jsonFactory;

   /** @var StoreManagerInterface */
   private $storeManager;

   public function __construct(Context $context,
                               ZendClientFactory $clientFactory,
                 JsonFactory $jsonFactory,
                StoreManagerInterface $storeManager)
   {
       $this->clientFactory = $clientFactory;
       $this->jsonFactory = $jsonFactory;
       $this->storeManager = $storeManager;
       parent::__construct($context);
   }

   public function execute()
   {
     $client = $this->clientFactory->create();
     $params = [
         'info' => ['firstname' => 'ilyas', 'lastname' => 'soladogun'],
         'id' => 4
     ];

     $url = sprintf('%srest/V1/helloapi', $this->storeManager->getStore()->getBaseUrl());
     //$url .= '?' .http_build_query($params);
    // $client->get($url);
     $client->setUri($url);
       $client->setRawData(json_encode($params));
       $client->setHeaders(['Content-Type: application/json', 'Accept: application/json']);
       $client->setMethod(\Zend_Http_Client::POST);
     $response = $client->request()->getBody();

     return $this->jsonFactory->create()->setData([$response]);
   }
}