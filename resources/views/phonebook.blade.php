<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Phonebook</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        <link href="https://fonts.googleapis.com/css?family=Exo" rel="stylesheet">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet">
        <link href="{{URL::asset('css/style.css')}}" rel="stylesheet">
    </head>
    <body>
    <div class="wrapper">
        <header>
            <div class="row">
            <div class="col-sm-10 text-left">
                <h1>Phonebook</h1>
            </div>
            <div class="col-sm-2 text-right bar">
                <i class="fa fa-bars"></i>
            </div>

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
    <script src="{{URL::asset('js/common.js')}}"></script>
    </body>
</html>
