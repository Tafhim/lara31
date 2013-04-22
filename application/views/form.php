<?php echo Form::open('my/route'); ?>

	<!-- username field -->
	<?php echo Form::label('username', 'Username'); ?>
	<?php echo Form::text('username'); ?>

	<!-- password field -->
	<?php echo Form::label('password', 'Password'); ?>
	<?php echo Form::password('password'); ?>

	<!-- login button -->
	<?php echo Form::submit('Login');?>

	<!-- CSRF -->
	<?php echo Form::token();?>

<?php echo Form::close(); ?>

<?php echo Form::checkbox('admin', 'yes', false, array('id' => 'admin-checker')); ?>

<?php echo Form::radio('admin', 'yes', false, array('id' => 'admin-checker')); ?>

<?php
echo Form::select('roles', array(
0 => 'User',
1 => 'Member',
2 => 'Editor',
3 => 'Administrator'
), 2);
?>

<?php
echo Form::submit('Login', array());
echo Form::button('Do other thing!');
echo Form::search('Search', $value = null, $attributes = array());
?>