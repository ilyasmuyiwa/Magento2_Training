<?php
/**
 * Created by PhpStorm.
 * User: liyassoladogun
 * Date: 11/26/18
 * Time: 2:09 PM
 */

namespace Training\S7v3\Console\Command;
use Magento\Framework\App\State;
use Magento\Framework\ObjectManagerInterface;
use \Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use \Symfony\Component\Console\Input\InputInterface;
use \Symfony\Component\Console\Output\OutputInterface;
use Magento\Catalog\Api\ProductTierPriceManagementInterface;

class TierPrice extends Command
{
    const SKU_ARGUMENT = 'sku';

    const QTY_ARGUMENT = 'qty';

    const PRICE_ARGUMENT = 'price';
    protected $tierPriceManagement;

    private $state;
    protected $objectManager;
    private $logger;
    protected function configure()
    {
        $this->setName('tierprice')
            ->setDescription('Tier Price');
        $this->setDefinition([
                new InputArgument(
                    self::SKU_ARGUMENT,
                    InputArgument::REQUIRED,
                    'product sku'
                ),
            new InputArgument(
                self::PRICE_ARGUMENT,
                InputArgument::REQUIRED,
                'product Price'
            ),
                new InputArgument(
                    self::QTY_ARGUMENT,
                    InputArgument::REQUIRED,
                    'product qty'
                )
        ]);

        parent::configure();
    }
    public function __construct(
       ProductTierPriceManagementInterface $priceManagement,
        State $state
    ) {
        $this->tierPriceManagement = $priceManagement;
        $this->state = $state;
        parent::__construct();
    }


    public function execute(InputInterface $input, OutputInterface $output)
    {
      $output->writeln("<info>Importing</info>");

        $sku = $input->getArgument(self::SKU_ARGUMENT);
        $price = $input->getArgument(self::PRICE_ARGUMENT);
        $qty = $input->getArgument(self::QTY_ARGUMENT);
        $this->state->setAreaCode(\Magento\Framework\App\Area::AREA_ADMINHTML);
        $this->tierPriceManagement->add($sku, 0, $price, $qty);
        $output->writeln("<info>Success</info>");

      return \Magento\Framework\Console\Cli::RETURN_SUCCESS;
    }
}