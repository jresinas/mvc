<?php
$users = $User->get_all();
?>
<ul>
<?php
foreach ($users as $user){
	echo '<li>'.$user['name'].'</li>';
}
?>
</ul>