<?php
/**
 * Created by PhpStorm.
 * User: liyassoladogun
 * Date: 11/23/18
 * Time: 7:49 AM
 */

namespace Training\S6v1\Console\Command;


use Magento\Store\Model\WebsiteRepository;
use \Symfony\Component\Console\Command\Command;
use \Symfony\Component\Console\Input\InputInterface;
use \Symfony\Component\Console\Output\OutputInterface;

class ConfigSetting extends Command
{
    protected $scopeConfig;
    private $logger;
    protected $websiteRepository;
    protected function configure()
    {
        $this->setName('s6v1')
            ->setDescription('Config');

        parent::configure();
    }
    public function __construct(
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        WebsiteRepository $websiteRepository,
        \Psr\Log\LoggerInterface $logger

    ) {
        $this->websiteRepository = $websiteRepository;
        $this->scopeConfig = $scopeConfig;
        $this->logger = $logger;
        parent::__construct();
    }
    public function execute(InputInterface $input, OutputInterface $output)
    {


        $values = [];
        $path = 'general\store_information\name';
        $values['global'] = $this->scopeConfig->getValue($path);
           foreach ($this->websiteRepository->getList() as $website){
               $values['website'][] = $this->scopeConfig->getValue($path, 'website', $website->getId());
           }

           $outputString = print_r($values, true);

           $output->writeln($outputString);
    }
}