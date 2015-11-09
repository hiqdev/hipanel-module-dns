<?php

namespace hipanel\modules\dns\widgets;

use Closure;
use hipanel\helpers\ArrayHelper;
use hipanel\widgets\Pjax;
use Yii;
use yii\base\Widget;
use yii\bootstrap\Progress;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\web\JsExpression;

/**
 * Class DnzZoneEditWidget offers a placeholder for PJAX loader
 * @package hipanel\modules\dns\widgets
 */
class DnsZoneEditWidget extends Widget
{
    /**
     * @var integer ID of domain
     */
    public $domainId;

    /**
     * @var array options for [[Pjax]] widget
     */
    public $pjaxOptions = [];

    /**
     * @var array options for [[Progress]] widget
     */
    public $progressOptions = [];

    /**
     * @var Closure
     */
    public $clientScriptWrap;

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        $this->pjaxOptions = ArrayHelper::merge([
            'id' => 'dns_zone_view',
            'enablePushState' => false,
            'enableReplaceState' => false,
        ], $this->pjaxOptions);

        $this->progressOptions = ArrayHelper::merge([
            'id' => 'progress-bar',
            'percent' => 100,
            'barOptions' => ['class' => 'active progress-bar-striped', 'style' => 'width: 100%'],
        ], $this->progressOptions);
    }

    /**
     * @return string the URL
     */
    public function buildUrl()
    {
        return Url::to(['@dns/zone/view', 'id' => $this->domainId]);
    }

    /**
     * Registers JS
     */
    public function registerClientScript()
    {
        $id = $this->pjaxOptions['id'];
        $url = Json::htmlEncode($this->buildUrl());
        $js = "
            $.pjax({
                url: $url,
                push: false,
                replace: false,
                container: '#$id',
            });
            $('#$id').on('pjax:error', function (event, xhr, textStatus, error, options) {
                $(this).text(xhr.responseText);
            });
        ";
        if ($this->clientScriptWrap instanceof Closure) {
            $js = call_user_func($this->clientScriptWrap, $js);
        }

        Yii::$app->view->registerJs($js);
    }

    /**
     * {@inheritdoc}
     */
    public function run()
    {
        Pjax::begin($this->pjaxOptions);
        echo Progress::widget($this->progressOptions);
        $this->registerClientScript();
        Pjax::end();
    }
}