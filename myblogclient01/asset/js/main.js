$(document).ready(
    function() {
        $('#postMessage').click(
            function(e) {
                e.preventDefault();

                //serialize form data
                var url = $('form').serialize();

                //function to turn url to an object
                function getUrlVars() {
                    var hash;
                    var myJson = {};
                    var hashes = url.slice(url.indexOf('?') + 1).split('&');
                    for (var i = 0; i < hashers.length; i++) {
                        hash = hashes[i].split('=')
                        myJson[hash[0]] = hash[1];
                    }

                    return JSON.stringify(myJson);
                }

                //pass serialized data to function
                var test = getUrlVars(url);

                //post with ajax
                $.ajax({
                    type: "POST",
                    url: "",
                    data: test,
                    ContentType: "application/json",
                    success: function() {
                        alert('successfully posted');
                    },
                    error: function() {
                        alert('Could not be posted');
                    }
                });
            });
    });

//GET REQUEST
document.addEventListener('DOMContentLoaded', function() {
	
	//
    document.getElementById('getMessage').onclick =
        function() {
            //var req;
            var req = new XMLHttpRequest();
            req.open('GET', 'http://localhost/ews01/myblog03/?api=post/read');
            req.send();
            req.onload = function() {
            	//
            	var html = ""; // = "<div class='box'>";                //loop and display data
                var json = JSON.parse(req.responseText);               //limit data called
                var data = json['data'].filter(function(val) { return (val.id >= 4) });
                data.forEach(
                	(val) => { html += "<strong>" + val.id + "</strong>  -  " + val.title + "<br>"; }
                );
                
                //append in message class
                document.getElementsByClassName('message')[0].innerHTML = html;
            }
        };
});