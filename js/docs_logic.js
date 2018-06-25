
function click_upscroller_btn() {
	$('html, body').animate({ scrollTop: 0 }, 300);
}

function click_menu_btn() {
	$("#_menu-field-id").toggle();
	$("._login_field").hide();

	if($("#_menu-field-id:visible").length != 0){
		$("#_closer_of_all").show();
	}
	else {
		$("#_closer_of_all").hide();
	}
}

function click_login_btn() {
	$("._login_field").toggle();
	$("#_menu-field-id").hide();

	if($("._login_field:visible").length != 0){
		$("#_closer_of_all").show();
	}
	else {
		$("#_closer_of_all").hide();
	}
}

function click_closeall_btn() {
	$("#_menu-field-id").hide();
	$("._login_field").hide();
	$(this).toggle();
}

function click_loginregister_btn() {
	$("._login_field-r").toggle();
	$("._login_field-l").toggle();
}

function click_loginsend_btn() {
	var email = $("#_login-input-id_email").val();
	var password = $("#_login-input-id_password").val();

	$.post("/docs/utility/login.php", { 'email': email,
																			'password': password,
																			'url': window.location.href
																			}, function(data) {
    if(data.includes("%LOGGEDIN%")){
			location.reload();
		} else {
			console.log(data);
		}
  });
}

function click_registersend_btn() {
	var email = $("#_register-input-id_email").val();
	var username = $("#_register-input-id_username").val();
	var password = $("#_register-input-id_password").val();

	$.post("/docs/utility/register.php", {'email': email,
																				'password': password,
																				'username': username,
																				'url': window.location.href
																			}, function(data) {
    if(data.includes("%REGISTERED%")) {
			location.reload();
		} else {

		}
  });
}

function click_createtool_btn() {
	var witch = $(this).html();
	var type = witch.replace("add_", "");
	var type = type.replace(/\s/g, "");
	var elm = $("#_documentation_create_place-id");
	if(type == "header"){
		var pattern = '<div class="row"><div class="col-sd-12 col-md-12 col-lg-12"><div class="_create_pattern"><p>%MUSTER%</p><input type="text" name="" value=""><button type="button" name="button" class="_elm_remove">X</button></div></div></div>';
		var pattern = pattern.replace("%MUSTER%", type);
		elm.append(pattern);
	}
	if(type == "linebreak"){
		var pattern = '<div class="row"><div class="col-sd-12 col-md-12 col-lg-12"><div class="_create_pattern _linebreak"><button type="button" name="button" class="_elm_remove">X</button></div></div></div>';
		elm.append(pattern);
	}
	if(type == "text"){
		var pattern = '<div class="row"><div class="col-sd-12 col-md-12 col-lg-12"><div class="_create_pattern"><p>%MUSTER%</p><textarea id="demo" rows="8" cols="10" contenteditable="true"></textarea><button type="button" name="button" class="_elm_remove _large_elm_btn">X</button></div></div></div>';
		var pattern = pattern.replace("%MUSTER%", type);
		elm.append(pattern);
	}
	if(type == "code"){
		languages = [
			"Code",
			"csharp",
			"c",
			"cpp",
			"rust"
		];
		var dropdown = createDropdown(languages);
		var pattern = '<div class="row"><div class="col-sd-12 col-md-12 col-lg-12"><div class="_create_pattern">' + dropdown + '<textarea id="demo" rows="8" cols="10" contenteditable="true"></textarea><button type="button" name="button" class="_elm_remove _large_elm_btn">X</button></div></div></div>';
		var pattern = pattern.replace("%MUSTER%", type);
		elm.append(pattern);
	}
	if(type == "download"){
		/*
		var pattern = '<div class="row"><div class="col-sd-12 col-md-12 col-lg-12"><div class="_create_pattern"><p>%MUSTER%</p><textarea id="demo" rows="20" cols="10" contenteditable="true"></textarea><button type="button" name="button" class="_elm_remove _large_elm_btn">X</button></div></div></div>';
		var pattern = pattern.replace("%MUSTER%", type);
		elm.append(pattern);
		*/
	}
}

function click_removeelement_btn() {
	$(this).parent().parent().remove();
}

function click_savedoc_btn() {
	//elements in array
	elements = $("#_documentation_create_place-id").children();
	//Check get first three values
	var isEmpty_1 = elements[1].children[0].children[0].children[1].value;
	var isEmpty_2 = elements[2].children[0].children[0].children[1].value;
	var isEmpty_3 = elements[3].children[0].children[0].children[1].value;
	//Check if obligatory fields are filled
	if(!isEmpty_1 && !isEmpty_2 && !isEmpty_3){
		return;
	}
	//Build header info
	// = [parent: "", title: "", description: ""]
	var header = {
		parent: isEmpty_1,
		title: isEmpty_2,
		description: isEmpty_3
	};
	//Build content
	var content = [];
	for (var i = 0; i < elements.length; i++) {
		//Skip buttons and header
		if(i < 4){
			continue;
		}
		try {
			var elm_type = elements[i].children[0].children[0].children[0].innerHTML;
			if(elm_type.includes('<option value="Code">Code</option>')){
				//handle options
				elm_type = 	elements[i].children[0].children[0].children[0].value;
			}
			var elm_value = elements[i].children[0].children[0].children[1].value;
			var row = {
				type: elm_type,
				value: elm_value
			}
			content.push(row);
		} catch (e) {
			//Exception handling
		}
	}
	//Send doc
	$.post("/docs/utility/handleDocs.php", {'header': header,
																				  'content': content
																			}, function(data) {
    if(data.includes("%UPDATED_DOC%")) {
			//Just show a updated popup
			showPopup("Updated", "Youre documentation - "+header["title"]+" - was successfully updated.", "ok");
		} else if(data.includes("%CREATED_DOC%")) {
			//Go to created doc
			window.location.href = '/docs/documentations/doc/?parent='+header["parent"]+'&title='+header["title"];
		}
  });
}

function click_choosedoc_btn() {
	$("#_create_documentation-hidden-id").show();
	$("._create_choose").hide();
}

function click_choosecontent_btn() {
	$("#_create_content-hidden-id").show();
	$("._create_choose").hide();
}

function insCode(string) {
	var elm = $("#_documentation_create_place-id");
	elm.append('<pre class="line-numbers _doc_code language-rust"><code class="language-rust">'+string+'</code></pre>');

}

function undo() {
	var elm = $("#_documentation_create_place-id");
	elm.children().last().remove();
}

function createDropdown(list) {
	var x = "<select>";
	for (var elm in list) {
		var pattern = '<option value="%MUSTER%">%MUSTER%</option>';
		pattern = pattern.replace("%MUSTER%", list[elm]);
		pattern = pattern.replace("%MUSTER%", list[elm]);
		x = x + pattern;
	}
	return x + "</select>"
	//<select><option value="saab">Saab</option><option value="mercedes">Mercedes</option><option value="audi">Audi</option></select>
}

//SuperPopup
function showPopup(title, text, icon, mode=4000) {
	//NOT IMPLEMENTED YET
	var pattern = '<div class="_super_popup_b1"><h3>'+title+'</h3><span class="glyphicon glyphicon-'+icon+'" aria-hidden="true"></span><p>'+text+'</p></div>'
	$("body").append(pattern);
	$("._super_popup_b1").fadeIn(1000).delay(mode).fadeOut(1000, function () {
		$(this).remove();
	});
}

//Prevent Tabbing in Textarea
$(document).on("keydown", "textarea", function(e) {
    if(e.keyCode === 9) { // tab was pressed
        // get caret position/selection
        var start = this.selectionStart;
        var end = this.selectionEnd;

        var $this = $(this);
        var value = $this.val();

        //set textarea value to: text before caret + tab + text after caret
        $this.val(value.substring(0, start)
                    + "\t"
                    + value.substring(end));

        //put caret at right position again (add one for the tab)
        this.selectionStart = this.selectionEnd = start + 1;

        //prevent the focus lose
        e.preventDefault();
    }
});

$(window).scroll(function() {
	if ($(document).scrollTop() > 80) {
		$('._navbar').addClass('_shrink');
		$("._upscroller").fadeIn(200);
	} else {
		$('._navbar').removeClass('_shrink');
		$("._upscroller").fadeOut(200);
	}
});
