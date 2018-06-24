<?php
session_start();
require $_SERVER['DOCUMENT_ROOT'].'/docs/layout/layouts.php';
 ?>
<!DOCTYPE html>
<html lang="de" dir="ltr">
	<?php
		create_header("C# - MySQL-Connection");
	 ?>
	<body>
		<?php
			create_layout("C#", "content", "a Documentation about MySQL-Connections in C#");
		 ?>
		<div class="container well">
			<?php
				create_doc_contents_for("MySQL-Connection",
				[
					"Voraussetzungen",
					"Importieren der DLL",
					"Herstellen der Verbindung",
					"Abfragen von Daten",
					"Gesamter Code",
					"Resources"
				]
				);

				create_doc_header("Voraussetzungen");
				create_doc_text("
					Zum herstellen einer Verbindung wird ein konfigurierter MySQL Server vorrausgesetzt. In dem beispiel wurde der Server über XAMPP gehostet. Außerdem wird die MySql.Data.dll benötigt. Diese lässt sich im bereich Resources herunterladen. Zum entwickeln von C# Anwendungen wird Visual Studio empfohlen.
				");

				create_doc_header("Importieren der DLL");
				create_doc_text("
					Um den MySQL-Connector in C# verwenden zu können muss die DLL über einen rechtsklick auf Verweise -> Verweis hinzufügen importiert werden.
					Im folgenden Popup muss über durchsuchen die DLL ausgewählt werden. Anschließend muss die Using-Direktive der Connector zum Code hinzugefügt werden.
				");
				create_doc_code("csharp", "using MySql.Data.MySqlClient; //Import des MySQL-Connectors");

				create_doc_header("Herstellen der Verbindung");
				create_doc_text("
					Um die Verbindung herzustellen muss ein String erstellt werden der die Verbindungsdaten enthält. Die folgenden attribute müssen wie folgt ausgefüllt werden:

					Server: Serveradresse (Im beispiel: 127.0.0.1)
          Port: Port des MySQL-Servers (Steht auf der XAMPP Oberfläche)
          Database: Die Datenbank auf die das Programm sich Verbinden soll
          uid: Datenbankbenutzer (Standart root)
          password: Selbsterklärend (Standartmäßig nicht gesetzt)
				");
				create_doc_code("csharp", 'string s_connString = "Server=127.0.0.1;Port=3306;Database=demodb;uid=root;password=;";');

				create_doc_text("
					Die Verbindung kann jetzt über die MySQLConnection-Klasse hergestellt werden. Der Konstruktur muss mit dem String aufgerufen werden der die Verbindungsdaten enthält.
				");
				create_doc_code("csharp", 'MySqlConnection o_conn = new MySqlConnection(s_connString);');


				create_doc_header("Abfragen von Daten");
				create_doc_text("
					Jetzt kann ein Objekt erstellt werden das den SQL Befehl enthält. Das Attribut CommandText muss den SQL Befehl enthalten.
				");
				create_doc_code("csharp", 'MySqlCommand o_command = o_conn.CreateCommand();
o_command.CommandText = "SELECT * FROM test"; //Selektiert alle Daten auf der Tabelle namens "test"');
				create_doc_text("
					Als nächstes wird die Verbindung geöffnet. Hier kann ein Fehler entstehen also müssen wir den möglichen Fehler abfangen.
				");
				create_doc_code("csharp", 'try {
    o_conn.Open(); //Öffnen der Verbindung
} catch(Exception ex_connOpenError) {
    //Hier kann eine Fehlerbehandlung implementiert werden
    Console.WriteLine(ex_connOpenError.Message); //Ausgeben der Fehlernachricht
}');
				create_doc_text("Als nächstes wird der SQL Befehl ausgeführt. Das gibt ein Objekt zurück das sich Reader nennt und die gelesenen Daten beinhaltet.");
				create_doc_code("csharp", 'MySqlDataReader o_reader = o_command.ExecuteReader();');

				create_doc_text('Jetzt können die Daten der Datenbankabfrage ausgegeben werden. Auf das Tuple können wir so zugreifen: o_reader["spaltenname"]. Damit WriteLine die Daten ausgeben kann werden sie zur Sicherheit zu einem String convertiert mit: .ToString()');
				create_doc_code("csharp", 'while(o_reader.Read()) {
  Console.WriteLine(o_reader["name"].ToString());
}');

				create_doc_header("Gesamter Code");
				create_doc_text("
					Es folgt der komplette beispiel Code:
				");
				create_doc_code("csharp", 'using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

using MySql.Data.MySqlClient;

namespace mysql {
    class Program {
        static void Main(string[] args) {

            string s_connString = "Server=127.0.0.1;Port=3306;Database=demodb;uid=root;password=;";
            MySqlConnection o_conn = new MySqlConnection(s_connString);

            MySqlCommand o_command = o_conn.CreateCommand();
            o_command.CommandText = "SELECT * FROM test";

            try {
                o_conn.Open();
            } catch(Exception ex_connOpenError) {
                Console.WriteLine(ex_connOpenError.Message);
            }

            MySqlDataReader o_reader = o_command.ExecuteReader();

            while(o_reader.Read()) {
                Console.WriteLine(o_reader["name"].ToString());
            }
        }
    }
}');

				create_doc_header("Resources");
				create_doc_text("
					Download-Links der Resourcen:
				");
				create_download_button("Visual Studio Projekt -> 190620182207.rar", "projects/190620182207.rar", "190620182207.rar");
				create_download_button("MySQL Connector -> MySql.Data.dll", "resources/MySql.Data.DLL", "MySql.Data.DLL");

			 ?>
		</div>
		<?php
		create_footer();
		 ?>
		<div class="_upscroller">&Lambda;</div>
	</body>
	<?php
		create_scripts();
	 ?>
</html>
