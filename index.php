<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Test</title>

    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
    <script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.min.js"></script>
    <script type="text/javascript" src="http://uedayou.net/SPARQLTimeliner/js_sparql/sparql.js" charset="UTF-8"></script>
</head>
<body>

<div id="container">
    <div id="header">
        <h2 style="background-color: #99cc00">JavaScriptによるSPARQL利用サンプル</h2>
    </div>

    <div id="right" class="right">
        <div>
            <input id="ep_url" type="text" size="60" value="http://db.lodosaka.jp/sparql">
        </div>
        <div>
            <textarea id="query_area" cols="60" rows="10">SELECT * WHERE {
                ?s ?p ?o.
                }
                LIMIT 100 </textarea>
            <input type="button" id="find_query" value="query"/>
        </div>

        <!-- 結果ペイン -->
        <div id="result_div" class="table_parent">
        </div>
    </div>

</div>

<script>
    var endpoint = "http://db.lodosaka.jp/sparql";

    $(function() {

        $('#find_query').click(function(){

            endpoint = $('#ep_url').val(); //エンドポイント情報をフォームから入力する場合

            var qr = sendQuery(
                endpoint,
                $('#query_area').val().replace(/[\n\r]/g,"")
            );


            qr.fail(
                function (xhr, textStatus, thrownError) {
                    alert("Error: A '" + textStatus+ "' occurred.");
                }
            );
            qr.done(
                function (d) {
                    result_table(d.results.bindings);
                }
            );


        });

        $('#result_div').hide();

        init();

    });


    //結果表示用の関数
    function result_table(data){
        var result_div = $('#result_div');

        var table = $('#result_list')[0];


        if (data instanceof Array) {
            result_div.show();
            var result_html ="";

            for (var d = 0; d < data.length; d++) {
                var i = 0;
                for ( var key in data[d]) {
                    result_html += d+':'+key+'\t'+data[d][key].value+ '<br>';
                }
                result_html += '<br>';
            }


            result_div.html(result_html);
        }
    };

</script>
</body>
</html>