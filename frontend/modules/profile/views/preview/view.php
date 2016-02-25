<?php
use app\models\Site;
?>
<div class="<?=($site['grid_type'] == 'type-tile') ? "mr-{$site['grid_distance']}px" : '';?><?=(in_array($site['grid_proportion'], ['proportion-tile', 'proportion-different'])) ? ' isotope' : '';?>">
    <?foreach ($data as $index => $item) {
        echo $this->render('//layouts/_itemView/360_40', [
            'model'       => $item,
            'index'       => $index,
            'type'        => $site['grid_type'],
            'proportion'  => $site['grid_proportion'],
            'size'        => $site['grid_size'],
            'sizeInt'     => Site::$size2int[$site['grid_type']][$site['grid_size']],
            'format'      => $site['grid_format'],
            'formatArray' => Site::$gridFormat,
            'distance'    => intval($site['grid_distance']),
            'caption'     => $site['grid_caption'],
            'captionDesc' => $site['grid_caption_desc'],
            ''
        ]);
    }?>
</div>