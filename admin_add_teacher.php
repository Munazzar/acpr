<?php
    session_start();
    error_reporting(0);

    if(!isset($_SESSION['username']))
    {
        header("location:login.php");
    }
    elseif($_SESSION['usertype']=="student")
    {
        header("location:login.php");
    }

    $host="localhost";
    $user="root";
    $password="";
    $db = "acpr";
    $data=mysqli_connect($host,$user,$password,$db);

    $formData = array();

    $rowno = 0;
    $total_records = 0;
    
    $table = "temp_teacher";
    // Get the current page number
    
    $page = (isset($_GET['page'])) ? $_GET['page'] : 1;
    
    // Paginate the results
    $records_per_page = 10;
    
    $offset = ($page - 1) * $records_per_page;
    

    if (isset($_FILES['filename'])) {
        // Get the file name

        $file_name = $_FILES['filename']['name'];
        $file_type = $_FILES['filename']['type'];

        // Check if the file is a PDF
        if ($file_type == 'application/pdf') {
            // Upload the file to the server
            //--recorded firle somewhere
            //------
                $name = 'khaja';
                $desc = 'test1';
                
                $file_name = rand(100,1000) . "_" . $_FILES['filename']['name'];
        
                $imgData=addslashes(file_get_contents($_FILES['filename']['tmp_name']));
                //$imgData=file_get_contents($_FILES['filename']['tmp_name']);
        
                $file_path = $_FILES["filename"]["tmp_name"];
        
                $uploads_dir='/files';
                
                move_uploaded_file($file_path, $uploads_dir.'/'.$file_name);   
                
                $pdf = file_get_contents($uploads_dir . '/' . $file_name);
                $number = preg_match_all("/\/Page\W/", $pdf, $dummy);

            //-----
    
            $db_mobile = "9700654";
            $db_fname  = $file_name;
            $db_ldata  = $imgData;
            $db_pages  = $number;
            
            $sql="INSERT INTO temp_TEACHER (mobile, file_name, long_file, No_of_pages) VALUES ('$db_mobile', '$db_fname', '{$db_ldata}', '$db_pages')";
            $result = mysqli_query($data, $sql);

                if(!$result)
                {
                    $message="Data upload failed";
                    echo "<script type='text/javascript'>
                        alert('$message');
                    </script>";
                }

                $dsql = "select * From temp_teacher a where a.id = (select max(b.id) from temp_teacher b)";
                $result = mysqli_query($data, $dsql);
                $info=$result->fetch_assoc();

                $total_cnt_result = mysqli_query($data, "select count(*) total from temp_teacher");
                $tcr_info=$total_cnt_result->fetch_assoc();

                $total_records = $tcr_info['total'];
                $_SESSION['TOTALRECORDS'] = $total_records;
        } 
    } 

    

    if(isset($_POST['add_teacher']))
    //if($info['id'] !== null)
    {
        $jobseqno = $_REQUEST['jobseqno'];
        $printtype = $_REQUEST['printtype'];
        $colortype = $_REQUEST['colortype'];
        $noofpages = $_REQUEST['noofpages'];
        $bwrange = $_REQUEST['bwrange'];
        $clrange = $_REQUEST['clrange'];

        if($bwrange == null && $clrange == null) 
        {
            if($colortype == 'C') {
                if($printtype == 'SS') { $noclrpages = $noofpages; }
                elseif($printtype == 'BS') { $noclrpages = ceil($noofpages/2); }
            }
            elseif($colortype == 'BW') {
                if($printtype == 'SS') { $noofbwpages = $noofpages; }
                elseif($printtype == 'BS') { $noofbwpages = ceil($noofpages/2); }
            }
        }
        elseif($bwrange == null && $clrange !== null) 
        {
            if($colortype == 'C') {
                if($printtype == 'SS') 
                { 
                    $noofclrpages = $noofpages; 
                }
                $noofbwpages =0;
            }
        }
        elseif(!$bwrange == null && $clrange == null) 
        {
                if($printtype == 'SS') { 
                    $nobwpages = $noofpages; 
                    $noofclrpages = $noofpages; }
                $noofclrpages = 0;
        }

        $papersize = $_REQUEST['papersize'];
        $papertype = $_REQUEST['papertype'];
        $bindingtype = $_REQUEST['bindingtype'];
        $bindingcolor = $_REQUEST['bindingcolor'];
        $noofcopies = $_REQUEST['noofcopies'];

        if($noofcopies == 1 || $noofcopies == null )
        {   $totbwpages = $noofbwpages; 
            $totclrpages = $noofclrpages; 
        }
        else 
        {
            $totbwpages = $noofbwpages * $noofcopies;
            $totclrpages = $noofclrpages * $noofcopies;
        }

        $usql = "update temp_teacher set " . 
                " paper_size ='$papersize',	" .
                " paper_type ='$papertype',	" .	 	
                " print_type ='$printtype',	" .	 	
                " color_type ='$colortype',	" .	 	
                " color_range ='$clrange',	" .	 	
                " bw_range ='$bwrange',	" .	  	
                " binding_type ='$bindingtype',	" .	 	
                " binding_color ='$bindingcolor',	" .	 
                " no_of_clr_pages ='$noclrpages',	" .	 
                " no_of_bw_pages ='$nobwpages',	" .	 
                " tot_bw_pages ='$totbwpages',	" .	
                " tot_clr_pages ='$totclrpages',	" .	
                " no_of_copies ='$noofcopies'" .
                " where id='$jobseqno'";	 	
                
        $result = mysqli_query($data, $usql);

        if(!$result)
        {
            $message="Details update failed";
            echo "<script type='text/javascript'>
                alert('$message');
            </script>";
        }
        else
        {
            
            $tdsql = "select * From temp_teacher order by id";	

            //$offset = ($page - 1) * $records_per_page;
            //$tdsql .= " LIMIT $offset, $records_per_page";
                      
            $tresult = mysqli_query($data, $tdsql);
            //$total_records = $_SESSION['TOTALRECORDS'];
            //$tinfo=$tresult->fetch_assoc();
        }                    
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF.js Example to count number of pages in pdf document</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    
    <title> Admin Dashboard</title>

    <style type="text/css">
        
        .content
        {
            margin-left: 17%;
            margin-top: 1%;
            background-color:skyblue;
            width: 1650px;
            height: 870px;
            display: inline-bloc;
            gap: 3em;
            padding: 0 40px;
            
        }

        .dev_deg 
        {
            background-color:#d5cfce;
            margin-left: .25%;
            width: 600px;
            height: 650px;
            padding-left: 5px;
            border-radius: 10px;
            display: inline-block;
            float:left;
        }
        .dev_deg_cal 
        {
            background-color:#d5cfce;
            margin-left: 1%;
            width: 900px;
            height: 650px;
            padding-left: 5px;
            border-radius: 10px;
            display: inline-block;
            float:left;
            overflow-y: auto; 
        }

        label 
        {
            font-size:16px;
            text-align: left;
            width: 100px;
            display: block;
            padding-bottom:5px;
            padding-top:1px;
            padding-right:10px;
            color:blue;
        }

        input[type="text"] 
        {
            text-align: left;
            width: 200px;
            height: 40px;
            margin-bottom:5px;
            
            
            
        }

        .lov_container
        {
			display: flex;
			object-fit:cover;
        }

        .select-box
        {
            display: flex;
			object-fit:cover;
            width: 200px;
            height: 40px;
            margin-bottom:5px;
        }
    </style>

    <?php
        include 'admin_css.php';
    ?>


</head>
    <body>
        <?php
            include 'admin_sidebar.php';
        ?>
        
        <div class="content">
            <h1>Document Printing(s)</h1>
            <div>   
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" class="" action="" method="POST" enctype="multipart/form-data">
                    <div  class="dev_deg">
                            <div>
                                <label>Job Id.</label> <input type="text" id="jobid" name="jobid" disabled="disabled" size="100">    
                                <label>Upload File</label> <input type="file" name="filename" id="filename" accept=".pdf"  class="select-box" onchange="this.form.submit()"/>
                                <input type="text" id="file_name" name="file_name"  placeholder="File Name"  size="100" class="select-box-file" value="<?php echo "{$info['file_name']}"; ?>"/>
                                <label>Job Sequence no.</label> <input type="text" id="jobseqno" name="jobseqno"  size="100"  value="<?php echo "{$info['id']}"; ?>"/>
                            </div>

                            <div  class="lov_container">
                                <label>Print Type</label>    
                                <select name="printtype" id="printtype" class="select-box" value="<?php echo "{$info['print_type']}"; ?>" >
                                    <option value="SS">Single Side Print</option>
                                    <option value="BS">Both Side Print</option>
                                </select>
                            </div>

                            <div  class="lov_container">
                                <label>Color Type</label>  
                                <select  name="colortype" id="colortype" placeholder="Color Type" class="select-box" value="<?php echo "{$info['color_type']}"; ?>">
                                    <option value="BW">Black and White</option>
                                    <option value="C">Color</option>
                                    <option value="B">Both</option>
                                </select>
                            </div>

                            <div>
                                <input type="text" id="noofpages" name="noofpages"  placeholder="Total No of pages"  class="select-box" value="<?php echo "{$info['no_of_pages']}"; ?>"/>
                            </div>
                            
                            <div>
                                <textarea id="bwrange" name="bwrange" rows="2" cols="80" placeholder="Black and White Range" value="<?php echo "{$info['bw_range']}"; ?>"></textarea>
                            </div>

                            <div>
                                <textarea id="clrange" name="clrange" rows="2" cols="80" placeholder="Color Range" value="<?php echo "{$info['color_range']}"; ?>"></textarea>
                            </div>

                            <div class="lov_container">
                                <div>
                                    <label>Paper Size</label>  
                                    <select  name="papersize" id="papersize" class="select-box" value="<?php echo "{$info['paper_size']}"; ?>">
                                        <option value="A4">A4</option>
                                        <option value="FS">Legal/Full-Scape</option>
                                        <option value="A3">A3</option>
                                    </select>
                                </div>
                                
                                <div>
                                    <label>Paper Type</label>  
                                    <select  name="papertype" id="papertype" class="select-box" value="<?php echo "{$info['paper_type']}"; ?>">
                                        <option value="N">Normal</option>
                                        <option value="B">Bond</option>
                                        <option value="M">Mat</option>
                                        <option value="G">Glossy</option>
                                    </select>
                                </div>
                            </div>
                            <div class="lov_container">    
                                <div>
                                    <label>Binding Type</label>  
                                    <select  name="bindingtype" id="bindingtype" class="select-box" value="<?php echo "{$info['binding_type']}"; ?>">
                                        <option value="N">None</option>
                                        <option value="S">Spirall Binding</option>
                                        <option value="P">Project Binding</option>
                                        <option value="T">Thermal Binding</option>
                                    </select>
                                </div>
                                <div>
                                    <label>Binding Color</label>  
                                    <select  name="bindingcolor" id="bindingcolor" class="select-box" value="<?php echo "{$info['binding_color']}"; ?>">
                                        <option value="N">None</option>
                                        <option value="BL">Blue</option>
                                        <option value="Y">Yello</option>
                                        <option value="G">Grey</option>
                                        <option value="R">Red</option>
                                        <option value="GR">Green</option>
                                        <option value="P">Purple</option>
                                    </select>
                                </div>
                                <div>
                                    <label>No of copies</label>
                                    <input type="text" name="noofcopies"  placeholder="No of Copies" class="select-box" value="<?php echo "{$info['no_of_copies']}"; ?>"/>
                                </div>
                            </div>
                            
                                <div>
                                    
                                    <button type="submit" name="add_teacher" class="btn btn-primary">Add Teacher</button>
                                </div>
                            
                    </div>
                    
                </form>
            </div>
                <div class="dev_deg_cal">
                        <h1>Multiple file details Data</h1>
                        <table border="1px">
                        <div>
                            <div style=" display: inline-block;">
                            <tr>
                                <th class="table_th">Sl#</th>
                                <th class="table_th">File</th>
                                <th class="table_th">Tot Pages</th>
                                <th class="table_th">B/W Pages</th>
                                <th class="table_th">Cl Pages</th>
                                <th class="table_th">Copies</th>
                                <th class="table_th">Total B/W Pages</th>
                                <th class="table_th">Total Clr Pages</th>
                            </tr>
                            </div>
                            <?php

                                while($tinfo=$tresult->fetch_assoc())
                                {
                            ?>
                            <div >
                                <tr>
                                    <td class="table_td"> <?php echo "{$tinfo['id']}"; ?></th>
                                    <td class="table_td"> <?php echo "{$tinfo['file_name']}"; ?></th>
                                    <td class="table_td"> <?php echo "{$tinfo['no_of_pages']}"; ?></th>
                                    <td class="table_td"> <?php echo "{$tinfo['no_of_bw_pages']}"; ?></th>
                                    <td class="table_td"> <?php echo "{$tinfo['no_of_clr_pages']}"; ?></th>
                                    <td class="table_td"> <?php echo "{$tinfo['no_of_copies']}"; ?></th>
                                    <td class="table_td"> <?php echo "{$tinfo['tot_bw_pages']}"; ?></th>
                                    <td class="table_td"> <?php echo "{$tinfo['tot_clr_pages']}"; ?></th>
                                    <td class="table_td"> <?php echo "<a class='btn btn-danger' onClick=\" javascript:return confirm('Are you sure to delete this user?'); \" href='delete.php?student_id={$info['id']}'>Delete</a>"; ?></th>
                                </tr>
                            </div>
                            <?php
                                }
                            ?>
                        </div>
                        </table>
                    
                    
                </div> 
        </div>
    </body>
</html>



