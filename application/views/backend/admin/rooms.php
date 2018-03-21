
<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
 
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
                   
                        <td><a href="<?php echo base_url()."rooms/update_room/".$room['room_id']; ?>">Update</a></td>



                    </tr>
  
                  <?php } ?>
                  
          
              </tbody>
            </table>
          </div>
        
        </div><!-- br-section-wrapper -->
      </div><!-- br-pagebody -->