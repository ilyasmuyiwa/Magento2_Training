<?php
/**
 * Created by PhpStorm.
 * User: liyassoladogun
 * Date: 11/16/18
 * Time: 1:28 PM
 */

namespace Training\S3v2\App\View\Template\Engine;


use Magento\Framework\View\TemplateEngineInterface;

class Html implements TemplateEngineInterface
{

    protected $currentBlock;

 public function render(\Magento\Framework\View\Element\BlockInterface $block,
                        $fileName,
                        array $dictionary = [])
 {
    $this->currentBlock = $block;
    $output = file_get_contents($fileName);
    return $output;

 }
}