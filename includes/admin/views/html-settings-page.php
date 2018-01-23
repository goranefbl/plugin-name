<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @since      1.0.0
 *
 */

?>
<div style="background-color:#985DC4;min-height:120px;margin-left:-20px;">
    <h1 style="color:#fff;margin:0;line-height:120px;margin-left:25px;"><?php _e('Title of the plugin','gens-raf'); ?></h1>
</div>
<div style="background-color:#fff;min-height:60px;margin-left:-20px;">
    <h2 style="color:#222;margin:0;line-height:60px;margin-left:25px;"><?php _e('Subtitle can go here.','gens-raf'); ?></h2>
</div>
<div class="wrap">
    <div id="poststuff">
        <div id="post-body" class="metabox-holder columns-2">
            <div id="postbox-container-2" class="postbox-container">
                <?php echo $html; ?>
            </div>
            <div id="postbox-container-1" class="postbox-container" style="margin-top:40px;">
                <div id="priority_side-sortables" class="meta-box-sortables ui-sortable">
                    <div class="postbox ">
                        <h3 class="hndle"><span><?php _e('Sidebar stuff','gens-raf'); ?></span></h3>
                        <div class="inside">
                            <p> More text goes here. </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
