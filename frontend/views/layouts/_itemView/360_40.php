<?php
use yii\helpers\Html;


$isoCss = '';
$imgFormat = ($proportion == 'proportion-different') ? array_rand($formatArray) : ((!$format) ? 'format-box' : $format);
$imgSrc = "/images/grid-{$size}-{$imgFormat}.jpg";
$imgCss = [];
$imgParams = [
    'alt'   => Html::encode($model['caption']),
    'class' => 'visible-lg-block',
];
if ($type == 'type-tile') {
    $isoCss = " mr{$distance}px mb40px";
    $w = $sizeInt;
    $oneThree = $sizeInt / 3;
    if ($proportion == 'proportion-different') {
        switch ($imgFormat) {
            case 'format-vertical':
                $h = $sizeInt + $oneThree;
                break;
            case 'format-horisontal':
                $h = $sizeInt - $oneThree;
                break;
            case 'format-box':
                $h = $sizeInt;
                break;
        }
    } else {
        switch ($format) {
            case 'format-vertical':
                $h = $sizeInt + $oneThree;
                break;
            case 'format-horisontal':
                $h = $sizeInt - $oneThree;
                break;
            case 'format-box':
            default:
                $h = $sizeInt;
        }
    }
} elseif ($type == 'type-tile-room') {
    $imgCss[] = 'w100pc';
    if ($proportion == 'proportion-different') {

    }
}

if ($proportion == 'proportion-tile') {
    if ($type == 'type-tile') {
        $h = $sizeInt;
        if ($index < 3) {
            $w2x = $sizeInt * 2 + $distance;
            $h2x = $sizeInt * 2 + 40 + (($caption == 'outside') ? 32 + ($captionDesc ? 22 : 0) : 0);
            switch ($index) {
                case 0:
                    $imgParams['width'] = $w2x;
                    $imgParams['height'] = $h2x;
                    break;
                case 1:
                    $imgParams['width'] = $w;
                    $imgParams['height'] = $h2x;
                    break;
                case 2:
                    $imgParams['width'] = $w2x;
                    $imgParams['height'] = $h;
                    break;
            }
            $imgCss[] = 'hidden-lg';
        }
    } elseif ($type == 'type-tile-room') {
        if ($index < 3) {
            $imgParams['class'] .= ' w100pc';
            switch ($index) {
                case 0:
                    $isoCss = " w2x";
                    break;
                case 1:
                    break;
                case 2:
                    $isoCss = " w2x";
                    break;
            }
            $imgCss[] = 'hidden-lg';
        }
    }
}
?>
<div class="iso-item pull-left relative<?=$isoCss;?>">
    <?if ($model['preview']):?>
        <img src="/images/3.jpg" alt="<?=Html::encode($model['caption'])?>">
    <?else:
        if (($proportion == 'proportion-tile') && ($index < 3)) {
            echo Html::img($imgSrc, $imgParams);
        }
        echo Html::img($imgSrc, [
            'alt'    => Html::encode($model['caption']),
            'width'  => isset($w) ? $w : '',
            'height' => isset($h) ? $h : '',
            'class'  => count($imgCss) ? implode(' ', $imgCss) : '',
        ])?>
    <?endif;?>
    <?switch ($caption):
        case 'inside':?>
        <div class="absolute top0 bottom0 left0 right0">
            <div class="table h100pc mb0 p0-15 bg0_4">
                <div class="table-cell middle text-center">
                    <h4 class="mt0"><a class="cf" href="grid_same_large_360x240.html"><?=Html::encode($model['caption'])?></a></h4>
                    <?if ($captionDesc):?>
                        <p class="cf lh22 mb0"><?=Html::encode($model['description'])?></p>
                    <?endif;?>
                </div>
            </div>
        </div>
        <?break;
        case 'inside-hover':?>
        <div class="hover-block absolute top0 bottom0 left0 right0">
            <div class="hide table hover-inner h100pc mb0 p0-15 bg0_4">
                <div class="table-cell middle text-center">
                    <h4 class="mt0"><a class="cf" href="grid_same_large_360x240.html"><?=Html::encode($model['caption'])?></a></h4>
                    <?if ($captionDesc):?>
                            <p class="cf lh22 mb0"><?=Html::encode($model['description'])?></p>
                    <?endif;?>
                </div>
            </div>
        </div>
        <?break;
        case 'outside':?>
            <h4><a href="grid_same_large_360x240.html"><?=Html::encode($model['caption'])?></a></h4>
            <?if ($captionDesc):?>
                <div class="desc"><div class="inner"><?=Html::encode($model['description'])?></div></div>
            <?endif;?>
        <?break;
    endswitch;?>
</div>