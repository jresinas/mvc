<?php
echo "Pagina principal";
?>

<form action=<?php echo SITE_ROOT.'/index.php/users/register' ?> method='post'>
<label for='name'>Name</label><input type='text' name='name'>
<label for='password'>Password</label> <input type='password' name='password'>
<label for='repeat_password'>Repeat Password</label> <input type='password' name='repeat_password'>
<input type='submit'>
</form>

<div>
<?php
if (isset($_SESSION['error'])){
	echo $_SESSION['error'];
}
?>
</div>

<a href=<?php echo SITE_ROOT; ?>>Return</a>