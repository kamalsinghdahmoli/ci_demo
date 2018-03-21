<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
      <div class="br-pageheader">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
          <a class="breadcrumb-item" href="#">Rooms</a>
          <span class="breadcrumb-item active">Create Room</span>
        </nav>
      </div><!-- br-pageheader -->
      <div class="br-pagetitle">
        <i class="icon ion-ios-gear-outline"></i>
        <div>
          <h4> Create Room</h4><small style="color: #0753A1;"><?php echo  $message; ?></small>
         
        </div>
      </div><!-- d-flex -->

      <div class="br-pagebody">
        <div class="br-section-wrapper">
        

          <div class="row text">
            <div class="col-md-6">
               <?php echo validation_errors(); ?>
              <?php echo form_open("admin/rooms/add_room", array('role' => 'form', 'enctype' => 'multipart/form-data')); ?>
          
                <div class="form-group">
                  <label for="Category Name"> Room Name<sup>*</sup></label>
                  <input type="text" name="roomname" id="roomname" class="form-control" />
                </div>

                <div class="form-group">
                  <label for="post Slug"> Room Number<sup>*</sup></label>
                  <input type="text" name="roomnumber" id="roomnumber" class="form-control" value="" />
                </div>

                <input type="submit" name="submit" id="submit" value="Submit" class="form-control btn btn-primary" /> 
      
            <?php echo form_close();?>
           
            </div><!-- col -->
            
          </div><!-- row -->

        </div><!-- br-section-wrapper -->
      </div><!-- br-pagebody -->
      
   


