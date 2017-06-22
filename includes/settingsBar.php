<div class="settingBar">
    <div class="settingContent">
        <h2 id="settingsTitle">Einstellungen</h2>
        <script type="text/javascript" src="script/settingsBar.js"></script>
        <form id="settingsForm" action="chooseSubjects.php" method="post">
            <table>
                <tr class="absch">
                    <td>
                        <label>Abschluss</label>
                        <select name="absch">
                            <option value="Abitur" <?php echo (isset($_POST['absch']) && $_POST['absch'] == "Abitur") ? "selected=\"selected\"" : "";?>>Abitur</option>
                            <option value="Fachhochschule" <?php echo (isset($_POST['absch']) && $_POST['absch'] == "Fachhochschule") ? "selected=\"selected\"" : "";?>>Fachhochschule</option>
                        </select>
                    </td>
                </tr>
                <tr class="profil">
                    <td>
                        <label>Profil</label>
                        <select id="profil" name="profil">
                            <option value="GE" <?php echo (isset($_POST['profil']) && $_POST['profil'] == "GE") ? "selected=\"selected\"" : "";?>>Gesundheit und Soziales</option>
                            <option value="ER" <?php echo (isset($_POST['profil']) && $_POST['profil'] == "ER") ? "selected=\"selected\"" : "";?>>Ernährung</option>
                            <option value="TE" <?php echo (isset($_POST['profil']) && $_POST['profil'] == "TE") ? "selected=\"selected\"" : "";?>>Technik</option>
                            <option value="WL" <?php echo (isset($_POST['profil']) && $_POST['profil'] == "WL") ? "selected=\"selected\"" : "";?>>Wirtschaft</option>
                        </select>
                    </td>
                </tr>
                <tr class="seclanguage">
                    <td>
                        <label>2.Fremdsprache</label>
                        <select style="display:block;" name="seclanguage">
                            <option value="Französisch" <?php echo (isset($_POST['seclanguage']) && $_POST['seclanguage'] == "Französisch") ? "selected=\"selected\"" : "";?>>Französisch</option>
                            <option value="Spanisch" <?php echo (isset($_POST['seclanguage']) && $_POST['seclanguage'] == "Spanisch") ? "selected=\"selected\"" : "";?>>Spanisch</option>
                        </select>
                    </td>
                </tr>
                <tr class="language">
                    <td>
                        <label>Profilsprache</label>
                        <select name="language">
                            <option value="DE" <?php echo (isset($_POST['language']) && $_POST['language'] == "DE") ? "selected=\"selected\"" : "";?>>Deutsch</option>
                            <option value="EN" <?php echo (isset($_POST['language']) && $_POST['language'] == "EN") ? "selected=\"selected\"" : "";?>>Englisch</option>
                        </select>
                    </td>
                </tr>
            </table>
            <input type="submit" value="Ändern">
        </form>
    </div>
</div>