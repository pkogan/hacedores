<?php

namespace app\assets;

use yii\web\AssetBundle;

class IntrojsAsset extends AssetBundle{
    public $sourcePath = '@npm/intro.js/minified';
    public $css = [
        'introjs.min.css'
    ];
    public $js = [
        'intro.min.js'
    ];
}

?>
