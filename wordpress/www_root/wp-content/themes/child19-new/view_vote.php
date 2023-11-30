<?php
    wp_enqueue_script( 'viewApplyJs', get_theme_file_uri() . '/js/view_vote.js', array('jquery'), '', true );

    global $wpdb;
    $query = "SELECT COUNT(g1l) AS total, SUM(g1l) AS g1l, SUM(g2l) AS g2l, SUM(g3l) AS g3l, SUM(g4l) AS g4l, SUM(t1) AS t1, SUM(t2) AS t2, SUM(t3) AS t3, SUM(t4) AS t4, SUM(t5) AS t5, SUM(t6) AS t6, SUM(t7) AS t7, SUM(t8) AS t8 FROM wp_vote";
    $result = $wpdb->get_results($query)[0];
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<!-- <head> -->
<!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css"/>
<link rel="stylesheet" href="https://cdn.datatables.net/select/1.3.3/css/select.dataTables.min.css"/>
<script src="https://code.jquery.com/jquery-3.5.1.js" ></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js" ></script>
<script src="https://cdn.datatables.net/select/1.6.2/js/dataTables.select.min.js" ></script> -->

<!-- </head> -->
<div>
    <!-- <button type="submit" class="conver_to_checked" style="float:right; margin-top:20px; margin-right:20px;">표시하기</button>
    <button type="submit" class="conver_to_unchecked" style="float:right; margin-top:20px; margin-right:20px;">감추기</button>
    <button type="submit" class="conver_to_completed" style="float:right; margin-top:20px; margin-right:20px;">접수완료처리</button> -->
    <div></div>
    <h2>1차 그룹 투표 현황</h2>
    <table id="example" class="display" style="width:100%; text-align: center; background: white;">
        <thead>
            <tr>
                <th>1-1</th>
                <th>1-2</th>
                <th>2-1</th>
                <th>2-2</th>
                <th>3-1</th>
                <th>3-2</th>
                <th>4-1</th>
                <th>4-2</th>
            </tr>
        </thead>
        <tbody>
            <?php if($result->total > 0) { ?> 
            <tr>
                <td><?php echo number_format(($result->g1l ?? 0))?>명</td>
                <td><?php echo number_format(($result->total - $result->g1l) ?? 0 )?>명</td>
                <td><?php echo number_format($result->g2l ?? 0 )?>명</td>
                <td><?php echo number_format(($result->total - $result->g2l) ?? 0 )?>명</td>
                <td><?php echo number_format($result->g3l ?? 0 )?>명</td>
                <td><?php echo number_format(($result->total - $result->g3l) ?? 0 )?>명</td>
                <td><?php echo number_format($result->g4l ?? 0 )?>명</td>
                <td><?php echo number_format(($result->total - $result->g4l) ?? 0 )?>명</td>
            </tr>
            <tr>
                <td><?php echo number_format(($result->g1l ?? 0) / $result->total * 100, 0)?>%</td>
                <td><?php echo number_format((($result->total - $result->g1l) ?? 0) / $result->total * 100, 0) ?>%</td>
                <td><?php echo number_format(($result->g2l ?? 0) / $result->total * 100, 0) ?>%</td>
                <td><?php echo number_format((($result->total - $result->g2l) ?? 0) / $result->total * 100, 0) ?>%</td>
                <td><?php echo number_format(($result->g3l ?? 0) / $result->total * 100, 0) ?>%</td>
                <td><?php echo number_format((($result->total - $result->g3l) ?? 0) / $result->total * 100, 0) ?>%</td>
                <td><?php echo number_format(($result->g4l ?? 0) / $result->total * 100, 0) ?>%</td>
                <td><?php echo number_format((($result->total - $result->g4l) ?? 0) / $result->total * 100, 0) ?>%</td>
            </tr>
            <?php } else { ?> 
                
                <tr>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                </tr>    
                <tr>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                </tr>  
                <?php } ?>
        </tfoot>
    </table>
    <h2>2차 그룹 투표 현황</h2>
    <table id="example" class="display" style="width:100%; text-align: center; background: white;">
        <thead>
            <tr>
                <th>팀1</th>
                <th>팀2</th>
                
                <th>팀3</th>
                <th>팀4</th>
                
                <th>팀5</th>
                <th>팀6</th>
                
                <th>팀7</th>
                <th>팀8</th>
            </tr>
        </thead>
        <tbody>
        <?php if($result->total > 0) { ?> 
                <tr>
                    <td><?php echo number_format($result->t1 ?? 0) ?>명</td>
                    <td><?php echo number_format($result->t2 ?? 0) ?>명</td>
                    <td><?php echo number_format($result->t3 ?? 0) ?>명</td>
                    <td><?php echo number_format($result->t4 ?? 0) ?>명</td>
                    <td><?php echo number_format($result->t5 ?? 0) ?>명</td>
                    <td><?php echo number_format($result->t6 ?? 0) ?>명</td>
                    <td><?php echo number_format($result->t7 ?? 0) ?>명</td>
                    <td><?php echo number_format($result->t8 ?? 0) ?>명</td>
                </tr>
                <tr>
                    <td><?php echo number_format(($result->t1 ?? 0) / $result->total * 100) ?>%</td>
                    <td><?php echo number_format(($result->t2 ?? 0) / $result->total * 100) ?>%</td>
                    <td><?php echo number_format(($result->t3 ?? 0) / $result->total * 100) ?>%</td>
                    <td><?php echo number_format(($result->t4 ?? 0) / $result->total * 100) ?>%</td>
                    <td><?php echo number_format(($result->t5 ?? 0) / $result->total * 100) ?>%</td>
                    <td><?php echo number_format(($result->t6 ?? 0) / $result->total * 100) ?>%</td>
                    <td><?php echo number_format(($result->t7 ?? 0) / $result->total * 100) ?>%</td>
                    <td><?php echo number_format(($result->t8 ?? 0) / $result->total * 100) ?>%</td>
                </tr>
                <?php } else { ?> 
                    <tr>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                </tr>    
                <tr>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                </tr>  
                    <?php } ?>
        </tfoot>
    </table>
</div>