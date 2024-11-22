<?php include ('session.php');?>
<?php include ('head.php');?>

<body>
<script>
let sessionTimeout;
const TIMEOUT_DURATION = 10000000; // 10 seconds

function startSessionTimer() {
    // Clear any existing timeout
    clearTimeout(sessionTimeout);
    
    // Set new timeout
    sessionTimeout = setTimeout(() => {
        // First try to logout properly through AJAX
        fetch('ajax.php?action=logout')
            .then(response => {
                window.location.href = 'index.php';
            })
            .catch(() => {
                // If AJAX fails, redirect anyway
                window.location.href = 'index.php';
            });
    }, TIMEOUT_DURATION);
}

function resetSessionTimer() {
    startSessionTimer();
    
    fetch('keep_alive.php')
        .catch(error => console.log('Error keeping session alive:', error));
}

document.addEventListener('DOMContentLoaded', startSessionTimer);

// Reset timer on user activity
['mousemove', 'keypress', 'click', 'scroll', 'touchstart'].forEach(event => {
    document.addEventListener(event, resetSessionTimer);
});

// Handle tab visibility
document.addEventListener('visibilitychange', function() {
    if (document.visibilityState === 'visible') {
        fetch('check_session.php')
            .then(response => response.json())
            .then(data => {
                if (!data.valid) {
                    window.location.href = 'index.php';
                } else {
                    resetSessionTimer();
                }
            })
            .catch(() => {
                window.location.href = 'index.php';
            });
    }
});

window.addEventListener('beforeunload', function() {
    clearTimeout(sessionTimeout);
});
</script>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include ('side_bar.php');?>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header">Candidates List</h3>
					
                </div>
				
				<button class="btn btn-success" data-toggle="modal" data-target="#myModal">Add Candidate</button>
				<?php include ('add_candidate_modal.php');?>
                <!-- /.col-lg-12 -->
				
				
				<hr/>
				
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="modal-title" id="myModalLabel">         
												<div class="panel panel-primary">
													<div class="panel-heading">
														Candidates List
													</div>    
												</div>
											</h4>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                         
                                            <th>Position</th>
                                            <th>Firstname</th>
                                            <th>Lastname</th>
                                            <th>Year Level</th>
                                            <th>Gender</th>
                                            <th>Image</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									
                                        <tr>
										<?php 
											require 'dbcon.php';
											$bool = false;
											$query = $conn->query("SELECT * FROM candidate ORDER BY candidate_id DESC");
												while($row = $query->fetch_array()){
													$candidate_id=$row['candidate_id'];
										?>
											
											<td><?php echo $row ['position'];?></td>
                                            <td><?php echo $row ['firstname'];?></td>
                                            <td><?php echo $row ['lastname'];?></td>
                                            <td><?php echo $row ['year_level'];?></td>
                                            <td><?php echo $row ['gender'];?></td>
                                            <td width="50"><img src="<?php echo $row['img']; ?>" width="50" height="50" class="img-rounded"></td>
                                            
                                            <td style="text-align:center">
											
												 <a rel="tooltip"  title="Delete" id="<?php echo $candidate_id; ?>" href="#delete_user<?php echo $candidate_id; ?>" data-target="#delete_user<?php echo $candidate_id?>" data-toggle="modal"class="btn btn-danger btn-outline"><i class="fa fa-trash-o"></i> Delete</a>	
											 <?php include ('delete_candidate_modal.php'); ?>
												  <a rel="tooltip"  title="Edit" id="<?php echo $row['candidate_id'] ?>" href="#edit_candidate<?php echo $row['candidate_id'] ?>"  data-toggle="modal"class="btn btn-success btn-outline"><i class="fa fa-pencil"></i> Edit</a>	
												
											</td>
														
											    <?php 
													
													require 'edit_candidate_modal.php';
												?>
                                        </tr>
										
                                       <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                            
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
              
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->



    </div>
    <!-- /#wrapper -->
    <script type="text/javascript">
  // Timeout duration in milliseconds (e.g., 1 minute = 60000 milliseconds)
  var timeoutDuration = 60000;

  // Timer variable to hold the timeout
  var timeoutTimer;

  // Function to reset the timer
  function resetTimer() {
    clearTimeout(timeoutTimer);
    timeoutTimer = setTimeout(logout, timeoutDuration);
  }

  // Function to perform logout
  function logout() {
    // Redirect to logout.php page
    window.location.href = 'logout.php';
  }

  // Event listeners to reset timer on user activity
  document.addEventListener('mousemove', resetTimer);
  document.addEventListener('keydown', resetTimer);

  // Initial call to resetTimer to start the timeout countdown
  resetTimer(); 
  </script>
    <?php include ('script.php');?>

</body>

</html>

