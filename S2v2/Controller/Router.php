<?php
/**
 * Created by PhpStorm.
 * User: liyassoladogun
 * Date: 11/14/18
 * Time: 5:59 PM
 */

namespace Training\S2v2\Controller;


use Magento\Framework\App\ActionFactory;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\RouterInterface;

class Router implements RouterInterface
{
    private $actionFactory;
    public function __construct(ActionFactory $actionFactory)
    {
        $this->actionFactory = $actionFactory;
    }

    public function match(RequestInterface $request)
    {

        try {
            $originalPathInfo = trim($request->getPathInfo(), '/');
            $originalPathParts = explode('/', $originalPathInfo);
            $originalIdentifier = array_pop($originalPathParts);
            $pageParts = explode('-', $originalIdentifier);

            if (count($pageParts) > 1) {
                $sortDir = array_pop($pageParts);
                $suffixAr = explode('-', $sortDir);
                $sortDir = $suffixAr[0];
                if (isset($suffixAr[1])) {
                    $suffix = sprintf('.%s', $suffixAr[1]);
                    $sortBy = array_pop($pageParts);
                    //remove sort by keys

                    $key = array_search('sort', $pageParts);
                    unset($pageParts[$key]);
                    $key = array_search('by', $pageParts);
                    unset($pageParts[$key]);

                    //left with orginal identifier
                    $identifier = implode('-', $pageParts);

                    //get original path element for appending
                    $categoryPath = implode('/', $originalPathParts);
                    $newPath = $categoryPath . '/' .$identifier . $suffix;

                    $requestParams = ['product_list_dir' => $sortDir, 'product_list_order' => $sortBy];
                    $request->setPathInfo($newPath);
                    $request->setParams($requestParams);
                    return $this->actionFactory->create(\Magento\Framework\App\Action\Forward::class, ['request' => $request]);
                }


            }

        } catch (\Exception $e) {
            $writer = new \Zend\Log\Writer\Stream(BP . '/var/log/newurlrewrite.log');
            $logger = new \Zend\Log\Logger();
            $logger->addWriter($writer);
            $logger->info($e->getMessage());
        }

    }
}