<html>
	<head>
		<title>
			Abi/Fachhochschulrechner
		</title>
        <meta charset="UTF-8"> 
		<link rel="stylesheet" type="text/css" href="style/webStyle.css">
		<!-- load jQuery -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script type="text/javascript" src="script/index.js"></script>
	</head>
	<body>
        <noscript>
            AKTIVIERE JAVASCRIPT!!!
            <style>html{display:none;}</style>
            <meta http-equiv="refresh" content="0.0;url=http://www.enable-javascript.com/">
        </noscript>
        <?php include 'includes/navBar.html'?>
        <div class="page">
            <div class="content">
                <h1 id="order">Wilkommen zum Abschlussrechner</h1>
                <form id="form" action="chooseSubjects.php" method="post">
                    <table>
                        <tr id="absch">
                            <td>
                                <label>Wähle den Abschluss</label>
                                <select id="abschSelect" name="absch">
                                    <option value="Abitur">Abitur</option>
                                    <option value="Fachhochschule">Fachhochschule</option>
                                 </select>
                            </td>

                        </tr>
                        <tr id="profil">
                            <td>
                                <label>Wähle das Profil</label>
                                <select id="profilSelect" name="profil">
                                    <option value="GE">Gesundheit und Soziales</option>
                                    <option value="ER">Ernährung</option>
                                    <option value="TE">Technik</option>
                                    <option value="WL">Wirtschaft</option>
                                </select>
                            </td>
                        </tr>
                        <tr id="seclanguage">
                            <td>
                                <label>Wähle die 2. Fremdsprache</label>
                                <select id="seclanguageSelect" name="seclanguage">
                                    <option value="Französisch">Französisch</option>
                                    <option value="Spanisch">Spanisch</option>
                                </select>
                            </td>
                        </tr>
                        <tr id="language">
                            <td>
                                <label>Wähle die Fachsprache</label>
                                <select id="languageSelect" name="language">
                                    <option value="DE">Deutsch</option>
                                    <option value="EN">Englisch</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <button type="submit" value="Bestätigen">Bestätigen</button>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
	</body>
</html>