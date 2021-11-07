<?php
        require_once "../Econfig.php";
        
        $query1="Select DISTINCT id,name from employee";
        $result1=$mysqli->query($query1)
        //pre_r($result);
        //    pre_r($result->fetch_assoc());

        ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Employee Report</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.css" />


    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>
<style type="text/css">
  #grad{
     background-image: linear-gradient(-90deg, brown,orange,pink); 
    
  }
  .tr{
      color: #000000;
     }
  .tr2
  {
    color: #8B008B;
  }
  .pink{
    background:  #000000;
    color: #fff;
  }
  .outputC{
      color: #8B008B;
      font-size: 30px;
  }
</style>
<body id="grad">
 
 <a name="top"><div></div></a>

<header>
    <nav class="pink">
        <a href="main_report.php" class="navbar-brand">
            <h2 class="px-5">
                <i class="fa fa-reply" aria-hidden="true"></i>Back
            </h2>
        </a>
    </nav>
</header>


    <div class="container">
      
       
        <div class="row justify-content-center">
        <form class="text-white mt-3 font-weight-bold form-inline" action="Ereport.php" method="POST">
         <div class="form-group">
                <label class="mr-2"> Select Employee </label>
                <select name="medicine" id="type" class="form-control bg-dark text-white">
                  <?php 
                 
                  while($row1 =$result1->fetch_assoc() ){

                    $EId=$row1['id'];
                    $EName=$row1['name']
                  
                  ?>
                  <option value="<?php echo $EId; ?>"><?php echo $EName; ?></option>
<?php } ?>
                </select>
                <input type="submit" name="submit" class="btn btn-info ml-2">
            </div>
            </form>
            </div>



                   <div class="row justify-content-center">
            <table class="table text-white mt-5">
                <thead>
                    <tr> 
                        <th>Employee Name</th>
                        <th>Sales Order Id</th>
                        <th>Sales Amount</th>
                        <th>Purchase Date</th>
						<th>Sales Medicine Id</th>
                        <th>Medicine Name</th>   
                    </tr>
                </thead>

                <?php
                if(isset($_POST['submit'])){
                  $id=$_POST['medicine'];
                $result = $mysqli->query("SELECT employee.name,salesorder.so_id,salesorder.Total_amount,purchaseorder.po_date,purchaseorder.toat_amount,so_details.mid,medicine.Name
FROM employee INNER JOIN salesorder ON employee.id=salesorder.eid INNER JOIN so_details ON salesorder.so_id=so_details.so_id INNER JOIN medicine ON so_details.mid=medicine.id inner join purchaseorder on purchaseorder.mid=medicine.id where employee.id='$id'") or die($mysqli->error);
                while ($row = $result->fetch_assoc()) : ?>
                    <tr>
                        <td> <?php echo $row['name']; ?></td>
                        <td> <?php echo $row['so_id']; ?></td> 
                          <td> <?php echo $row['Total_amount']; ?></td> 
                          <td> <?php echo $row['po_date']; ?></td> 
                          <td> <?php echo $row['mid']; ?></td> 
						  <td> <?php echo $row['Name']; ?></td>
                    </tr>
                <?php endwhile; 
                }
                ?>
            </table>
</body>
</html>