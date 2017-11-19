<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       konradkrawczyk.com
 * @since      1.0.0
 *
 * @package    Tt_Social_Share
 * @subpackage Tt_Social_Share/admin/partials
 */
?>

<div class="wrap">

    <h2><?php echo esc_html(get_admin_page_title()); ?></h2>

    <form method="post" name="social_options" action="options.php">
      <?php

      $options = get_option($this->plugin_name);

      $displayFb = $options['displayFb'];
      $displayTw = $options['displayTw'];
      $displayGp = $options['displayGp'];
      $displayPi = $options['displayPi'];
      $displayLi = $options['displayLi'];
      $displayWa = $options['displayWa'];

      $btnSize = $options['btnSize'];
      $colorCode = $options['colorCode'];
      $btnOrder = $options['btnOrder'];

      $loop = $options['loop'];

      $displayUnderPost = $options['displayUnderPost'];
      $displayUnderThumb = $options['displayUnderThumb'];
      $displayLeft = $options['displayLeft'];
      $displayEnd = $options['displayEnd'];

      $order = explode(',', $this->ttsocialshare_options['btnOrder']);

      $loop = $options['loop'];
      $hideTitle = $options['hideTitle'];

      settings_fields($this->plugin_name);
      do_settings_sections($this->plugin_name);
      ?>

      <h3><?php esc_attr_e('Display buttons on following post types:', $this->plugin_name);?></h3>
      <?php
        $post_types = get_post_types();
          foreach ($post_types as $type){

            // $options['displayOn'][$type];

            ?>
            <fieldset>
                <legend class="screen-reader-text"><span><?php echo $type;?></span></legend>
                <label for="<?php echo $this->plugin_name.'-displayOn'.$type;?>">
                    <input type="checkbox" id="<?php echo $this->plugin_name.'-displayOn'.$type;?>" name="<?php echo $this->plugin_name.'[displayOn]['.$type.']';?>" value="1" <?php checked($options['displayOn'][$type], 1); ?>/>
                    <span><?php echo $type; ?></span>
                </label>
            </fieldset>
            <?php
          }
        ?>
      <h3><?php esc_attr_e('Display buttons for:', $this->plugin_name);?></h3>
        <!-- remove some meta and generators from the <head> -->
        <fieldset>
            <legend class="screen-reader-text"><span><?php _e('Display Facebook button', $this->plugin_name);?></span></legend>
            <label for="<?php echo $this->plugin_name; ?>-displayFb">
                <input type="checkbox" id="<?php echo $this->plugin_name; ?>-displayFb" name="<?php echo $this->plugin_name; ?>[displayFb]" value="1" <?php checked($displayFb, 1); ?>/>
                <span><?php esc_attr_e('Facebook', $this->plugin_name); ?></span>
            </label>
        </fieldset>

        <fieldset>
            <legend class="screen-reader-text"><span><?php _e('Display Twitter button', $this->plugin_name);?></span></legend>
            <label for="<?php echo $this->plugin_name; ?>-displayTw">
                <input type="checkbox" id="<?php echo $this->plugin_name; ?>-displayTw" name="<?php echo $this->plugin_name; ?>[displayTw]" value="1" <?php checked($displayTw, 1); ?>/>
                <span><?php esc_attr_e('Twitter', $this->plugin_name); ?></span>
            </label>
        </fieldset>

        <fieldset>
            <legend class="screen-reader-text"><span><?php _e('Display Google Plus button', $this->plugin_name);?></span></legend>
            <label for="<?php echo $this->plugin_name; ?>-displayGp">
                <input type="checkbox" id="<?php echo $this->plugin_name; ?>-displayGp" name="<?php echo $this->plugin_name; ?>[displayGp]" value="1" <?php checked($displayGp, 1); ?>/>
                <span><?php esc_attr_e('Google +', $this->plugin_name); ?></span>
            </label>
        </fieldset>

        <fieldset>
            <legend class="screen-reader-text"><span><?php _e('Display Pinterest button', $this->plugin_name);?></span></legend>
            <label for="<?php echo $this->plugin_name; ?>-displayPi">
                <input type="checkbox" id="<?php echo $this->plugin_name; ?>-displayPi" name="<?php echo $this->plugin_name; ?>[displayPi]" value="1" <?php checked($displayPi, 1); ?>/>
                <span><?php esc_attr_e('Pinterest', $this->plugin_name); ?></span>
            </label>
        </fieldset>

        <fieldset>
            <legend class="screen-reader-text"><span><?php _e('Display LinkedIn button', $this->plugin_name);?></span></legend>
            <label for="<?php echo $this->plugin_name; ?>-displayLi">
                <input type="checkbox" id="<?php echo $this->plugin_name; ?>-displayLi" name="<?php echo $this->plugin_name; ?>[displayLi]" value="1" <?php checked($displayLi, 1); ?>/>
                <span><?php esc_attr_e('LinkedIn', $this->plugin_name); ?></span>
            </label>
        </fieldset>

        <fieldset>
            <legend class="screen-reader-text"><span><?php _e('Display WhatsApp button (only on mobile)', $this->plugin_name);?></span></legend>
            <label for="<?php echo $this->plugin_name; ?>-displayWa">
                <input type="checkbox" id="<?php echo $this->plugin_name; ?>-displayWa" name="<?php echo $this->plugin_name; ?>[displayWa]" value="1" <?php checked($displayWa, 1); ?>/>
                <span><?php esc_attr_e('WhatsApp (on mobile)', $this->plugin_name); ?></span>
            </label>
        </fieldset>

      <h3><?php esc_attr_e('Choose size:', $this->plugin_name);?></h3>
        <!-- remove some meta and generators from the <head> -->
        <fieldset>
            <legend class="screen-reader-text"><span><?php _e('Small Buttons', $this->plugin_name);?></span></legend>
            <label for="<?php echo $this->plugin_name; ?>-btnSm">
                <input type="radio" id="<?php echo $this->plugin_name; ?>-btnSm" name="<?php echo $this->plugin_name; ?>[btnSize]" value="btnSm" <?php checked($btnSize, "btnSm"); ?>/>
                <div class="dispBtnS">S</div>
            </label>

            <legend class="screen-reader-text"><span><?php _e('Medium Buttons', $this->plugin_name);?></span></legend>
            <label for="<?php echo $this->plugin_name; ?>-btnMd">
                <input type="radio" id="<?php echo $this->plugin_name; ?>-btnMd" name="<?php echo $this->plugin_name; ?>[btnSize]" value="btnMd" <?php checked($btnSize, "btnMd"); ?>/>
                <div class="dispBtnM">M</div>
            </label>

            <legend class="screen-reader-text"><span><?php _e('Large Buttons', $this->plugin_name);?></span></legend>
            <label for="<?php echo $this->plugin_name; ?>-btnLg">
                <input type="radio" id="<?php echo $this->plugin_name; ?>-btnLg" name="<?php echo $this->plugin_name; ?>[btnSize]" value="btnLg" <?php checked($btnSize, "btnLg"); ?>/>
                <div class="dispBtnL">L</div>
            </label>
        </fieldset>

      <h3><?php esc_attr_e('Choose color:', $this->plugin_name);?></h3>
        <fieldset>
          <p><?php esc_attr_e('(leave blank for default colors)', $this->plugin_name); ?></p>
            <label for="<?php echo $this->plugin_name; ?>-colorCode">
                <legend class="screen-reader-text"><span><?php _e('Insert a color code', $this->plugin_name); ?></span></legend>
                <input type="text" placeholder="<?php _e('Insert a color code', $this->plugin_name); ?>" id="<?php echo $this->plugin_name; ?>-colorCode" name="<?php echo $this->plugin_name; ?>[colorCode]" value="<?php echo $colorCode;?>"/>
            </label>
        </fieldset>

      <h3><?php esc_attr_e('Choose where to display:', $this->plugin_name);?></h3>
        <fieldset>
            <legend class="screen-reader-text"><span><?php _e('Display buttons under post title', $this->plugin_name);?></span></legend>
            <label for="<?php echo $this->plugin_name; ?>-displayUnderPost">
                <input type="checkbox" id="<?php echo $this->plugin_name; ?>-displayUnderPost" name="<?php echo $this->plugin_name; ?>[displayUnderPost]" value="1" <?php checked($displayUnderPost, 1); ?>/>
                <span><?php esc_attr_e('Under post title', $this->plugin_name); ?></span>
            </label>
        </fieldset>

        <fieldset>
            <legend class="screen-reader-text"><span><?php _e('Display buttons under thumbnail', $this->plugin_name);?></span></legend>
            <label for="<?php echo $this->plugin_name; ?>-displayUnderThumb">
                <input type="checkbox" id="<?php echo $this->plugin_name; ?>-displayUnderThumb" name="<?php echo $this->plugin_name; ?>[displayUnderThumb]" value="1" <?php checked($displayUnderThumb, 1); ?>/>
                <span><?php esc_attr_e('Under thumbnail', $this->plugin_name); ?></span>
            </label>
        </fieldset>

        <fieldset>
            <legend class="screen-reader-text"><span><?php _e('Display buttons on the left area', $this->plugin_name);?></span></legend>
            <label for="<?php echo $this->plugin_name; ?>-displayLeft">
                <input type="checkbox" id="<?php echo $this->plugin_name; ?>-displayLeft" name="<?php echo $this->plugin_name; ?>[displayLeft]" value="1" <?php checked($displayLeft, 1); ?>/>
                <span><?php esc_attr_e('On the left area (floating)', $this->plugin_name); ?></span>
            </label>
        </fieldset>

        <fieldset>
            <legend class="screen-reader-text"><span><?php _e('Display buttons after post content', $this->plugin_name);?></span></legend>
            <label for="<?php echo $this->plugin_name; ?>-displayEnd">
                <input type="checkbox" id="<?php echo $this->plugin_name; ?>-displayEnd" name="<?php echo $this->plugin_name; ?>[displayEnd]" value="1" <?php checked($displayEnd, 1); ?>/>
                <span><?php esc_attr_e('After post content', $this->plugin_name); ?></span>
            </label>
        </fieldset>

        <h3><?php
          if (!empty($displayFb) || !empty($displayTw) || !empty($displayGp) || !empty($displayPi) || !empty($displayLi) || !empty($displayWa) ){
            esc_attr_e('Change the order of icons (drag and drop):', $this->plugin_name);
          }
        ?></h3>

        <ul id="sortable" class="tt-icon-ordering <?php echo $btnSize;?>">

        <?php
        $buttons = array(
    		    'tt-btn_1' => array('button' => '<li class="ui-state-default tt-btn btnFb" id="tt-btn_1" style="display:'.(!$displayFb ? 'none;' : 'inline-block').'"><i class="ion ion-social-facebook"></i></li>', 'display' => $displayFb),
    		    'tt-btn_2' => array('button' => '<li class="ui-state-default tt-btn btnTw" id="tt-btn_2" style="display:'.(!$displayTw ? 'none;' : 'inline-block').'"><i class="ion ion-social-twitter"></i></li>', 'display' => $displayTw),
    		    'tt-btn_3' => array('button' => '<li class="ui-state-default tt-btn btnGp" id="tt-btn_3" style="display:'.(!$displayGp ? 'none;' : 'inline-block').'"><i class="ion ion-social-googleplus"></i></li>', 'display' => $displayGp),
    				'tt-btn_4' => array('button' => '<li class="ui-state-default tt-btn btnPi" id="tt-btn_4" style="display:'.(!$displayPi ? 'none;' : 'inline-block').'"><i class="ion ion-social-pinterest"></i></li>', 'display' => $displayPi),
    		    'tt-btn_5' => array('button' => '<li class="ui-state-default tt-btn btnLi" id="tt-btn_5" style="display:'.(!$displayLi ? 'none;' : 'inline-block').'"><i class="ion ion-social-linkedin"></i></li>', 'display' => $displayLi),
    		    'tt-btn_6' => array('button' => '<li class="ui-state-default tt-btn btnWa" id="tt-btn_6" style="display:'.(!$displayWa ? 'none;' : 'inline-block').'"><i class="ion ion-social-whatsapp"></i></li>', 'display' => $displayWa)
    		);

    		foreach ($order as $key){
    				echo $buttons[$key]['button'];
    		}
        ?>
          </ul>

        <input type="hidden" id="btnOrder" name="<?php echo $this->plugin_name; ?>[btnOrder]" value="<?php echo $btnOrder;?>">

      <h3><?php esc_attr_e('Additional settings:', $this->plugin_name);?></h3>

        <fieldset>
            <legend class="screen-reader-text"><span><?php _e('Display buttons under pages in the post loop (if unchecked, buttons will only show on single posts)', $this->plugin_name);?></span></legend>
            <label for="<?php echo $this->plugin_name; ?>-loop">
                <input type="checkbox" id="<?php echo $this->plugin_name; ?>-loop" name="<?php echo $this->plugin_name; ?>[loop]" value="1" <?php checked($loop, 1); ?>/>
                <span><?php esc_attr_e('Display buttons in the post loop (if unchecked, buttons will only show on single posts)', $this->plugin_name); ?></span>
            </label>
        </fieldset>

        <fieldset>
            <legend class="screen-reader-text"><span><?php _e('Hide title "SHARE:" before buttons', $this->plugin_name);?></span></legend>
            <label for="<?php echo $this->plugin_name; ?>-hideTitle">
                <input type="checkbox" id="<?php echo $this->plugin_name; ?>-hideTitle" name="<?php echo $this->plugin_name; ?>[hideTitle]" value="1" <?php checked($hideTitle, 1); ?>/>
                <span><?php esc_attr_e('Hide title "SHARE:" before buttons', $this->plugin_name); ?></span>
            </label>
        </fieldset>

        <?php submit_button(__('Save all changes', $this->plugin_name), 'primary', 'submit', TRUE); ?>

    </form>

</div>
