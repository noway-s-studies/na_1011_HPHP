<?php

    $profiler_startdata = array();
    $profiler_stopdata = array();

    function startprofiler($name) {
        global $profiler_startdata;
        $profiler_startdata[$name]=microtime(true);
    }
    function stopprofiler($name) {
        global $profiler_stopdata;
        $profiler_stopdata[$name]=microtime(true);
    }
    function showprofilerdata() {
        global $profiler_startdata;
        global $profiler_stopdata;
        print "<table>";
        print "<tr><th>Name</th><th>Time</th></tr>";
        foreach ($profiler_stopdata as $name => $stop) {
            $start=$profiler_startdata[$name];
            $time=$stop-$start;
            print "<tr><td>$name</td><td>$time</td></tr>";
        }
        print "</table>";
    }

?>
