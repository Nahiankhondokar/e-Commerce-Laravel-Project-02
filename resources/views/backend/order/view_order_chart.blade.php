@extends('backend.admin_master')

@section('admin')



<?php

    // date('M Y', strtotime('-0 month'))

    $month = array();
    $count = 0;
    while($count < 4 ){
        $month[] = date('M Y', strtotime('-'.$count.' month'));
        $count++;
    };

    $arr = array(
        array("y" => $orderCount[3], "label" =>  $month[3]),
        array("y" => $orderCount[2], "label" => $month[2]),
        array("y" => $orderCount[1], "label" => $month[1]),
        array("y" => $orderCount[0], "label" => $month[0]),
    );

?>

<script>
    window.onload = function() {
     
    var chart = new CanvasJS.Chart("chartContainer", {
        animationEnabled: true,
        theme: "light2",
        title:{
            text: "Order Reports"
        },
        axisY: {
            title: "Number of orders"
        },
        data: [{
            type: "column",
            yValueFormatString: "#,##0.## tonnes",
            dataPoints: <?php echo json_encode($arr, JSON_NUMERIC_CHECK); ?>
        }]
    });
    chart.render();
     
    }
</script>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Invertory Features</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Order Reports</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Order Reports</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div id="chartContainer" style="height: 370px; width: 100%;"></div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

@endsection