<hr>
<div class="row">
    <div class="col-md-12 pdng">
        <div class="row">
            <div class="col-md-2">

                <div class="tile-stats tile-red">
                    <div class="icon"><i class="fa fa-group"></i></div>
                    <div class="num" data-start="0"
                                                data-end="
                                                    <?php
                                                        $number_of_student_in_current_session = $this->db->get_where('enroll', array('year' => $running_year))->num_rows();
                                                        echo $number_of_student_in_current_session;
                                                        //echo $this->db->count_all('student');
                                                    ?>
                                                    "
                            data-postfix="" data-duration="1500" data-delay="0">0</div>

                    <h3><?php echo get_phrase('student');?></h3>
                   <p>Total students</p>
                </div>

            </div>
            <div class="col-md-2">

                <div class="tile-stats tile-green">
                    <div class="icon"><i class="entypo-users"></i></div>
                    <div class="num" data-start="0" data-end="<?php echo $this->db->count_all('teacher');?>"
                            data-postfix="" data-duration="800" data-delay="0">0</div>

                    <h3><?php echo get_phrase('teacher');?></h3>
                   <p>Total Faculties</p>
                </div>

            </div>
            <div class="col-md-2">

                <div class="tile-stats tile-aqua">
                    <div class="icon"><i class="entypo-user"></i></div>
                    <div class="num" data-start="0" data-end="<?php echo $this->db->count_all('parent');?>"
                            data-postfix="" data-duration="500" data-delay="0">0</div>

                    <h3><?php echo get_phrase('parent');?></h3>
                   <p>Total parents</p>
                </div>

            </div>
            <div class="col-md-2">

                <div class="tile-stats tile-blue">
                    <div class="icon"><i class="entypo-chart-bar"></i></div>
                    <?php
                        $check  =   array(  'timestamp' => strtotime(date('Y-m-d')) , 'status' => '1' );
                        $query = $this->db->get_where('attendance' , $check);
                        $present_today      =   $query->num_rows();
                        ?>
                    <div class="num" data-start="0" data-end="<?php echo $present_today;?>"
                            data-postfix="" data-duration="500" data-delay="0">0</div>

                    <h3><?php echo get_phrase('attendance');?></h3>
                   <p> today present students </p>
                </div>

            </div>
            <div class="col-md-2">

                <div class="tile-stats tile-aqua">
                    <div class="icon"><i class="entypo-user"></i></div>
                    <div class="num" data-start="0" data-end="<?php echo $this->db->count_all('class');?>"
                            data-postfix="" data-duration="500" data-delay="0">0</div>

                    <h3><?php echo get_phrase('class');?></h3>
                   <p>Total Courses</p>
                </div>

            </div>

            <div class="col-md-2">

                <div class="tile-stats tile-aqua">
                    <div class="icon"><i class="entypo-user"></i></div>
                    <div class="num" data-start="0" data-end="<?php echo $this->db->count_all('rooms');?>"
                            data-postfix="" data-duration="500" data-delay="0">0</div>

                    <h3><?php echo get_phrase('rooms');?></h3>
                   <p>Total Rooms</p>
                </div>

            </div>
        </div>
    </div>
	<div class="col-md-12">
    	<div class="row">
            <!-- CALENDAR-->
            <div class="col-md-12 col-xs-12">
                <div class="panel panel-primary " data-collapsed="0">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <i class="fa fa-calendar"></i>
                            <?php echo get_phrase('event_schedule');?>
                        </div>
                    </div>
                    <div class="panel-body" style="padding:0px;">
                        <div class="calendar-env">
                            <div class="calendar-body">
                                <div id="notice_calendar"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

	

</div>



    <script>
  $(document).ready(function() {

      var calendar = $('#notice_calendar');

                $('#notice_calendar').fullCalendar({
                    header: {
                        left: 'title',
                        right: 'today prev,next'
                    },

                    //defaultView: 'basicWeek',

                    editable: false,
                    firstDay: 1,
                    height: 530,
                    droppable: false,

                    events: [
                        <?php
                        $notices    =   $this->db->join('class_routine', 'class_routine.room_id = rooms.room_id')->get('rooms')->result_array();

                        foreach($notices as $row):
                          
                        ?>
                        {
                            title: "<?php echo $row['room_name']." - Room No: ".$row['room_number']; ?>",

                            start: "<?php echo date('Y-m-d h:i:s',strtotime($row['class_started'])); ?>",
                            end:   "<?php echo date('Y-m-d h:i:s',strtotime($row['class_ended'])); ?>"
                        },
                        <?php
                        endforeach
                        ?>

                    ]
                });
    });
  </script>
