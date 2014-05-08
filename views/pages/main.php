<?php
echo "Pagina principal";
?>

<form action=<?php echo 'index.php/users/login' ?> method='post'>
<label for='name'>Name</label><input type='text' name='name'>
<label for='name'>Password</label> <input type='password' name='password'>
<input type='submit'>
</form>

<div>
<?php
if (isset($_SESSION['error'])){
	echo $_SESSION['error'];
}
?>
</div>

<a href=<?php echo 'index.php/users/view'; ?>>Usuarios</a>
<a href=<?php echo 'index.php/pages/register'; ?>>Register</a>