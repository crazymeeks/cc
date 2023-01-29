<html>
<head>

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<script
  src="https://code.jquery.com/jquery-3.6.3.min.js"
  integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU="
  crossorigin="anonymous"></script>

<title>Coding Challenge</title>

<link rel="stylesheet" href="/style.css" type="text/css" />
</head>
<body>
    <div id="container">
        <div id="inner-container">
            <div>
                <div id="stat-filter">
                    <label for="statistic">Statistic</label>
                    <select name="" id="statistic">
                        <option value="">Select here</option>
                        @foreach($stats as $stat)
                            <option value="{{$stat->param_id}}">{{$stat->param_name}}</option>
                        @endforeach
                    </select>
                </div>
                <div id="year-filter">
                    <label for="year">Year</label>
                    <select name="" id="year">
                        <option value="">Select here</option>
                        @foreach($matches as $match)
                            <option value="{{$match->match_year}}">{{$match->match_year}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div id="results">
                <table class="table table-hover table-responsive">
                <thead>
                    <tr>
                        <th>Player</th>
                        <th>Statistics</th>
                        <th>Value</th>
                        <th>Year</th>
                    </tr>
                </thead>
            </table>
            </div>
            <div id="loader"></div>

        </div>
    </div>
    <script type="text/javascript">

        (function($){
            const getData = () => {
                
                let statId = null;
                let year = null;
                let page = 1;

                $('#statistic').on('change', function(evt){
                    statId = $(this).val();
                    page = 1;
                    callback();
                });

                $('#year').on('change', function(evt){
                    year = $(this).val();
                    page = 1;
                    callback();
                });

                $('body').on('click', '.pages', function(evt){
                    page = $(this).data('page');
                    callback();
                });

                // Previous Button
                $('body').on('click', '#prev', function(){
                    page = page - 1;
                    callback();
                });

                // Next Button
                $('body').on('click', '#next', function(){
                    page = page + 1;
                    callback();
                });

                function callback() {
                    if (statId && year) {
                        let body = {
                            statistic: statId,
                            year: year,
                            page: page
                        };
                        $.ajax({
                            url: "{{route('web.get.data')}}",
                            method: "GET",
                            data: body,
                            success: function(response){
                                const {html} = response;
                                $('#results').html(html);
                            },
                            error: function(xhr){
                                console.log(xhr);
                            }
                        });
                    } else {
                        console.log('here');
                    }
                }
            };

            getData();
        })(jQuery);
    </script>
</body>
</html>