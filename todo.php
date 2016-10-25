<?php
include("db.php");
?>

<!DOCTYPE html>
<html lang="de">
	<head>
		<!-- Required meta tags always come first -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Title Page</title>
	</head>
	<body>
		<form action="todo.php" method="post" name="tdlst">
			<table width="750px" align="center" border="1" style="border-collapse: collapse;">
				<tr>
					<th colspan="2">Neuen Eintrag hinzuf&uuml;gen</th>
				</tr>
				<tr>
					<td><input name="task" type="text" value="Bitte neue Aufgabe eingeben..." /></td>
					<td width="1%"><select name="prio" title="Priorit&auml;t">
						<option>1</option>
						<option>2</option>
						<option selected="selected">3</option>
					</select></td>
				</tr>
				<tr>
					<td align="center" colspan="2">
						<input type="submit" name="submit" value="Abschicken" />
					</td>
				</tr>
			</table>
		</form>
		<?php
			$sql_insert = "INSERT INTO 01todo (`id`,`task`,`prio`,`done`) VALUES (NULL,'".$_REQUEST["task"]."','".$_REQUEST["prio"]."','0')";

			if(isset($_REQUEST['submit'])) {
				$dbinsert = mysqli_query($db_connect_todo, $sql_insert);
				if($dbinsert) {
					echo "<b><i>Der Eintrag wurde erfolgreich hinzugefügt!</i></b>";
				} else {
					echo 'Error: ' . mysqli_error($db_connect_todo);
				}
			}
		?>
		<!-- jQuery -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	</body>
</html>