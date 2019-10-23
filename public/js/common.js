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
                _highlight(data.searchWords);
            }, 10);
        }
    });
}
function _highlight(str, className) {
    var inputText = $("#output-result");
    var regex = new RegExp(str.join("|"), "gi");
    var html = inputText.html().replace(regex, function(matched){
        return "<span class='highlight'>" + matched + "</span>";
    });
    $("#output-result").html(html);
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
    getData();
    count--;
});