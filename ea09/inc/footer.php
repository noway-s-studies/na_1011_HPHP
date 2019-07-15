    </div>
    <div id="footer">
        <?php
            $stop_time=microtime(true);
            $pagetime=$stop_time-$start_time;
            print "<div>Page generation time: $pagetime sec</div>";
            if($pagetime>0.3) add_log("SLOWPAGE", $url." ".$pagetime." sec");
            showprofilerdata();
        ?>
    </div>
  </div>
</body>
</html>
<?php
    $manager->closeConnection($conn);
    // $conn->close();
?>