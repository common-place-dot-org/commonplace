<?php
remove_role('publisher');
remove_role('content_editor');
add_role( 'publisher', 'Publisher', array(
    'publish_posts'=>true,
    'set_current_issue'=>true,
    'read'=>true,
    'delete_others_posts'=>true,
    'edit_posts'=>true,
    'delete_published_posts'=>true,
    'edit_others_posts'=>true,
    'edit_published_posts'=>true,
    'delete_posts'=>true,
));

 add_role( 'content_editor', 'Content Editor', array(
   'read'=>true,
   'delete_others_posts'=>true,
   'edit_posts'=>true,
   'delete_published_posts'=>true,
   'edit_others_posts'=>true,
   'edit_published_posts'=>true,
   'delete_posts'=>true,
   'upload_files'=>true,
));

$role=get_role('administrator');
$role->add_cap('set_current_issue');
?>
