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
        );
    }

    public function confirmButton($btnLabel, $message, $okAction, $parameters = array()) {
        $primary = (isset($parameters['primary'])) ? ' primary' : '';
        $uniq = uniqid();
$ret = <<<DOC_END
    <input type="button" class="btn$primary" value="$btnLabel" data-controls-modal="$uniq" data-backdrop="true" data-keyboard="true">
    <div id="$uniq" class="modal hide fade">
      <div class="modal-header">$btnLabel の確認</div>
      <div class="modal-body">$message</div>
      <div class="modal-footer">
        <input type="button" class="btn primary" value="$btnLabel" onClick="$okAction">
        <input type="button" class="btn" value="キャンセル" onClick="$('#$uniq').modal('hide');">
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

