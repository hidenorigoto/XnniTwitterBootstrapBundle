<?php
namespace Xnni\Bundle\TwitterBootstrapBundle\Twig\Extension;

/**
 * @author hidenorigoto@gmail.com
 */
class TwitterBootstrapExtension extends \Twig_Extension {

    public function getFunctions()
    {
        return array(
            'tb_confirm_button'   => new \Twig_Function_Method($this, 'confirmButton', array('is_safe' => array('html'))),
            'tb_button'   => new \Twig_Function_Method($this, 'normalButton', array('is_safe' => array('html'))),
        );
    }

    public function normalButton($btnLabel, $okAction, $parameters = array()) {
        $primary = (isset($parameters['primary'])) ? ' btn-primary' : '';
$ret = <<<DOC_END
    <a class="btn$primary" onClick="$okAction">$btnLabel</a>
DOC_END;
        return $ret;
    }

    public function confirmButton($btnLabel, $message, $okAction, $parameters = array()) {
        $primary = (isset($parameters['primary'])) ? ' btn-primary' : '';
        $uniq = uniqid();
$ret = <<<DOC_END
    <a class="btn$primary" data-toggle="modal" href="#$uniq" data-backdrop="false" data-keyboard="true">$btnLabel</a>
    <div id="$uniq" class="modal hide">
      <div class="modal-header">$btnLabel の確認</div>
      <div class="modal-body">$message</div>
      <div class="modal-footer">
        <a class="btn btn-primary" onClick="$okAction">$btnLabel</a>
        <a class="btn" onClick="$('#$uniq').modal('hide');">キャンセル</a>
      </div>
    </div>
DOC_END;
        return $ret;
    }

    public function getName()
    {
        return 'twitter_bootstrap_extension';
    }
}

