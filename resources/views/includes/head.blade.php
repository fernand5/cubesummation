<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Rappi</title>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<!-- Custom Fonts -->
{{--<link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">--}}
<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
<link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>

<script src="https://code.jquery.com/jquery-1.8.0.min.js"></script>


<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<style>
    /* Preloader */

    #preloader {
        position: fixed;
        display: none;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ffffff38;
        /* change if the mask should have another color then white */
        z-index: 99;
        /* makes sure it stays on top */
    }

    #status {
        width: 200px;
        height: 200px;
        position: absolute;
        left: 50%;
        /* centers the loading animation horizontally one the screen */
        top: 50%;
        /* centers the loading animation vertically one the screen */
        background-image: url(https://raw.githubusercontent.com/niklausgerber/PreLoadMe/master/img/status.gif);
        /* path to your loading animation */
        background-repeat: no-repeat;
        background-position: center;
        margin: -100px 0 0 -100px;
        /* is width and height divided by two */
    }
</style>
<script>
    $( document ).ready(function() {
        $(".alert.alert-danger").hide();
        $("form").submit(function(e){

            $("#submitButton").prop('disabled', true);
            $('#readOnlyResults').html('');
            e.preventDefault();
            var dataCubes=$('#areaData').val().split(/\n\d+[ ]\d+\n/);
            var t=parseInt(dataCubes[0]);
            var nYm=$('#areaData').val().match(/\n\d+[ ]\d+\n/g);
            nYm=nYm.map(function(el) {
                return el.replace(/\n/g, '')
            });

            // check if T value and the array of test-cases (length) are the same
            if(t==(dataCubes.length-1)){
                var i=0;
                for(i;i<nYm.length;i++){
                    var nYmTmp=nYm[i].split(" ");
                    var n=nYmTmp[0];
                    var m=nYmTmp[1];
                    console.log(nYmTmp);
                    $("#preloader").show();

                    $.ajax({
                        type: "POST",
                        url: "calculate",
                        async : false,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {"sentences": dataCubes[i+1], 'n': n, 'm':m},
                        dataType: "json",

                        success: function(response){

                            if(response.error){
                                $(".alert.alert-danger").text(response.error);
                                $(".alert.alert-danger").show();
                                i=nYm.length;

                            }else{
                                $(".alert.alert-danger").hide();
                                $('#readOnlyResults').append(response.join("\n"));
                                $('#readOnlyResults').append("\n");
                            }
                        },
                        complete: function(){
                            $('#preloader').hide();
                        }
                    });
                }
            }else{
                $(".alert.alert-danger").text('T value distinct of test-cases quantity');
                $(".alert.alert-danger").show();
            }
            $("#submitButton").prop('disabled', false);
        });
    });
</script>