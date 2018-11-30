<?php
/**
 * Created by PhpStorm.
 * User: liyassoladogun
 * Date: 11/28/18
 * Time: 8:08 PM
 */

namespace Training\S8v1\Observer\Cart;


use Magento\Catalog\Model\Product;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Event\ObserverInterface;
use Magento\Quote\Model\Quote\Item;
use Magento\Checkout\Model\Session;

class AddCustomOption implements ObserverInterface
{

    protected $request;
    protected $checkoutSession;
    public function __construct(
        Session $session,
        RequestInterface $request
    )
    {    $this->checkoutSession = $session;
        $this->request = $request;
    }

    private function generateWinningNumbers() {
        $winningNumbers = [];
        $winNum = rand(1, 10);

        if (!in_array($winNum, $winningNumbers)) {
            $winningNumbers[] = $winNum;
        }

        return $winningNumbers;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        /** @var Product $product */
        $product = $observer->getProduct();
        $lottery = [];
        $lottery[] = [
            "label" => "Discount Numbers",
            "value" => $this->generateWinningNumbers()
        ];

        $product->addCustomOption('additional_options', serialize($lottery));


    }

}