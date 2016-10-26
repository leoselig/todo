<?php
include("db.php");
// try to break down your page into separate parts that each reside in their own
// .php file -> increases reuseability of these parts (called components)
?>

<!DOCTYPE html>
<html lang="de">
	<head>
		<!-- Required meta tags always come first -->
		<!-- that sounds as if it was copied from somewhere ;) -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Title Page</title>
	</head>
	<body>
		<form method="post" name="tdlst">
			<!-- NEVER (!) use HTML for styling and layout, HTML should never do more
		than defining the sematical structure of the page
	And before anything else, NEVER EVER use HTML <table>-layouts, that is...
 			- something only CSS should do (e.g. display: table; or in modern browsers display: flex;)
		  - completely destroying screen readers, thus making your site not accessible (https://en.wikipedia.org/wiki/Web_accessibility) -->
			<table width="750px" align="center" border="1" style="border-collapse: collapse;">

				<tr>
					<th colspan="2">Neuen Eintrag hinzuf&uuml;gen</th>
				</tr>
				<tr>
					<td>
						<input name="task" type="text" value="Bitte neue Aufgabe eingeben..." />
					</td>
					<td width="1%">
						<!-- Again: never use HTML for styling and layout -->
						<select name="prio" title="Priorit&auml;t">
							<option>1</option>
							<option>2</option>
						<option selected="selected">3</option>
						</select>
					</td>
				</tr>
				<tr>
					<td align="center" colspan="2">
						<input type="submit" name="submit" value="Abschicken" />
					</td>
				</tr>
			</table>
		</form>
		<?php
			// I will show you what's wrong with this, once you deploy that app somewhere
			// this will then also reveal to you why PDO is something you should definitely use
			$sql_insert	= 	"INSERT INTO 01todo (`id`,`task`,`prio`,`done`) VALUES (NULL,'".$_REQUEST["task"]."','".$_REQUEST["prio"]."','0')";

			// put all this into a function that loads the todos
			// another function/component/file/thingy takes care of then rendering this
			// (disregarding the language, framework, task, whatever: you must always split data acquisition from rendering)

			// try to keep your nesting shallow (e.g. avoid nested if/else-clauses)
			// for instance, call a new function createTodo(), when then 'submit' param is set
			// if(isset($_REQUEST['submit'])) {
			//   createTodo();
			// }
			// This is way easier to read. If someone wants to see how todos are actually created,
			// he/she can take a look into the createTodo() function
			if(isset($_REQUEST['submit'])) {
				$dbinsert = mysqli_query($db_connect_todo, $sql_insert);
				if($dbinsert) {
					echo "<b><i>Der Eintrag wurde erfolgreich hinzugefügt!</i></b><br><br>";
					// load database content, so the new task displays
					if (mysqli_num_rows($sql_load_result) > 0) {
					    // output data of each row
					    while($row = mysqli_fetch_assoc($sql_load_result)) {
					        echo " Task: " . $row["task"]. " Priorität " . $row["prio"]. "<br>";
					    }
					} else {
							// you have this already at the bottom, seems definitely weird
					    echo "0 results";
					}
				} else {
					echo 'Error: ' . mysqli_error($db_connect_todo);
				}
			}

			$sql_load_todos = "SELECT * FROM 01todo";
			$sql_load_result = $db_connect_todo->query($sql_load_todos);

			if (mysqli_num_rows($sql_load_result) > 0) {
			    // output data of each row
			    while($row = mysqli_fetch_assoc($sql_load_result)) {
			        echo " Task: " . $row["task"]. " Priorität " . $row["prio"]. "<br>";
			    }
			} else {
			    echo "0 results";
			}

		?>
		<!-- jQuery -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	</body>
</html>
