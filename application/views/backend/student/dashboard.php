<div class="row">
	<div class="col-md-8">
    	<div class="row">
            <!-- CALENDAR-->
            <!-- <div class="col-md-12 col-xs-12">    
                <div class="panel panel-primary " data-collapsed="0">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <i class="fa fa-calendar"></i>
                            <?php //echo get_phrase('event_schedule');?>
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
            </div> -->
        </div>
    </div>
    
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
</div>
	

    <!-- <div class="col-md-12 pdng" style="margin-top: 30px;">
  <section class="container-fluid">
   <div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
<script src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>
  </section>
</div> -->


    <div id="header">
        <p id="txt_title">Percentage achievement in all subjects</p>
    </div>

    <div id="q2_2010">
    <div id="q1_2010">
    <div id="q4_2009">
    <div id="q3_2009">
    <div id="q2_2009">
    <div id="q1_2005">
        <div id="labels">
            <ul>
                <li><span></span>Western Vocal</li>
                <li><span></span>Piano</li>
                <li><span></span>Guitar</li>
                <li><span></span>Violin</li>
                <li><span></span>Hindustani Vocals</li>
            </ul>
        </div>
        <div id="pie_ico">Pie &raquo;</div>
        <div id="pyr_ico">&laquo; Pyramid</div>
        <div id="percentage_wrapper">
            <div id="percentage">
                <ul>
                    <li><p>60.14%</p><p>61.79%</p><p>63.90%</p><p>67.02%</p><p>68.28%</p><p>89.68%</p></li>
                    <li><p>24.98%</p><p>24.56%</p><p>24.39%</p><p>23.28%</p><p>23.22%</p><p>6.83%</p></li>
                    <li><p>7.14%</p><p>6.03%</p><p>4.27%</p><p>3.08%</p><p>2.35%</p><p>0%</p></li>
                    <li><p>5.10%</p><p>4.91%</p><p>4.64%</p><p>4.35%</p><p>3.89%</p><p>2.36%</p></li>
                    <li><p>2.66%</p><p>2.73%</p><p>2.52%</p><p>2.29%</p><p>2.27%</p><p>1.15%</p></li>
                </ul>
            </div>
        </div>
        <div id="slider">
            <div id="chart_holder">
                <div id="pie_chart">
                    <ul>
                        <li id="c1_r"><p><span class="pie_left"></span></p></li>    
                        <li id="c1_l"><p><span class="pie_right"></span></p></li>
                        <li id="c2_r"><p><span class="pie_left"></span></p></li>    
                        <li id="c2_l"><p><span class="pie_right"></span></p></li>
                        <li id="c3_r"><p><span class="pie_left"></span></p></li>    
                        <li id="c3_l"><p><span class="pie_right"></span></p></li>
                        <li id="c4_r"><p><span class="pie_left"></span></p></li>    
                        <li id="c4_l"><p><span class="pie_right"></span></p></li>
                        <li id="c5_r"><p><span class="pie_left"></span></p></li>    
                        <li id="c5_l"><p><span class="pie_right"></span></p></li>
                    </ul>
                </div>
                <div id="pyr_chart">
                    <ul>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                    </ul>
                </div>
            </div>
        </div>
        <div id="btn_panel">
            <ul>
                <li><a href="#q1_2005"><span>Q1</span><span>2013</span></a></li>
                <li><a href="#q2_2009"><span>Q2</span><span>2014</span></a></li>
                <li><a href="#q3_2009"><span>Q3</span><span>2015</span></a></li>
                <li><a href="#q4_2009"><span>Q4</span><span>2016</span></a></li>
                <li><a href="#q1_2010"><span>Q1</span><span>2017</span></a></li>
                <li><a href="#q2_2010"><span>Q2</span><span>2018</span></a></li>
            </ul>
        </div>
    </div> <!--q1_2005-->
    </div> <!--q2_2009-->
    </div> <!--q3_2009-->
    </div> <!--q4_2009-->
    </div> <!--q1_2010-->
    </div> <!--q2_2010-->

</div>



   <!--  <script>
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
						$notices	//=	$this->db->get('noticeboard')->result_array();
						//foreach($notices as $row):
						?>
						{
							title: "<?php// echo $row['notice_title'];?>",
							start: new Date(<?php //echo date('Y',$row['create_timestamp']);?>, <?php //echo date('m',$row['create_timestamp'])-1;?>, <?php //echo date('d',$row['create_timestamp']);?>),
							end:	new Date(<?php// echo date('Y',$row['create_timestamp']);?>, <?php// echo date('m',$row['create_timestamp'])-1;?>, <?php// echo date('d',$row['create_timestamp']);?>) 
						},
						<?php 
					//	endforeach
						?>
						
					]
				});
	});
  </script> -->

  
