<div id="postbox-container-1" class="<?php echo FrmAppController::get_postbox_class(); ?>">
    <div id="submitdiv" class="postbox ">
    <h3 class="hndle"><span><?php _e('Publish', 'formidable') ?></span></h3>
    <div class="inside">
        <div class="submitbox">
        <div id="minor-publishing" style="border:none;">
        <div class="misc-pub-section">
            <?php 
            if($record->is_draft)
                echo FrmProFormsHelper::get_draft_button($form, 'button-secondary'); 
            
            if($record->post_id){ ?>
            <a href="<?php echo get_permalink($record->post_id) ?>" class="button-secondary alignright" style="margin-left:10px"><?php _e('View Post', 'formidable') ?></a>
            <?php } ?>
            <a href="?page=formidable-entries&amp;frm_action=show&amp;id=<?php echo $record->id; ?>" class="button-secondary alignright"><?php _e('View', 'formidable') ?></a>
            <a href="?page=formidable-entries&amp;frm_action=duplicate&amp;form=<?php echo $form->id ?>&amp;id=<?php echo $record->id; ?>" class="button-secondary alignright" style="margin-right:10px"><?php _e('Duplicate', 'formidable') ?></a>
            <div class="clear"></div>

            <p class="howto" style="margin-top:10px;">
            <?php FrmProEntriesHelper::resend_email_links($record->id, $form->id); ?>
            </p>
            <?php do_action('frm_edit_entry_publish_box', $record); ?>
        </div>
        </div>
        
        <div id="major-publishing-actions">
            <?php if ( current_user_can('frm_delete_entries') ) { ?>
    	    <div id="delete-action">
    	    <a class="submitdelete deletion" href="?page=formidable-entries&amp;frm_action=destroy&amp;id=<?php echo $record->id; ?>&amp;form=<?php echo $form->id ?>" onclick="return confirm('<?php _e('Are you sure you want to delete this entry?', 'formidable') ?>');" title="<?php _e('Delete') ?>"><?php _e('Delete') ?></a>
    	    <?php if(!empty($record->post_id)){ ?>
    	    <a class="submitdelete deletion" style="margin-left:10px;" href="?page=formidable-entries&amp;frm_action=destroy&amp;id=<?php echo $record->id; ?>&amp;form=<?php echo $form->id ?>&amp;keep_post=1" onclick="return confirm('<?php _e('Are you sure you want to delete this entry?', 'formidable') ?>');" title="<?php _e('Delete entry but leave the post', 'formidable') ?>"><?php _e('Delete without Post', 'formidable') ?></a>
    	    <?php } ?>
    	    </div>
    	    <?php } ?>
    	    <div id="publishing-action">
    	    <?php submit_button($submit, 'primary', 'submit', false); ?>
            </div>
            <div class="clear"></div>
        </div>
        </div>
    </div>
    </div>
    <?php do_action('frm_edit_entry_sidebar', $record); ?>
</div>