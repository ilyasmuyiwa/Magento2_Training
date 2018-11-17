<?php
/**
 * Created by PhpStorm.
 * User: liyassoladogun
 * Date: 11/16/18
 * Time: 1:32 PM
 */

namespace Training\S3v2\App\View\Design\FallBack;


use Magento\Framework\View\Design\Fallback\Rule;

class RulePool extends \Magento\Framework\View\Design\Fallback\RulePool
{

    protected $filesystem;
    private $simpleFactory;
    private $themeFactory;

    /**
     * Factory for modular switcher
     *
     * @var Rule\ModularSwitchFactory
     */
    private $modularSwitchFactory;

    /**
     * Factory for module rule
     *
     * @var Rule\ModuleFactory
     */
    private $moduleFactory;


    public function __construct(\Magento\Framework\Filesystem $filesystem, Rule\SimpleFactory $simpleFactory, Rule\ThemeFactory $themeFactory, Rule\ModuleFactory $moduleFactory, Rule\ModularSwitchFactory $modularSwitchFactory)
    {
        $this->filesystem = $filesystem;
        $this->simpleFactory = $simpleFactory;
        $this->themeFactory = $themeFactory;
        $this->moduleFactory = $moduleFactory;
        $this->modularSwitchFactory = $modularSwitchFactory;
        parent::__construct($filesystem, $simpleFactory, $themeFactory, $moduleFactory, $modularSwitchFactory);
    }

    protected function createTemplateFileRule()
    {
        return $this->modularSwitchFactory->create(
            ['ruleNonModular' =>
                $this->themeFactory->create(
                    ['rule' => $this->simpleFactory->create(['pattern' => "<theme_dir>/templates"])]
                ),
                'ruleModular' => new Rule\Composite(
                    [
                        $this->themeFactory->create(
                            ['rule' => $this->simpleFactory->create(['pattern' => "<theme_dir>/<module_name>/templates"])]
                        ),
                        $this->moduleFactory->create(
                            ['rule' => $this->simpleFactory->create(['pattern' => "<module_dir>/view/<area>/templates"])]
                        ),
                        $this->moduleFactory->create(
                        ['rule' => $this->simpleFactory->create(['pattern' => "<module_dir>/view/<area>/banners"])]
                        ),

                        $this->moduleFactory->create(
                            ['rule' => $this->simpleFactory->create(['pattern' => "<module_dir>/view/base/templates"])]
                        ),
                    ]
                )]
        );
    }
}