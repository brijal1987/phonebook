<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Phonebook</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        <link href="https://fonts.googleapis.com/css?family=Exo" rel="stylesheet">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet">
        <style>
            body {
            background-color: #ccc;
            font-family: verdana;
            }
            .wrapper {
                width: 320px;
                margin: 0 auto 0px auto;
            }
            header {
                background-color: #0073C3;
                padding: 20px;
                color: #fff;
            }
            header h1 {
                float:left;
                padding:0; margin:0;
            }
            .topsection {
                background-color: #FAFAFA;
            }
            .row {
                margin: 0 auto;
                width: 280px;
                clear: both;
                text-align: center;
                font-family: 'Exo';
            }

            .digit {
                cursor: pointer;
                padding:20px;
                border:1px solid #ccc;
                height: 60px;
            }

            .dig {
                cursor: pointer;
                padding: 10px 5px;
                height: 45px;
                margin: 8px 0;
            }
            .dig-top{
                padding: 3px;
                margin-top: 10px;
            }
            .row { padding:0; margin:0;width:100%; }
            .right {
                color:#0073C3;
                border-right:1px solid #ccc;
            }

            .left {
                border-left:1px solid #ccc;
                font-weight: 900;
            }

            .sub {
            font-size: 0.8rem;
            color: grey;
            }

            section {
                background-color: #FAFAFA;
                padding: 0;
                text-align: center;
                box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25), 0 10px 10px rgba(0, 0, 0, 0.22);
            }
            .result {
                height:200px;
                position:relative;
                background-color:#4A4A4A;
                padding: 10px 0;
                color:#fff;
                overflow: auto;
                font-size:10px;
            }
            .result-footer {
                height: 50px;
                position: absolute;
                bottom:0;
                width: 100%;
                background-color:#2C2C2C;
            }
            .highlight {
               color: #1AC6FE;
            }
</style>
    </head>
    <body>
    <div class="wrapper">
        <header>
            <h1>Phonebook</h1>
            <nav class="navbar navbar-light light-blue lighten-4">
                <button class="navbar-toggler toggler-example" type="button" data-toggle="collapse" data-target="#navbarSupportedContent1" aria-controls="navbarSupportedContent1" aria-expanded="false" aria-label="Toggle navigation">
                <span class="dark-blue-text">
                    <i class="fas fa-bars fa-1x"></i>
                </span>
                </button>
            </nav>
        </header>
        <div class="result">
            <div class="result-footer">
                <div class="row">
                    <div class="col-sm-9 dig-top text-left" id="output-result"></div>
                    <div class="col-sm-3 dig-top left"><img width="30px" src="{{URL::asset('contact-icon.png')}}" /></div>
                </div>
            </div>
        </div>
        <div class="topsection">
            <div class="row">
                <div class="col-sm-3 dig right text-center"><span id="matches">0</span><br/>Matches</div>
                <div class="col-sm-6 dig text-right" id="output"></div>
                <div class="col-sm-3 dig left">| <i class="fa fa-long-arrow-left" aria-hidden="true"></i></div>
            </div>
        </div>
        <form method="get" action="">
        {{ csrf_field() }}
        <section>
            <div class="row">
                <div class="col-sm-4 digit" id="one" data-char="">1</div>
                <div class="col-sm-4 digit" id="two" data-char="ABC">2
                    <div class="sub">ABC</div>
                </div>
                <div class="col-sm-4 digit" id="three" data-char="DEF">3
                    <div class="sub">DEF</div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4 digit" id="four" data-char="GHI">4
                <div class="sub">GHI</div>
                </div>
                <div class="col-sm-4 digit" id="five" data-char="JKL">5
                <div class="sub">JKL</div>
                </div>
                <div class="col-sm-4 digit" data-char="MNO">6
                <div class="sub">MNO</div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4 digit" data-char="PQRS">7
                <div class="sub">PQRS</div>
                </div>
                <div class="col-sm-4 digit" data-char="TUV">8
                <div class="sub">TUV</div>
                </div>
                <div class="col-sm-4 digit" data-char="WXYZ">9
                <div class="sub">WXYZ</div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4 digit">*
                </div>
                <div class="col-sm-4 digit">0
                </div>
                <div class="col-sm-4 digit">#
                </div>
            </div>
            <input type="hidden" value="" id="search-string" />
            <input type="hidden" value="" id="search-string-num" />
        </section>
        </form>

    </div>
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
    <script>
    var count = 0;

    $(".digit").on('click', function() {
        var outputString = $("#search-string").val();
        var outputStringNum = $("#search-string-num").val();
        var char = $(this).attr("data-char");
        if(!outputString.includes(char))outputString+= char;
        var num = ($(this).clone().children().remove().end().text());
        if (count < 11) {
            $("#output").append('<span data-num="'+num.trim()+'" data-char="'+char+'">' + num.trim() + '</span>');
            count++
            outputStringNum += num.trim();
            $("#search-string-num").val(outputStringNum);
            $("#search-string").val(outputString);
            getData();

        }
    });

    function getData(){
        var outputString = $("#search-string").val();
        $.ajax({
            type:'GET',
            url:'/contacts',
            data: {
                'search': outputString
            },
            dataType: 'JSON',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success:function(data){
                $("#matches").html(data.totalCount);
                var output = "";
                $.each(data.Contacts, function(k, Contact) {
                    /// do stuff
                    output += `<p>${Contact.name}</p><p>${Contact.phone}</p>`;
                });
                $("#output-result").html(output);
                setTimeout(function(){
                    highlight(data.searchWords);
                }, 1000);
            }
        });
    }
    function highlight(searchWords) {
        var inputText = document.getElementById("output-result");
        innerHTML = inputText.innerHTML;
        var finalhtml = "";
        $.each(searchWords, function(k, text) {
            var index = innerHTML.toLowerCase().indexOf(text.toLowerCase());
            if (index >= 0) {
                finalhtml += innerHTML.substring(0,index) + "<span class='highlight'>" + innerHTML.substring(index,index+text.length) + "</span>" + innerHTML.substring(index + text.length);
            }
        });
        $("#output-result").html(finalhtml);
    }
    $('.fa-long-arrow-left').on('click', function() {
        var removeElement = $('#output span:last-child');
        var char = removeElement.attr("data-char");
        var num = removeElement.attr("data-num");
        var outputString = $("#search-string").val().trim();
        var outputStringNum = $("#search-string-num").val().replace(num, "");
        if(!outputStringNum.includes(num)){
            outputString = outputString.replace(char, "");
        }
        $('#output span:last-child').remove();

        $("#search-string-num").val(outputStringNum);
        $("#search-string").val(outputString);
        count--;
    });
    </script>
    </body>
</html>
