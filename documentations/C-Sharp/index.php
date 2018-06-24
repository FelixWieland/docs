<?php
session_start();
require $_SERVER['DOCUMENT_ROOT'].'/docs/layout/layouts.php';
 ?>
<!DOCTYPE html>
<html lang="de" dir="ltr">
	<?php
		create_header("C#");
	 ?>
	<body>
		<?php
			create_layout("C#", "content");
		 ?>
		 <div class="container well">
 			<h1>What's C#? - German please ...</h1>
			<p class="_description_content">
				C# ist eine statische, typsichere, objektorientierte, general-purpose Programmiersprache der Firma Microsoft. Die Sprache ist an sich plattformunabhängig, wurde aber im Rahmen der .NET-Strategier entwickelt, ist auf diese optimiert und meist in deren Kontext zu finden.
				Eigentlich wurde C# fast exklusiv für Microsoft Windows entwickelt. Durch Xamarin ist es inzwischen aber auch möglich, für macOS, iOS und Android zu entwickeln.
				C# orientiert sich stark an den Programmiersprachen Java, C++, C und Haskell.
			</p>
 			</div>
		 <div class="container-fluid well _margin_normal _parallax-wrapper _parallax-background-05">

 			<br>
 		</div>
		<div class="container well">
			<h1>Contents for C#</h1><br>
			<?php
				create_contents_for("C-Sharp");
			 ?>
		</div>
		<div class="_upscroller">&Lambda;</div>
		<?php
			create_footer();
		 ?>
	</body>
	<?php
		create_scripts();
	 ?>
</html>
