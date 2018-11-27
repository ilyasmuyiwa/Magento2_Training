<?php
/**
 * Created by PhpStorm.
 * User: liyassoladogun
 * Date: 11/26/18
 * Time: 5:00 PM
 */

namespace Training\S7v5\Console\Command;

use Magento\CatalogRule\Model\Rule\Condition\Combine;
use Magento\Framework\ObjectManagerInterface;
use Magento\CatalogRule\Api\Data\RuleInterfaceFactory;
use \Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use \Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use \Symfony\Component\Console\Output\OutputInterface;
use Magento\CatalogRule\Api\CatalogRuleRepositoryInterface;
use Magento\CatalogRule\Api\Data\ConditionInterfaceFactory;
use Magento\Framework\App\State;
use Magento\CatalogRule\Model\Rule\Job;

class SkuRule extends Command
{
    const RULE_DESCRIPTION = 'Custom rule Programmatically';

    const RULE_NAME ='Custom RULE';

    const SKU_RULE_NAME = ' SKU Rule Name';

    const SKU_ARGUMENT = 'sku';

    const WEBSITE_ARGUMENT = 'websites';

    const IS_ACTIVE_ARGUMENT = 'is_active';

    const DISCOUNT_AMOUNT_ARGUMENT = 'discount_amount';

    const CUSTOMER_GROUP_ARGUMENT = 'customer_group';

    protected $rule;

    protected $catalogRuleRepository;

    protected $ruleInterfaceFactory;

    protected $job;

    protected $state;

    public function __construct(
        State $state,
        RuleInterfaceFactory $rule,
        CatalogRuleRepositoryInterface $catalogRuleRepository,
        Job $job
    )
    {
        $this->state = $state;
        $this->rule = $rule;
        $this->catalogRuleRepository = $catalogRuleRepository;
        $this->job = $job;
        parent::__construct();
    }

    protected function configure()
    {
        $this->setName('rule')
            ->setDescription('Rule');
        $this->setDefinition([
            new InputArgument(
                self::SKU_ARGUMENT,
                InputArgument::REQUIRED,
                self::SKU_ARGUMENT
            ),
            new InputOption(
                self::IS_ACTIVE_ARGUMENT,
                '-a',
                InputOption::VALUE_REQUIRED,
               self::IS_ACTIVE_ARGUMENT
            ),
            new InputOption(
                self::DISCOUNT_AMOUNT_ARGUMENT,
                '-d',
                InputOption::VALUE_REQUIRED,
                self::DISCOUNT_AMOUNT_ARGUMENT
            ),

            new InputOption(
                self::WEBSITE_ARGUMENT,
                '-w',
                InputOption::VALUE_REQUIRED,
                self::WEBSITE_ARGUMENT.' Should be comma separated'
            ),
            new InputOption(
                self::CUSTOMER_GROUP_ARGUMENT,
                '-c',
                InputOption::VALUE_REQUIRED,
                self::CUSTOMER_GROUP_ARGUMENT.' Should be comma separated'
            ),
        ]);

        parent::configure();
    }

    public function execute(InputInterface $input, OutputInterface $output) {

        $output->writeln("<info>Start.....</info>");
        $this->state->setAreaCode(\Magento\Framework\App\Area::AREA_ADMINHTML);
        $model = $this->rule->create();

        $model->setName(self::SKU_RULE_NAME)
            ->setDescription(self::RULE_DESCRIPTION)
            ->setIsActive($input->getOption(self::IS_ACTIVE_ARGUMENT));
            $model->setDiscountAmount($input->getOption(self::DISCOUNT_AMOUNT_ARGUMENT))
                ->setCustomerGroupIds(array(1))
                ->setSimpleAction(\Magento\SalesRule\Model\Rule::BY_PERCENT_ACTION)
                ->setWebsiteIds(explode(',', $input->getOption(self::WEBSITE_ARGUMENT)));
            $conditions = [];
            $conditions['1'] = [
                'type' => Combine::class,
                'aggregator' => 'all',
                'value' => 1,
                'new_child' =>''
            ];

        $conditions['1--1'] = [
            'type' => \Magento\CatalogRule\Model\Rule\Condition\Product::class,
            'attribute' => 'sku',
            'operator' => '()',
            'value' => $input->getArgument(self::SKU_ARGUMENT)
            ];

        $model->setData('conditions', $conditions);
        $model->loadPost($model->getData());
        $model->save();

        $this->job->applyAll();
        $output->writeln("<info>Done.....</info>");
    }
}