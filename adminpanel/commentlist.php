<?php
session_start();
include('admin_header.php');
include('../connect.php');

if (isset($_POST['btnsearch'])) {
    $rdosearch=$_POST['rdosearch'];
    if ($rdosearch==1) {
        $cbomenu=$_POST['cbomenu'];
        $query="SELECT c.*,cu.customername as customername,m.menuname as menuname FROM comment c,customer cu,menu m WHERE c.customerid=cu.customerid AND c.menuid=m.menuid AND c.menuid='$cbomenu'";
        $result=mysqli_query($connection,$query);
        // echo "<script>window.alert('$cbopstatus')</script>";
    }
    else if ($rdosearch==2) {
        $cbocustomer=$_POST['cbocustomer'];
        $query="SELECT c.*,cu.customername as customername,m.menuname as menuname FROM comment c,customer cu,menu m WHERE c.customerid=cu.customerid AND c.menuid=m.menuid AND c.customerid='$cbocustomer'";
        $result=mysqli_query($connection,$query);
        // echo "<script>window.alert('$cbodstatus')</script>";
    }
}
else{
    $query="SELECT c.*,cu.customername as customername,m.menuname as menuname FROM comment c,customer cu,menu m WHERE c.customerid=cu.customerid AND c.menuid=m.menuid";
    $result=mysqli_query($connection,$query);
}

if (isset($_POST['btnall'])) {
    $query="SELECT c.*,cu.customername as customername,m.menuname as menuname FROM comment c,customer cu,menu m WHERE c.customerid=cu.customerid AND c.menuid=m.menuid";
    $result=mysqli_query($connection,$query);
}

?>
<html>
<head>
	<title></title>
</head>
<body>
    <div class="page-wrapper" style="background-color: white;">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-12 d-flex no-block align-items-center">
                    <!--                     <h4 class="page-title">Form Basic</h4> -->
                    <div class="ml-auto text-right">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Comment List</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid">
            <!-- ============================================================== -->
            <!-- Start Page Content -->
            <!-- ============================================================== -->
            <div class="row">
                <div class="col-md-12">
                    <form action="commentlist.php" method="post">
                        <div class="card border border-secondary rounded">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12"><h5 class="card-title">Search Options</h5></div>
                                    <div class="form-check col-md-6">
                                        <input class="form-check-input" type="radio" name="rdosearch" id="flexRadioDefault1" checked="" value="1" required="">
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            MenuID: 
                                        </label>
                                        <select name="cbomenu" class="custom-select w-50">
                                            <?php
                                            $mselect="SELECT * FROM menu";
                                            $mquery=mysqli_query($connection,$mselect);
                                            $mcount=mysqli_num_rows($mquery);
                                            if ($mcount<0) {
                                                ?>
                                                <option>No Record Found!!</option>
                                                <?php
                                            }
                                            else{
                                                for ($i=0; $i < $mcount ; $i++) { 
                                                    $marr=mysqli_fetch_array($mquery);
                                                    $menuid=$marr['menuid'];
                                                    $menuname=$marr['menuname'];
                                                    ?>
                                                    <option value="<?php echo $menuid ?>"><?php echo $menuname ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <br><br>   
                                    <div class="form-check col-md-6">
                                        <input class="form-check-input" type="radio" name="rdosearch" id="flexRadioDefault1" value="2" required="">
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            Customer: 
                                        </label>
                                        <select name="cbocustomer" class="custom-select w-50">
                                            <?php
                                            $cselect="SELECT * FROM customer";
                                            $cquery=mysqli_query($connection,$cselect);
                                            $ccount=mysqli_num_rows($cquery);
                                            if ($ccount<0) {
                                                ?>
                                                <option>No Record Found!!</option>
                                                <?php
                                            }
                                            else{
                                                for ($i=0; $i < $ccount ; $i++) { 
                                                    $carr=mysqli_fetch_array($cquery);
                                                    $customerid=$carr['customerid'];
                                                    $customername=$carr['customername'];
                                                    ?>
                                                    <option value="<?php echo $customerid ?>"><?php echo $customername ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-12 text-center">
                                        <br>
                                        <input type="submit" class="btn btn-outline-primary" name="btnsearch" value="Search">  <input type="submit" class="btn btn-outline-primary" name="btnall" value="Show All">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12"><h5 class="card-title">Comment List</h5></div>
                            </div>
                            <br>
                            <?php
                            // $query="SELECT * FROM tableorder";
                            // $result=mysqli_query($connection,$query);
                            $count=mysqli_num_rows($result);

                            if ($count<0) {
                                echo "<p>No Record Found!!</p>";
                            }
                            else{
                                ?>
                                <div class="table-responsive">
                                    <table id="zero_config" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>CommentID</th>
                                                <th>Comment</th>
                                                <th>Date</th>
                                                <th>Time</th>
                                                <th>CustomerName</th>
                                                <th>MenuName</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            for ($i=0; $i < $count ; $i++) { 
                                                $rows=mysqli_fetch_array($result);
                                                $commentid=$rows['commentid'];
                                                $comment=$rows['comment'];
                                                $date=$rows['commentdate'];
                                                $time=$rows['commenttime'];
                                                $customername=$rows['customername'];
                                                $menuname=$rows['menuname'];
                                                $newcomment=wordwrap($comment,50,"<br/>\n",true);

                                                echo "<tr>";
                                                echo "<td>".$commentid."</td>";
                                                echo "<td>".$newcomment."</td>";
                                                echo "<td>".$date."</td>";
                                                echo "<td>".$time."</td>";
                                                echo "<td>".$customername."</td>";
                                                echo "<td>".$menuname."</td>";
                                                echo "</tr>";
                                            }
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>CommentID</th>
                                                <th>Comment</th>
                                                <th>Date</th>
                                                <th>Time</th>
                                                <th>CustomerName</th>
                                                <th>MenuName</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <?php                                    
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End PAge Content -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Right sidebar -->
            <!-- ============================================================== -->
            <!-- .right-sidebar -->
            <!-- ============================================================== -->
            <!-- End Right sidebar -->
            <!-- ============================================================== -->
        </div>
    </body>
    </html>
    <?php
    include('admin_footer.php');
    ?>