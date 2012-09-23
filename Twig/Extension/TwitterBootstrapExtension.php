<?php
/* vim: set expandtab tabstop=4 shiftwidth=4: */

/**
 * PHP version 5.3
 *
 * Copyright (c) 2012 GOTO Hidenori <hidenorigoto@gmail.com>,
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 *
 *     * Redistributions of source code must retain the above copyright
 *       notice, this list of conditions and the following disclaimer.
 *     * Redistributions in binary form must reproduce the above copyright
 *       notice, this list of conditions and the following disclaimer in the
 *       documentation and/or other materials provided with the distribution.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
 * AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
 * IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE
 * ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE
 * LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR
 * CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF
 * SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS
 * INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN
 * CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE)
 * ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 *
 * @package    XnniTwitterBootstrapBundle
 * @copyright  2012 GOTO Hidenori <hidenorigoto@gmail.com>
 * @license    http://www.opensource.org/licenses/bsd-license.php  New BSD License
 * @since      File available since Release 0.1.0
 */
namespace Xnni\Bundle\TwitterBootstrapBundle\Twig\Extension;

/**
 * @package    XnniTwitterBootstrapBundle
 * @copyright  2012 GOTO Hidenori <hidenorigoto@gmail.com>
 * @license    http://www.opensource.org/licenses/bsd-license.php  New BSD License
 * @since      Class available since Release 0.1.0
 */
class TwitterBootstrapExtension extends \Twig_Extension
{

    public function getFunctions()
    {
        return array(
            'tb_confirm_button'   => new \Twig_Function_Method($this, 'confirmButton', array('is_safe' => array('html'))),
            'tb_button'   => new \Twig_Function_Method($this, 'normalButton', array('is_safe' => array('html'))),
        );
    }

    public function normalButton($btnLabel, $okAction, $parameters = array())
    {
        $primary = (isset($parameters['primary'])) ? ' btn-primary' : '';
$ret = <<<DOC_END
    <a class="btn$primary" onClick="$okAction">$btnLabel</a>
DOC_END;

        return $ret;
    }

    public function confirmButton($btnLabel, $message, $okAction, $parameters = array())
    {
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

/*
 * Local Variables:
 * mode: php
 * coding: utf-8
 * tab-width: 4
 * c-basic-offset: 4
 * c-hanging-comment-ender-p: nil
 * indent-tabs-mode: nil
 * End:
 */
