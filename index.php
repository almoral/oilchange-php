<!DOCTYPE html>

<html>
	<head>
		<title>Oil Change</title>
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
	</head>
	<body>
	<div id="oilChangeBody">
		<form>
	<select id="year" name="year"><? echo $dd; ?></select>
	
<select id="makes" name="makes"><? echo $make; ?></select>

<select id="models" name="models"><? echo $model; ?></select>

<div id="mileage" name="mileage"><? echo $mileage; ?></div>
</form>
</div>

<script type="text/javascript">


  function capitalizeFirstLetter(string){
    return string.charAt(0).toUpperCase() + string.slice(1);
  };

  $(document).ready(function(){

  	$.ajax({
  		url: 'year.php',
  		dataType: 'json',
  	}).success(function(data){

  		$.each(data, function(key, val){
  			$("#year").append($("<option></option>").attr('value', val).text(val));
  		});
  	});



    if($("#year option:selected").text() == "")
    {
      $("#makes").prop('disabled', 'disabled');
      $("#models").prop('disabled', 'disabled');
    }


    $("select").on('change', function(e){

    var valuesToSubmit = e.currentTarget.selectedOptions[0].innerText;

    //valuesToSubmit = valuesToSubmit.replace(/\s+/g, ' ');

    var form = document.getElementsByTagName('form');

    var target = capitalizeFirstLetter(e.target.name);

    var controller;

    switch(target){

      case 'Year':
        controller = "makes"
        break;

      case 'Makes':
        controller = "models"
        valuesToSubmit += '&Year=' + $("#year option:selected").text();
        break;

      case 'Models':
        controller = "mileage"
        valuesToSubmit += '&Year=' + $("#year option:selected").text();
        break;
    };


    $.ajax({
        url: controller + ".php", //sumbits it to the given url of the form
        data: target +'=' + valuesToSubmit,
        dataType: "json" // you want a difference between normal and ajax-calls, and json is standard
    }).success(function(data){
        //act on result.

        if(data.length > 0){

        var arrOptions = [$('<option/>')];

        for(var i=0; i < data.length; i++){

          var newOption = $('<option/>');
          newOption.text(data[i]);
          newOption.attr('value', data[i]);
          arrOptions.push(newOption);
        }

        $("#" + controller + "").html(arrOptions);
        $("#" + controller + "").prop('disabled', false);

        if(data.length == 2 && data[0] == ""){

        	$("#mileage").text(data[1]);
        }

      }
    });
    return false; // prevents normal behaviour


    });


  });

</script>


	</body>
</html>
