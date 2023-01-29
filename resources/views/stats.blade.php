<table class="table table-hover table-responsive">
    <thead>
        <tr>
            <th>Player</th>
            <th>Statistics</th>
            <th>Value</th>
            <th>Year</th>
        </tr>
    </thead>
    <tbody>
        @foreach($stats as $stat)
        <tr>
            <td>{{$stat->firstname}} {{$stat->lastname}}</td>
            <td>{{$stat->param_name}}</td>
            <td>{{$stat->value}}</td>
            <td>{{$stat->match_year}}</td>
        </tr>
        @endforeach
    </tbody>
</table>

@if($total > $limit)
<div style="height: 30px;"></div>
<table width="50%" align="center">
    <tr>
        <td valign="top" align="left">
            <?php
            if ($current_page <= 1):
            ?>
            <a href="javascript:void(0);">Previous</a>
            <?php else:?>
                <a href="javascript:void(0);" id="prev">Previous</a>
            <?php endif;?>
        </td>
        <td valign="top" align="center">
            <?php
                for ($i = 1; $i <= $pageNumbers; $i++){
                if ($i == $current_page) {
                    ?> <a href="javascript:void(0);" class="current">
                            <?php echo $i; ?>
                    </a> <?php
                } else {
                    ?> <a href="javascript:void(0);" class="pages" data-page="{{$i}}">
                            <?php echo $i; ?>
                    </a> <?php
                } // endIf
            } // endFor

            ?>
        </td>
        <td align="right" valign="top">
        <?php
            if ($pageNumbers <= 1 || $pageNumbers == $current_page):
            ?>
            <a href="javascript:void(0);">Next</a>
            <?php else:?>
                <a href="javascript:void(0);" id="next">Next</a>
            <?php endif;?>
        </td>
    </tr>
</table>
@endif