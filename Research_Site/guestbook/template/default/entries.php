<?php include_from_template('header.php'); ?>
session_start();
error_reporting(E_ALL ^ E_NOTICE);
<?php show_guestbook_add_form(); ?>

<h2>Current Entries</h2>

<p class="entryCount">
Viewing entries <?php show_entries_start_offset(); ?> through <?php show_entries_end_offset(); ?> 
(Total entries: <?php show_entry_count(); ?>)
</p>
<?php if((($_SESSION['Admin_Username'])!="")&&(($_SESSION['User_UserGroup'])=="4")){?>
<p class="entryCount">
<a href="http://localhost/Research_Site/guestbook/admin/index.php">Go to Admin Page</a>
</p>
<?php } ?>
<?php show_entries(); ?>

