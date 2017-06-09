<div id="settingBar">
	<h2 id="settingsTitle">Einstellungen</h2>
	<form id="settingsForm" action="marks.php" method="post">
		<select id="absch" name="absch">
			<option value="Abitur" <?php echo ($_POST['absch'] == "Abitur") ? "selected=\"selected\"" : "";?>>Abitur</option>
			<option value="Fachhochschule" <?php echo ($_POST['absch'] == "Fachhochschule") ? "selected=\"selected\"" : "";?>>Fachhochschule</option>
		</select>
		<select id="profil" name="profil">
			<option value="0" <?php echo ($_POST['profil'] == "0") ? "selected=\"selected\"" : "";?>>Gesundheit und Soziales</option>
			<option value="1" <?php echo ($_POST['profil'] == "1") ? "selected=\"selected\"" : "";?>>Ernährung</option>
			<option value="2" <?php echo ($_POST['profil'] == "2") ? "selected=\"selected\"" : "";?>>Technik</option>
			<option value="3" <?php echo ($_POST['profil'] == "3") ? "selected=\"selected\"" : "";?>>Wirtschaft</option>
		</select>
		<input type="submit" value="Ändern">
	</form>
</div>