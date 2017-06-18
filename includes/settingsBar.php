<div id="settingBar">
	<h2 id="settingsTitle">Einstellungen</h2>
    <script type="text/javascript" src="script/settingsBar.js"></script>
	<form id="settingsForm" action="chooseSubjects.php" method="post">
		<select id="absch" name="absch">
			<option value="Abitur" <?php echo ($_POST['absch'] == "Abitur") ? "selected=\"selected\"" : "";?>>Abitur</option>
			<option value="Fachhochschule" <?php echo ($_POST['absch'] == "Fachhochschule") ? "selected=\"selected\"" : "";?>>Fachhochschule</option>
		</select>
		<select id="profil" name="profil">
			<option value="GE" <?php echo ($_POST['profil'] == "GE") ? "selected=\"selected\"" : "";?>>Gesundheit und Soziales</option>
			<option value="ER" <?php echo ($_POST['profil'] == "ER") ? "selected=\"selected\"" : "";?>>Ernährung</option>
			<option value="TE" <?php echo ($_POST['profil'] == "TE") ? "selected=\"selected\"" : "";?>>Technik</option>
			<option value="WL" <?php echo ($_POST['profil'] == "WL") ? "selected=\"selected\"" : "";?>>Wirtschaft</option>
		</select>
        <select id="language" style="display:none;" name="language">
                <option value="DE" <?php echo ($_POST['language'] == "DE") ? "selected=\"selected\"" : "";?>>Deutsch</option>
                <option value="EN" <?php echo ($_POST['language'] == "EN") ? "selected=\"selected\"" : "";?>>Englisch</option>
        </select>
        <select id="seclanguage" style="display:block;" name="seclanguage">
                <option value="Französisch" <?php echo ($_POST['seclanguage'] == "Französisch") ? "selected=\"selected\"" : "";?>>Französisch</option>
                <option value="Spanisch" <?php echo ($_POST['seclanguage'] == "Spanisch") ? "selected=\"selected\"" : "";?>>Spanisch</option>
        </select>
		<input type="submit" value="Ändern">
	</form>
</div>