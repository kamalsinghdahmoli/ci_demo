
<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
 <div class="br-pageheader">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
          <a class="breadcrumb-item" href="#">Rooms</a>
          <span class="breadcrumb-item active">All Rooms</span>
        </nav>
      </div><!-- br-pageheader -->
      <div class="br-pagetitle">
        <i class="icon ion-ios-gear-outline"></i>
        <div>
          <h4> All Rooms</h4>
        </div>
      </div><!-- d-flex -->
      <div class="br-pagebody">
        <div class="br-section-wrapper">
          <div class="bd bd-gray-300 rounded table-responsive">
            <table class="table table-striped mg-b-0">
              <thead>
               <tr>
                   
                    <th>Room Name</th>
                    <th>Room Number</th> 
                    <th>Update</th>
                  </tr>
              </thead>
              <tbody>
                   <?php foreach ($rooms as $room) { ?>
                    <tr>
                  
                        
                        <td><?php echo $room['room_name']; ?></td>

                        <td><?php echo $room['room_number']; ?></td> 
                   
                        <td><a href="<?php echo base_url()."admin/rooms/edit_room/".$room['room_id']; ?>">Update</a></td>



                    </tr>
  
                  <?php } ?>
                  
          
              </tbody>
            </table>
          </div>
        
        </div><!-- br-section-wrapper -->
      </div><!-- br-pagebody -->