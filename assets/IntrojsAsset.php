<?php

namespace app\assets;

use yii\web\AssetBundle;

class IntrojsAsset extends AssetBundle{
    public $css = [
        '@npm/intro.js/minified/introjs.min.css'
    ];
    public $js = [
        '@npm/intro.js/minified/intro.min.js'
    ];
}

?>
