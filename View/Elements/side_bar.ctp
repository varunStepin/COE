<!-- LCompaniesolumn. contains the logo and sidebar -->
<style>
    .sidebar-menu>li>a>.fa {
        margin-right: 1px;
    }
</style>
<aside class="main-sidebar">
    <!-- sidebar-->
    <section class="sidebar">

        <!-- sidebar menu-->
        <ul class="sidebar-menu" data-widget="tree">
            <li class='mt-10'>
                <?php echo $ApplicationType;
                echo $this->Html->link('<i class="fa fa-dashboard"></i> <span>Dashboard</span>', array("controller" => "Admin", "action" => "dashboard"), array("escape" => false)); ?>
            </li>
            <?php $userType = $this->Session->read('USER_TYPE');
            $ApplicationType = $this->Session->read('ApplicationType');
            if ($ApplicationType == 'COE') {
                if ($userType == 'Admin' || $userType == 'DATA SCIENCE AND AI') { ?>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-share"></i> <span>K-tech COE for DS&AI</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="treeview ">
                                <a href="#">
                                    <span>Innovators Accelerated</span>
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-right pull-right"></i>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <!-- <li class="last-menu Mentors"><?php //echo $this->Html->link('<span>Mentors</span>', array("controller" => "Home", "action" => "listMentor"), array("escape" => false)); 
                                                                        ?></li>-->
                                    <li class="last-menu startupsAcceleratedPhysical"><?php echo $this->Html->link('<span>Start-ups Accelerated Physical</span>', array("controller" => "DsAndAi", "action" => "startupsAcceleratedPhysicalList"), array("escape" => false)); ?></li>
                                    <li class="last-menu startupsAcceleratedVirtual"><?php echo $this->Html->link('<span>Start-ups Accelerated Virtual</span>', array("controller" => "DsAndAi", "action" => "startupsAcceleratedVirtualList"), array("escape" => false)); ?></li>
                                    <!-- <li class="last-menu investorConnect"><?php //echo $this->Html->link('<span>Investor connect prgm</span>', array("controller" => "Home", "action" => "investorConnect"), array("escape" => false)); 
                                                                                ?></li>
                            <li class="last-menu marketResearch"><?php //echo $this->Html->link('<span>Market research </span>', array("controller" => "Home", "action" => "marketResearch"), array("escape" => false)); 
                                                                    ?></li>-->
                                </ul>
                            </li>
                            <li class="treeview">
                                <a href="#">
                                    <span>Research Projects</span>
                                    <span class="pull-right-container"><i class="fa fa-angle-right pull-right"></i> </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li class="last-menu ReportsPublished"><?php echo $this->Html->link('<span>Reports Published</span>', array("controller" => "DsAndAi", "action" => "reportPublished"), array("escape" => false)); ?></li>
                                    <li class="last-menu ReportsProcess"><?php echo $this->Html->link('<span>Reports Process</span>', array("controller" => "DsAndAi", "action" => "reportProcess"), array("escape" => false)); ?></li>
                                </ul>
                            </li>
                            <li class="treeview">
                                <a href="#">
                                    <span>POC – Societal & Enterprise</span>
                                    <span class="pull-right-container"><i class="fa fa-angle-right pull-right"></i> </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li class="last-menu solutionSupport"><?php echo $this->Html->link('<span>Solutions supported </span>', array("controller" => "Home", "action" => "solutionSupport"), array("escape" => false)); ?></li>
                                    <!--<li class="last-menu solutionProposed"><?php //echo $this->Html->link('<span>Solution Proposed</span>', array("controller" => "DsAndAi", "action" => "solutionProposed"), array("escape" => false)); 
                                                                                ?></li>
                            -->
                                    <li class="last-menu liasoningDept"><?php echo $this->Html->link('<span>Depts Liasoning & Followup  </span>', array("controller" => "Home", "action" => "liasoningDept"), array("escape" => false)); ?></li>
                                    <!--<li class="last-menu deptFollowup"><?php //echo $this->Html->link('<span>Dept followup </span>', array("controller" => "Home", "action" => "deptFollowup"), array("escape" => false)); 
                                                                            ?></li>-->
                                    <!-- <li class="last-menu hackathons"> <?php //echo $this->Html->link('<span>Hackathons </span>', array("controller" => "Home", "action" => "hackathon"), array("escape" => false)); 
                                                                            ?></li>-->
                                    
                                </ul>
                            </li>
                            <li class="last-menu SolutionsAdopted"><?php echo $this->Html->link('<span>Enterprise Solutions Adopted</span>', array("controller" => "DsAndAi", "action" => "solutionsAdoptedList"), array("escape" => false)); ?></li>
                            <li class="treeview ">
                                <a href="#">
                                    <span>Data science & AI</span>
                                    <span class="pull-right-container"><i class="fa fa-angle-right pull-right"></i> </span>
                                </a>
                                <ul class="treeview-menu">
                                    <!--  <li class="last-menu enrolledTrainer"><?php //echo $this->Html->link('<span>No. of Trainers enrolled</span>', array("controller" => "Home", "action" => "enrolledTrainer"), array("escape" => false)); 
                                                                                ?></li>
                            <li class="last-menu hackathon"><?php //echo $this->Html->link('<span>No. of Hackathons </span>', array("controller" => "Home", "action" => "hackathon"), array("escape" => false)); 
                                                            ?></li>
                            <li class="last-menu trainee"><?php //echo $this->Html->link('<span>No. of Trainees </span>', array("controller" => "Home", "action" => "trainee"), array("escape" => false)); 
                                                            ?></li>
                            <li class="last-menu traineeSecuredJob"><?php //echo $this->Html->link('<span>No. of trainees secured job  </span>', array("controller" => "Home", "action" => "traineeSecuredJob"), array("escape" => false)); 
                                                                    ?></li>
-->
                                    <li class="last-menu studentsTrainedList"><?php echo $this->Html->link('<span>No. of Student Trained</span>', array("controller" => "DsAndAi", "action" => "studentsTrainedList"), array("escape" => false)); ?></li>
                                    <li class="last-menu facultiesTrainedList"><?php echo $this->Html->link('<span>No. of Faculty Trained</span>', array("controller" => "DsAndAi", "action" => "facultiesTrainedList"), array("escape" => false)); ?></li>
                                    <li class="last-menu professionalsTrainedList"><?php echo $this->Html->link('<span>No. of Professional Trained</span>', array("controller" => "DsAndAi", "action" => "professionalsTrainedList"), array("escape" => false)); ?></li>

                                </ul>
                            </li>
                            <li class="treeview ">
                                <a href="#">
                                    <span>Events</span>
                                    <span class="pull-right-container"><i class="fa fa-angle-right pull-right"></i> </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li class="last-menu MasterClasses"><?php echo $this->Html->link('<span>Master Classes</span>', array("controller" => "DsAndAi", "action" => "masterClasses"), array("escape" => false)); ?></li>
                                    <li class="last-menu msParticipants"><?php echo $this->Html->link('<span>Master Classes Participants</span>', array("controller" => "DsAndAi", "action" => "msParticipantsList"), array("escape" => false)); ?></li>

                                    <li class="last-menu AiPathshala"><?php echo $this->Html->link('<span>AI Pathshala</span>', array("controller" => "DsAndAi", "action" => "aiPathshala"), array("escape" => false)); ?></li>
                                    <li class="last-menu AiPathshalaParticipants"><?php echo $this->Html->link('<span>AI Pathshala Participants</span>', array("controller" => "DsAndAi", "action" => "aiPathshalaParticipantsList"), array("escape" => false)); ?></li>

                                    <li class="last-menu TechMentoring"><?php echo $this->Html->link('<span>Tech Mentoring</span>', array("controller" => "DsAndAi", "action" => "techMentoring"), array("escape" => false)); ?></li>
                                    <li class="last-menu hackathons"><?php echo $this->Html->link('<span>Hackathons</span>', array("controller" => "DsAndAi", "action" => "hackathons"), array("escape" => false)); ?></li>
                                    <li class="last-menu hackathonParticipants"><?php echo $this->Html->link('<span>Hackathons Participants</span>', array("controller" => "DsAndAi", "action" => "hackathonParticipantsList"), array("escape" => false)); ?></li>
                                    <li class="last-menu InvestorConnect"><?php echo $this->Html->link('<span>Investor Connect</span>', array("controller" => "DsAndAi", "action" => "investorConnect"), array("escape" => false)); ?></li>
                                </ul>
                            </li>
                            <li class="treeview ">
                                <a href="#">
                                    <span>Financial / Expenditure</span>
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-right pull-right"></i>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li class="last-menu dsAiFund"><?php echo $this->Html->link('<span>Fund Received</span>', array("controller" => "Home", "action" => "dsAiFund"), array("escape" => false)); ?></li>
                                    <li class="last-menu dsAiExpense"><?php echo $this->Html->link('<span>Expenditure Details</span>', array("controller" => "Home", "action" => "dsAiExpenseList"), array("escape" => false)); ?></li>
                                </ul>
                            </li>
                            <li class="RevenueGenerated">
                                <?php echo $this->Html->link('<span>Revenue Generated</span>', array("controller" => "DS&AI", "action" => "revenueGenerated"), array("escape" => false)); ?>
                            </li>
                        </ul>
                    </li>
                <?php }
                if ($userType == 'Admin' || $userType == 'AEROSPACE & DEFENSE') { ?>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-fighter-jet"></i> <span>K-tech COE in A&D</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="treeview ">
                                <a href="#">
                                    <span>Training</span>
                                    <span class="pull-right-container"><i class="fa fa-angle-right pull-right"></i> </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li class="last-menu manageStarterCourseList"><?php echo $this->Html->link('<span>Starter Course  List</span>', array("controller" => "Home", "action" => "manageStarterCourseList"), array("escape" => false)); ?></li>
                                    <li class="last-menu starterCourseList"><?php echo $this->Html->link('<span>Starter Course  Students</span>', array("controller" => "AerospaceDefence", "action" => "starterCourseList"), array("escape" => false)); ?></li>

                                    <li class="last-menu manageInternshipFoundationCourseList"><?php echo $this->Html->link('<span>Internship Foundation  List</span>', array("controller" => "Home", "action" => "manageInternshipFoundationCourseList"), array("escape" => false)); ?></li>
                                    <li class="last-menu internshipStudent"><?php echo $this->Html->link('<span>Internship Foundation  Students</span>', array("controller" => "AerospaceDefence", "action" => "internshipStudentList"), array("escape" => false)); ?></li>

                                    <li class="last-menu manageAdvanceProjectBasedCourseList"><?php echo $this->Html->link('<span>Advance Project Based List</span>', array("controller" => "Home", "action" => "manageAdvanceProjectBasedCourseList"), array("escape" => false)); ?></li>
                                    <li class="last-menu advanceProjectStudent"><?php echo $this->Html->link('<span>Advance Project Students</span>', array("controller" => "AerospaceDefence", "action" => "advanceProjectStudentList"), array("escape" => false)); ?></li>

                                    <li class="last-menu manageOrientationAwarenessCourseList"><?php echo $this->Html->link('<span>Orientation Awareness List</span>', array("controller" => "Home", "action" => "manageOrientationAwarenessCourseList"), array("escape" => false)); ?></li>
                                    <li class="last-menu orientationAwarenessStudent"><?php echo $this->Html->link('<span>Orientation Awareness Students</span>', array("controller" => "AerospaceDefence", "action" => "orientationAwarenessStudentList"), array("escape" => false)); ?></li>

                                </ul>
                            </li>
                            <!-- Academia  -->
                            <li class="treeview">
                                <a href="#">
                                    <span>Academia</span>
                                    <span class="pull-right-container"><i class="fa fa-angle-right pull-right"></i> </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li class="last-menu aerospaceDefenseEmbeddedCourse"><?php echo $this->Html->link('<span>Embedded Course</span>', array("controller" => "Home", "action" => "aerospaceDefenseEmbeddedCourse"), array("escape" => false)); ?></li>
                                    <li class="last-menu embeddedCourseAttendees"><?php echo $this->Html->link('<span> Embedded Course Attendees  </span>', array("controller" => "Home", "action" => "embeddedCourseAttendees"), array("escape" => false)); ?></li>

                                    <li class="last-menu aerospaceDefenseTrainingProcess"><?php echo $this->Html->link('<span>Training in process</span>', array("controller" => "Home", "action" => "aerospaceDefenseTrainingProcess"), array("escape" => false)); ?></li>
                                    <li class="last-menu trainingProcessAttendees"><?php echo $this->Html->link('<span> Training in process Attendees  </span>', array("controller" => "Home", "action" => "trainingProcessAttendees"), array("escape" => false)); ?></li>

                                    <li class="last-menu aerospaceDefenseBootcamp"><?php echo $this->Html->link('<span>Bootcamp</span>', array("controller" => "Home", "action" => "aerospaceDefenseBootcamp"), array("escape" => false)); ?></li>
                                    <li class="last-menu bootcampAttendees"><?php echo $this->Html->link('<span> Bootcamp Attendees  </span>', array("controller" => "Home", "action" => "bootcampAttendees"), array("escape" => false)); ?></li>

                                    <li class="last-menu aerospaceDefenseDroneTechnology"><?php echo $this->Html->link('<span>Drone Technologies</span>', array("controller" => "Home", "action" => "aerospaceDefenseDroneTechnology"), array("escape" => false)); ?></li>
                                    <li class="last-menu droneTechnologiesAttendees"><?php echo $this->Html->link('<span> Drone Technologies Attendees  </span>', array("controller" => "Home", "action" => "droneTechnologiesAttendees"), array("escape" => false)); ?></li>

                                    <li class="last-menu aerospaceDefenseValueStreamCourse"><?php echo $this->Html->link('<span>Value Stream Course</span>', array("controller" => "Home", "action" => "aerospaceDefenseValueStreamCourse"), array("escape" => false)); ?></li>
                                    <li class="last-menu valueStreamCourseAttendees"><?php echo $this->Html->link('<span> Value Stream Course Attendees  </span>', array("controller" => "Home", "action" => "valueStreamCourseAttendees"), array("escape" => false)); ?></li>

                                </ul>
                            </li>
                            <!-- Academia  -->


                            <!-- Skilling  -->
                            <li class="treeview">
                                <a href="#">
                                    <span>Skilling</span>
                                    <span class="pull-right-container"><i class="fa fa-angle-right pull-right"></i> </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li class="last-menu aerospaceDefenseSkilling"><?php echo $this->Html->link('<span>Skilling</span>', array("controller" => "Home", "action" => "aerospaceDefenseSkilling"), array("escape" => false)); ?></li>
                                    <li class="last-menu skillingAttendees"><?php echo $this->Html->link('<span> Skilling Attendees  </span>', array("controller" => "Home", "action" => "skillingAttendees"), array("escape" => false)); ?></li>

                                    <li class="last-menu aerospaceDefenseCourse"><?php echo $this->Html->link('<span>Course</span>', array("controller" => "Home", "action" => "aerospaceDefenseCourse"), array("escape" => false)); ?></li>
                                    <li class="last-menu courseAttendees"><?php echo $this->Html->link('<span> Course Attendees  </span>', array("controller" => "Home", "action" => "courseAttendees"), array("escape" => false)); ?></li>
                                </ul>
                            </li>
                            <!-- Skilling  -->


                            <!-- Startup Facilitation -->
                            <li class="last-menu manageStartupFacilitation"><?php echo $this->Html->link('<span>Startup Facilitation</span>', array("controller" => "Home", "action" => "manageStartupFacilitation"), array("escape" => false)); ?></li>
                            <!-- Startup Facilitation -->

                            <li class="treeview ">
                                <a href="#">
                                    <span>Financial / Expenditure</span>
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-right pull-right"></i>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li class="last-menu aerospaceFund"><?php echo $this->Html->link('<span>Fund Received</span>', array("controller" => "Home", "action" => "aerospaceFund"), array("escape" => false)); ?></li>
                                    <li class="last-menu aerospaceExpense"><?php echo $this->Html->link('<span>Expenditure Details</span>', array("controller" => "Home", "action" => "aerospaceExpenseList"), array("escape" => false)); ?></li>
                                </ul>
                            </li>
                            <li class="A&DRevenueGenerated"> <?php echo $this->Html->link('<span>Revenue Generated</span>', array("controller" => "A&D", "action" => "revenueGenerated"), array("escape" => false)); ?> </li>

                        </ul>
                    </li>
                <?php }
                if ($userType == 'Admin' || $userType == 'CYBER SECURITY') { ?>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-laptop"></i><span>K-tech COE in CS</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">

                            <li class="last-menu internship-pool"><?php echo $this->Html->link('<span> Internship</span>', array("controller" => "Home", "action" => "manageInternshipPool"), array("escape" => false)); ?></li>
                            <li class="last-menu internshipRegistration"><?php echo $this->Html->link('<span> Internship Registration</span>', array("controller" => "CyberSecurity", "action" => "internshipRegistration"), array("escape" => false)); ?></li>

                            <li class="last-menu enable-startup"><?php echo $this->Html->link('<span> Enablement </span>', array("controller" => "Home", "action" => "manageStartup"), array("escape" => false)); ?></li>
                            <li class="last-menu enablementMembers"><?php echo $this->Html->link('<span> Enablement Team Members</span>', array("controller" => "CyberSecurity", "action" => "enablementMembers"), array("escape" => false)); ?></li>

                            <li class="last-menu capacity-building"><?php echo $this->Html->link('<span> Training </span>', array("controller" => "Home", "action" => "manageCapacityBuilding"), array("escape" => false)); ?></li>
                            <li class="last-menu trainingParticipants"><?php echo $this->Html->link('<span> Training Participants</span>', array("controller" => "CyberSecurity", "action" => "trainingParticipants"), array("escape" => false)); ?></li>

                            <li class="last-menu white-paper"><?php echo $this->Html->link('<span>White Paper/News Letter </span>', array("controller" => "Home", "action" => "manageWhitePaper"), array("escape" => false)); ?></li>

                            <li class="last-menu cyber-security"><?php echo $this->Html->link('<span>Workshop </span>', array("controller" => "Home", "action" => "manageCyberSecurity"), array("escape" => false)); ?></li>
                            <li class="last-menu workshopParticipants"><?php echo $this->Html->link('<span> Workshop Participants</span>', array("controller" => "CyberSecurity", "action" => "workshopParticipants"), array("escape" => false)); ?></li>
                            <li class="CSRevenueGenerated"> <?php echo $this->Html->link('<span>Revenue Generated</span>', array("controller" => "CS", "action" => "revenueGenerated"), array("escape" => false)); ?>

                            <!-- new form fields in cyber security 21-07-2022 -->

                            <li class="treeview">
                                <a href="#">
                                    <span>Awareness</span>
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-right pull-right"></i>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li class="last-menu csAwarenessPosters"><?php echo $this->Html->link('<span>Awareness Posters</span>', array("controller" => "CyberSecurity", "action" => "csAwarenessPosters"), array("escape" => false)); ?></li>
                                    <li class="last-menu cyberNewsLetter"><?php echo $this->Html->link('<span>News Letter</span>', array("controller" => "CyberSecurity", "action" => "csNewsLetter"), array("escape" => false)); ?></li>
                                    <li class="last-menu cyberHygieneHandbook"><?php echo $this->Html->link('<span>Cyber Hygiene Handbook</span>', array("controller" => "CyberSecurity", "action" => "cyberHygieneHandbook"), array("escape" => false)); ?></li>
                                    <li class="last-menu csVolunteerProgramme"><?php echo $this->Html->link('<span>Volunteer Programme</span>', array("controller" => "CyberSecurity", "action" => "csVolunteerProgramme"), array("escape" => false)); ?></li>
                                </ul>
                            </li>
                            <li class="treeview">
                                <a href="#">
                                    <span>Skill Building</span>
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-right pull-right"></i>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li class="last-menu facultyDevelopmentProgram"><?php echo $this->Html->link('<span>Faculty Development Program</span>', array("controller" => "CyberSecurity", "action" => "facultyDevelopmentProgram"), array("escape" => false)); ?></li>
                                </ul>
                            </li>
                            <li class="last-menu cyberSecurityResearch"><?php echo $this->Html->link('<span>Research</span>', array("controller" => "CyberSecurity", "action" => "cyberSecurityResearch"), array("escape" => false)); ?></li>
                            </li>
                            <li class="last-menu industryStartups"><?php echo $this->Html->link('<span>Industry & Start-ups</span>', array("controller" => "CyberSecurity", "action" => "csIndustryStartups"), array("escape" => false)); ?></li>
                            </li>
                            <li class="last-menu awarenessSessions"><?php echo $this->Html->link('<span>Awareness Sessions</span>', array("controller" => "CyberSecurity", "action" => "csAwarenessSessions"), array("escape" => false)); ?></li>
                            </li>
                            <li class="last-menu awarenessSessionParticipants"><?php echo $this->Html->link('<span>Awareness Session Participants</span>', array("controller" => "CyberSecurity", "action" => "csAwarenessSessionParticipants"), array("escape" => false)); ?></li>
                            </li>
                           <!----------------   ---------------->
                            <li class="treeview ">
                                <a href="#">
                                    <span>Financial / Expenditure</span>
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-right pull-right"></i>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li class="last-menu cyberSecurityFund"><?php echo $this->Html->link('<span>Fund Received</span>', array("controller" => "Home", "action" => "cyberSecurityFund"), array("escape" => false)); ?></li>
                                    <li class="last-menu cyberSecurityExpense"><?php echo $this->Html->link('<span>Expenditure Details</span>', array("controller" => "Home", "action" => "cyberSecurityExpenseList"), array("escape" => false)); ?></li>
                                </ul>
                            </li>

                        </ul>


                    </li>




                <?php }
                if ($userType == 'Admin' || $userType == 'ANIMATION') { ?>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-grav"></i><span>K-tech COE in AVGC</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>

                        <ul class="treeview-menu">
                            <li class="graduates_school"><?php echo $this->Html->link('<span>Finishing School</span>', array("controller" => "Home", "action" => "graduateSchoolList"), array("escape" => false)); ?></li>
                            <li class="last-menu facility"><?php echo $this->Html->link('<span>Manage Facility</span>', array("controller" => "Home", "action" => "manageFacility"), array("escape" => false)); ?></li>
                            <li class="last-menu incubation"><?php echo $this->Html->link('<span>Incubation</span>', array("controller" => "AVGC", "action" => "incubation"), array("escape" => false)); ?></li>
                            <li class="last-menu imagery"><?php echo $this->Html->link('<span>Computer-generated imagery</span>', array("controller" => "AVGC", "action" => "computerGeneratedImagery"), array("escape" => false)); ?></li>
                            <li class="last-menu capture"><?php echo $this->Html->link('<span>Motion Capture</span>', array("controller" => "AVGC", "action" => "motionCapture"), array("escape" => false)); ?></li>
                            <li class="last-menu screen"><?php echo $this->Html->link('<span>Green Screen</span>', array("controller" => "AVGC", "action" => "greenScreen"), array("escape" => false)); ?></li>
                            <li class="last-menu scan"><?php echo $this->Html->link('<span>Body Scan 360</span>', array("controller" => "AVGC", "action" => "bodyScan"), array("escape" => false)); ?></li>
                            <li class="AVGCRevenueGenerated">
                                <?php echo $this->Html->link('<span>Revenue Generated</span>', array("controller" => "AVGC", "action" => "revenueGenerated"), array("escape" => false)); ?>
                            </li>
                            <li class="treeview ">
                                <a href="#">
                                    <span>Financial / Expenditure</span>
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-right pull-right"></i>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li class="last-menu animationFund"><?php echo $this->Html->link('<span>Fund Received</span>', array("controller" => "Home", "action" => "animationFund"), array("escape" => false)); ?></li>
                                    <li class="last-menu animationExpense"><?php echo $this->Html->link('<span>Expenditure Details</span>', array("controller" => "Home", "action" => "animationExpenseList"), array("escape" => false)); ?></li>
                                </ul>
                            </li>
                        </ul>

                    </li>
                <?php }
                if ($userType == 'Admin' || $userType == 'KTECH CENTRE') { ?>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-code-fork menu-icon"></i><span>K-tech COE by C-Camp</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="last-menu CCampStartup"><?php echo $this->Html->link('<span>Start-ups</span>', array("controller" => "CCamp", "action" => "startup"), array("escape" => false)); ?></li>
                            <li class="last-menu CCampStartupSelected"><?php echo $this->Html->link('<span>Start-ups selected</span>', array("controller" => "CCamp", "action" => "startupSelected"), array("escape" => false)); ?></li>
                            <li class="last-menu CCampStartupsIncubated"><?php echo $this->Html->link('<span>Start-ups Incubated</span>', array("controller" => "CCamp", "action" => "startupIncubated"), array("escape" => false)); ?></li>
                            <li class="last-menu CCampGraduated"><?php echo $this->Html->link('<span>Startups Graduated</span>', array("controller" => "CCamp", "action" => "startupGraduated"), array("escape" => false)); ?></li>
                            <!--<li class="last-menu CCampEventsConducted"><?php echo $this->Html->link('<span>Events Conducted </span>', array("controller" => "CCamp", "action" => "eventConducted"), array("escape" => false)); ?></li>-->
                            <li class="HomeRevenueGenerated"><?php echo $this->Html->link('<span>Revenue Generated</span>', array("controller" => "CCamp", "action" => "revenueGenerated"), array("escape" => false)); ?></li>
                            <li class="manageAgricultureInnovation"><?php echo $this->Html->link('<span>Manage Innovation Agriculture</span>', array("controller" => "Home", "action" => "manageAgricultureInnovation"), array("escape" => false)); ?></li>
                            <li class="problemStatement"><?php echo $this->Html->link('<span>Problem Statement</span>', array("controller" => "Home", "action" => "problemStatement"), array("escape" => false)); ?></li>
                            <li class="problemStatementList"><?php echo $this->Html->link('<span>Problem Statement List</span>', array("controller" => "Home", "action" => "problemStatementList"), array("escape" => false)); ?></li>
                            <li class="updatedProblemStatementList"><?php echo $this->Html->link('<span>Updated Problem Statement List</span>', array("controller" => "Home", "action" => "updatedProblemStatementList"), array("escape" => false)); ?></li>
                            <li class="last-menu eventsConducted"><?php echo $this->Html->link('<span> Events Conducted </span>', array("controller" => "Ktech", "action" => "eventsConducted"), array("escape" => false)); ?></li>
                            <li class="last-menu kteckMentors"><?php echo $this->Html->link('<span> Mentors </span>', array("controller" => "Ktech", "action" => "mentors"), array("escape" => false)); ?></li>
                            <li class="last-menu kteckPartners"><?php echo $this->Html->link('<span> Partnership </span>', array("controller" => "Ktech", "action" => "partnership"), array("escape" => false)); ?></li>
                            <li class="last-menu ktechStartup"><?php echo $this->Html->link('<span> Fund Raised by Startups </span>', array("controller" => "Ktech", "action" => "fundRaisedStartup"), array("escape" => false)); ?></li>
                            <li class="last-menu ktechHackathon"><?php echo $this->Html->link('<span> Hackathons </span>', array("controller" => "Ktech", "action" => "hackathons"), array("escape" => false)); ?></li>
                            <li class="last-menu ktechPreideation"><?php echo $this->Html->link('<span> Pre-ideation </span>', array("controller" => "Ktech", "action" => "preIdeation"), array("escape" => false)); ?></li>
                            <li class="last-menu ktechWorkshop"><?php echo $this->Html->link('<span>  Ideation </span>', array("controller" => "Ktech", "action" => "ideationWorkshop"), array("escape" => false)); ?></li>
                            <li class="last-menu ktechEcosystem"><?php echo $this->Html->link('<span> Ecosystem Building Services </span>', array("controller" => "Ktech", "action" => "ecosystemBuildingService"), array("escape" => false)); ?></li>
                            <li class="last-menu ktechWorkshops"><?php echo $this->Html->link('<span> Workshops </span>', array("controller" => "Ktech", "action" => "workshop"), array("escape" => false)); ?></li>
                            <li class="last-menu noOfNewProducts"><?php echo $this->Html->link('<span> No of New Products </span>', array("controller" => "Ktech", "action" => "noOfNewProducts"), array("escape" => false)); ?></li>
                            
                            <li class="treeview ">
                                <a href="#">
                                    <span>Financial / Expenditure</span>
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-right pull-right"></i>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li class="last-menu ktechCenterFund"><?php echo $this->Html->link('<span>Fund Received</span>', array("controller" => "Home", "action" => "ktechCenterFund"), array("escape" => false)); ?></li>
                                    <li class="last-menu ktechCenterExpense"><?php echo $this->Html->link('<span>Expenditure Details</span>', array("controller" => "Home", "action" => "ktechCenterExpenseList"), array("escape" => false)); ?></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                <?php }
                if ($userType == 'Admin' || $userType == 'IOT') { ?>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-industry menu-icon"></i><span>K-tech COE on IoT</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="Researchers_incubated"><?php echo $this->Html->link('<span>Researchers incubated</span>', array("controller" => "Iot", "action" => "researcherIncubatedList"), array("escape" => false)); ?></li>
                            <li class="Paper_global_conference"><?php echo $this->Html->link('<span>Global Conference Papers</span>', array("controller" => "Iot", "action" => "globalConferencePaperList"), array("escape" => false)); ?></li>
                            <li class="prototype_showcased"><?php echo $this->Html->link('<span>Prototypes showcased</span>', array("controller" => "Iot", "action" => "prototypeShowcasedList"), array("escape" => false)); ?></li>
                            <li class="Start-ups"><?php echo $this->Html->link('<span>Start-ups enrolled</span>', array("controller" => "Iot", "action" => "startUpList"), array("escape" => false)); ?></li>
                            <li class="intellectualProperty"><?php echo $this->Html->link('<span>Intellectual Property</span>', array("controller" => "Iot", "action" => "ipList"), array("escape" => false)); ?></li>
                            <li class="generatedEmployment"><?php echo $this->Html->link('<span>Employment Generated</span>', array("controller" => "Home", "action" => "generatedEmploymentList"), array("escape" => false)); ?></li>
                            <li class="startupRisedFundsList"><?php echo $this->Html->link('<span>Funds raised by start ups</span>', array("controller" => "Iot", "action" => "startupRisedFundsList"), array("escape" => false)); ?></li>
                            <li class="delegation"><?php echo $this->Html->link('<span>Delegations hosted at CoE</span>', array("controller" => "Iot", "action" => "delegationList"), array("escape" => false)); ?></li>
                            <li class="pilotsProjectList"><?php echo $this->Html->link('<span>Pilots ProjectList</span>', array("controller" => "Iot", "action" => "pilotsProjectList"), array("escape" => false)); ?></li>

                            <li class="EventWorkshop"><?php echo $this->Html->link('<span>Events/Workshops Conducted</span>', array("controller" => "Iot", "action" => "eventWorkshopList"), array("escape" => false)); ?></li>
                            <li class="IndustryConnected"><?php echo $this->Html->link('<span>Industries Connected</span>', array("controller" => "Iot", "action" => "industryConnectedList"), array("escape" => false)); ?></li>
                            <li class="AcademiaConnected"><?php echo $this->Html->link('<span>Academia Connected</span>', array("controller" => "Iot", "action" => "academiaConnectedList"), array("escape" => false)); ?></li>
                            <li class="IotOccupancy"><?php echo $this->Html->link('<span>Occupancy</span>', array("controller" => "Iot", "action" => "occupancy"), array("escape" => false)); ?></li>
                            <li class="IotRevenueGenerated">
                                <?php echo $this->Html->link('<span>Revenue Generated</span>', array("controller" => "IOT", "action" => "revenueGenerated"), array("escape" => false)); ?>
                            </li>

                            <li class="mentoring"><?php echo $this->Html->link('<span>Mentoring </span>', array("controller" => "Iot", "action" => "mentors"), array("escape" => false)); ?></li>
                            <li class="workshops"><?php echo $this->Html->link('<span>Workshops </span>', array("controller" => "Iot", "action" => "workshop"), array("escape" => false)); ?></li>
                            <li class="investorConnect"><?php echo $this->Html->link('<span>Investor Connect</span>', array("controller" => "Iot", "action" => "investorConnect"), array("escape" => false)); ?></li>
                            <li class="demoDays"><?php echo $this->Html->link('<span>Demo Days</span>', array("controller" => "Iot", "action" => "demoDays"), array("escape" => false)); ?></li>
                            <li class="startupShowcase"><?php echo $this->Html->link('<span>Startup Showcase</span>', array("controller" => "Iot", "action" => "startupShowcase"), array("escape" => false)); ?></li>
                            <li class="industryConnect"><?php echo $this->Html->link('<span> Industry/Enterprise Connect</span>', array("controller" => "Iot", "action" => "industryEnterpriseConnect"), array("escape" => false)); ?></li>
                            <li class="sharkTank"><?php echo $this->Html->link('<span>Shark Tank</span>', array("controller" => "Iot", "action" => "sharkTank"), array("escape" => false)); ?></li>
                            <li class="bootCamp"><?php echo $this->Html->link('<span>Boot Camps</span>', array("controller" => "Iot", "action" => "bootCamp"), array("escape" => false)); ?></li>
                            <li class="internationalConnect"><?php echo $this->Html->link('<span> International Connect </span>', array("controller" => "Iot", "action" => "internationalConnect"), array("escape" => false)); ?></li>
                            <li class="softLanding"><?php echo $this->Html->link('<span>Soft-landing</span>', array("controller" => "Iot", "action" => "softLanding"), array("escape" => false)); ?></li>
                            <li class="edpInTier"><?php echo $this->Html->link('<span>EDP in Tier- II/III Cities</span>', array("controller" => "Iot", "action" => "edpInTier"), array("escape" => false)); ?></li>
                            <li class="womenEntrepreneurs"><?php echo $this->Html->link('<span>Programs for Women Entrepreneurs </span>', array("controller" => "Iot", "action" => "womenEntrepreneurs"), array("escape" => false)); ?></li>


                            <li class="treeview ">
                                <a href="#">
                                    <span>Programs</span>
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-right pull-right"></i>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li class="last-menu IotMentoring"><?php echo $this->Html->link('<span>Mentoring</span>', array("controller" => "Iot", "action" => "mentoring"), array("escape" => false)); ?></li>
                                    <li class="last-menu IotOtherProgram"><?php echo $this->Html->link('<span>Other Program</span>', array("controller" => "Iot", "action" => "otherProgramList"), array("escape" => false)); ?></li>
                                </ul>
                            </li>



                            <li class="treeview ">
                                <a href="#">
                                    <span>Financial / Expenditure</span>
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-right pull-right"></i>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li class="last-menu iotFund"><?php echo $this->Html->link('<span>Fund Received</span>', array("controller" => "Home", "action" => "iotFund"), array("escape" => false)); ?></li>
                                    <li class="last-menu iotExpense"><?php echo $this->Html->link('<span>Expenditure Details</span>', array("controller" => "Home", "action" => "iotExpenseList"), array("escape" => false)); ?></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                <?php }
                if ($userType == 'Admin' || $userType == 'MI & ROBOTICS') { ?>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-rocket"></i>
                            <span>K-tech COE - MINRO</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="open_experience_centre"><?php echo $this->Html->link('<span>Open Experience Centre</span>', array("controller" => "MachineIntelligence", "action" => "openExperienceCentreList"), array("escape" => false)); ?></li>
                            <li class="open_experience_centre_new"><?php echo $this->Html->link('<span>Open Experience Centre New</span>', array("controller" => "MachineIntelligence", "action" => "openExperienceCentreNew"), array("escape" => false)); ?></li>
                            <li class="mentorship_list"><?php echo $this->Html->link('<span>Mentorship</span>', array("controller" => "MachineIntelligence", "action" => "mentorshipList"), array("escape" => false)); ?></li>
                            <li class="treeview ">
                                <a href="#">
                                    <span>Capacity building</span>
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-right pull-right"></i>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li class="last-menu Programs"><?php echo $this->Html->link('<span>Programs</span>', array("controller" => "MachineIntelligence", "action" => "programs"), array("escape" => false)); ?></li>
                                    <li class="last-menu ProgramParticipants"><?php echo $this->Html->link('<span>Program Participants</span>', array("controller" => "MachineIntelligence", "action" => "programParticipants"), array("escape" => false)); ?></li>
                                    <li class="last-menu ProgramStudents"><?php echo $this->Html->link('<span>Program Students</span>', array("controller" => "MachineIntelligence", "action" => "programStudent"), array("escape" => false)); ?></li>
                                </ul>
                            </li>
                            <li class="treeview ">
                                <a href="#">
                                    <span>International Conference</span>
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-right pull-right"></i>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li class="last-menu Conference"><?php echo $this->Html->link('<span>Conference</span>', array("controller" => "MachineIntelligence", "action" => "conference"), array("escape" => false)); ?></li>
                                    <li class="last-menu icParticipants"><?php echo $this->Html->link('<span>Conference Participants</span>', array("controller" => "MachineIntelligence", "action" => "icParticipants"), array("escape" => false)); ?></li>
                                </ul>
                            </li>
                            <li class="treeview ">
                                <a href="#">
                                    <span>Startup Conference</span>
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-right pull-right"></i>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li class="last-menu StartUpConference"><?php echo $this->Html->link('<span>Conference</span>', array("controller" => "MachineIntelligence", "action" => "startupConference"), array("escape" => false)); ?></li>
                                    <li class="last-menu StartUpParticipants"><?php echo $this->Html->link('<span>Conference Participants</span>', array("controller" => "MachineIntelligence", "action" => "startupParticipants"), array("escape" => false)); ?></li>
                                </ul>
                            </li>
                            <li class="last-menu govtOfficialTraining"><?php echo $this->Html->link('<span>Training of Govt Officials</span>', array("controller" => "MachineIntelligence", "action" => "govtOfficialTraining"), array("escape" => false)); ?></li>
                            <li class="last-menu studentEnrollment"><?php echo $this->Html->link('<span>Student Enrollment</span>', array("controller" => "MachineIntelligence", "action" => "studentEnrollment"), array("escape" => false)); ?></li>
                            <li class="last-menu patents"><?php echo $this->Html->link('<span>Patents</span>', array("controller" => "MachineIntelligence", "action" => "patents"), array("escape" => false)); ?></li>
                            <li class="MinroWorkshop">
                                <?php echo $this->Html->link('<span>Workshop</span>', array("controller" => "Minro", "action" => "workshop"), array("escape" => false)); ?>
                            </li>
                            <li class="MinroWorkshopParticipants">
                                <?php echo $this->Html->link('<span>Workshop Participants</span>', array("controller" => "Minro", "action" => "workshopParticipantsList"), array("escape" => false)); ?>
                            </li>
                            <li class="MinroRevenueGenerated">
                                <?php echo $this->Html->link('<span>Revenue Generated</span>', array("controller" => "MINRO", "action" => "revenueGenerated"), array("escape" => false)); ?>
                            </li>
                            <li class="treeview ">
                                <a href="#">
                                    <span>Financial / Expenditure</span>
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-right pull-right"></i>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li class="last-menu roboticsFund"><?php echo $this->Html->link('<span>Fund Received</span>', array("controller" => "Home", "action" => "roboticsFund"), array("escape" => false)); ?></li>
                                    <li class="last-menu roboticsExpense"><?php echo $this->Html->link('<span>Expenditure Details</span>', array("controller" => "Home", "action" => "roboticsExpenseList"), array("escape" => false)); ?></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                <?php }
                if ($userType == 'Admin' || $userType == 'FABLESS') { ?>
                    <li class="treeview">
                        <a href="#"> <i class="fa fa-universal-access"></i><span>K-tech COE - SFAL</span> <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="last-menu coeDetailsList"><?php echo $this->Html->link('<span>COE-Details </span>', array("controller" => "Fabless", "action" => "coeDetailsList"), array("escape" => false)); ?></li>
                            <li class="last-menu coeTeam"><?php echo $this->Html->link('<span>COE-Team </span>', array("controller" => "Fabless", "action" => "coeTeamList"), array("escape" => false)); ?></li>

                            <li class="last-menu companies"><?php echo $this->Html->link('<span>Companies </span>', array("controller" => "Fabless", "action" => "companies"), array("escape" => false)); ?></li>
                            <li class="last-menu teamDetails"><?php echo $this->Html->link('<span>Company Team Details </span>', array("controller" => "Fabless", "action" => "teamDetails"), array("escape" => false)); ?></li>

                            <li class="last-menu partnerDetailsList"><?php echo $this->Html->link('<span>Partner Details List</span>', array("controller" => "Fabless", "action" => "partnerDetailsList"), array("escape" => false)); ?></li>
                            <li class="last-menu incubateeDetailsList"><?php echo $this->Html->link('<span>Cohort Details </span>', array("controller" => "Fabless", "action" => "incubateeDetailsList"), array("escape" => false)); ?></li>
                            <li class="last-menu mentorDetailsList"><?php echo $this->Html->link('<span>Mentor Details List</span>', array("controller" => "Fabless", "action" => "mentorDetailsList"), array("escape" => false)); ?></li>

                            <!--<li class="last-menu incubateeTeamDetailsList"><?php /*echo $this->Html->link('<span>Incubatee Team Details List</span>', array("controller" => "Fabless", "action" => "incubateeTeamDetailsList"), array("escape" => false)); */ ?></li>-->
                            <li class="SFALRevenueGenerated">
                                <?php echo $this->Html->link('<span>Revenue Generated</span>', array("controller" => "SFAL", "action" => "revenueGenerated"), array("escape" => false)); ?>
                            </li>
                            <li class="last-menu successfulCompanies"><?php echo $this->Html->link('<span>Successful Companies</span>', array("controller" => "Fabless", "action" => "successfulCompanies"), array("escape" => false)); ?></li>
                            <li class="last-menu exitedCompanies"><?php echo $this->Html->link('<span>Exited Companies</span>', array("controller" => "Fabless", "action" => "exitedCompanies"), array("escape" => false)); ?></li>

                            <li class="treeview ">
                                <a href="#">
                                    <span>Financial / Expenditure</span>
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-right pull-right"></i>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li class="last-menu fablessFund"><?php echo $this->Html->link('<span>Fund Received</span>', array("controller" => "Home", "action" => "fablessFund"), array("escape" => false)); ?></li>
                                    <li class="last-menu fablessExpense"><?php echo $this->Html->link('<span>Expenditure Details</span>', array("controller" => "Home", "action" => "fablessExpenseList"), array("escape" => false)); ?></li>
                                </ul>
                            </li>
                        </ul>
                    </li>

                <?php }
                if ($userType == 'Admin') { ?>
                    <!--<li class='budget'><?php //echo $this->Html->link('<i class="fa fa-usd"></i> <span>Budget</span>',array("controller"=>"Home","action"=>"budget"),array("escape"=>false));
                                            ?></li>-->
                    <li class='target'><?php echo $this->Html->link('<i class="fa fa-balance-scale"></i> <span>Target</span>', array("controller" => "Home", "action" => "target"), array("escape" => false)); ?></li>
                    <li class='target'><?php echo $this->Html->link('<i class="fa fa-random"></i> <span>Financial Year</span>', array("controller" => "Admin", "action" => "financialYear"), array("escape" => false)); ?></li>
                <?php }
            } else  if ($ApplicationType == 'TBI') { ?>
                <?php if ($userType == 'Admin' || $userType == 'CENSE') { ?>
                    <li class="treeview ">

                        <a href="#">
                            <i class="fa fa-codepen"></i>
                            <span>(CeNSE), IISc., Bengaluru</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="last-menu NSTBIStartup"><?php echo $this->Html->link('<span>Technology Start-ups</span>', array("controller" => "NSTBI", "action" => "startup"), array("escape" => false)); ?></li>
                            <li class="last-menu NSTBIStartupSelected"><?php echo $this->Html->link('<span>Start-ups selected</span>', array("controller" => "NSTBI", "action" => "startupSelected"), array("escape" => false)); ?></li>
                            <li class="last-menu TBIStartupsIncubated"><?php echo $this->Html->link('<span>Start-ups Incubated</span>', array("controller" => "NSTBI", "action" => "startupIncubated"), array("escape" => false)); ?></li>
                            <li class="last-menu TBIInnovationsCommercialized"><?php echo $this->Html->link('<span>Innovations Commercialized</span>', array("controller" => "NSTBI", "action" => "innovationCommercialized"), array("escape" => false)); ?></li>
                            <li class="last-menu TBIStartupsIncubatedTBI"><?php echo $this->Html->link('<span>Start-ups Incubated off TBI</span>', array("controller" => "NSTBI", "action" => "startupIncubatedTbi"), array("escape" => false)); ?></li>
                            <li class="last-menu TBIGraduated"><?php echo $this->Html->link('<span>Startups Graduated</span>', array("controller" => "NSTBI", "action" => "startupGraduated"), array("escape" => false)); ?></li>
                            <li class="last-menu TBIEventsConducted"><?php echo $this->Html->link('<span>Events Conducted </span>', array("controller" => "NSTBI", "action" => "eventConducted"), array("escape" => false)); ?></li>
                            <li class="last-menu TBIEventsDetails"><?php echo $this->Html->link('<span>Events Details </span>', array("controller" => "NSTBI", "action" => "eventDetails"), array("escape" => false)); ?></li>
                            <li class="treeview ">
                                <a href="#">
                                    <span>Financial / Expenditure</span>
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-right pull-right"></i>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li class="last-menu fablessFund"><?php echo $this->Html->link('<span>Fund Received</span>', array("controller" => "Tbi", "action" => "NSTBIFund"), array("escape" => false)); ?></li>
                                    <li class="last-menu fablessExpense"><?php echo $this->Html->link('<span>Expenditure Details</span>', array("controller" => "Tbi", "action" => "NSTBIExpenseList"), array("escape" => false)); ?></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                <?php }
                if ($userType == 'Admin' || $userType == 'CPDM') { ?>
                    <li class="treeview ">

                        <a href="#">
                            <i class="fa fa-rocket"></i>
                            <span>(CPDM), IISc., Bengaluru</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="last-menu DMTBIStartup"><?php echo $this->Html->link('<span>Technology Start-ups</span>', array("controller" => "DMTBI", "action" => "startup"), array("escape" => false)); ?></li>
                            <li class="last-menu DMTBIStartupSelected"><?php echo $this->Html->link('<span>Start-ups selected</span>', array("controller" => "DMTBI", "action" => "startupSelected"), array("escape" => false)); ?></li>
                            <li class="last-menu TBIStartupsIncubated"><?php echo $this->Html->link('<span>Start-ups Incubated</span>', array("controller" => "DMTBI", "action" => "startupIncubated"), array("escape" => false)); ?></li>
                            <li class="last-menu TBIInnovationsCommercialized"><?php echo $this->Html->link('<span>Innovations Commercialized</span>', array("controller" => "DMTBI", "action" => "innovationCommercialized"), array("escape" => false)); ?></li>
                            <li class="last-menu TBIStartupsIncubatedTBI"><?php echo $this->Html->link('<span>Start-ups Incubated off TBI</span>', array("controller" => "DMTBI", "action" => "startupIncubatedTbi"), array("escape" => false)); ?></li>
                            <li class="last-menu TBIEventsConducted"><?php echo $this->Html->link('<span>Events Conducted </span>', array("controller" => "DMTBI", "action" => "eventConducted"), array("escape" => false)); ?></li>
                            <li class="last-menu TBIEventsDetails"><?php echo $this->Html->link('<span>Events Details </span>', array("controller" => "DMTBI", "action" => "eventDetails"), array("escape" => false)); ?></li>
                            <li class="treeview ">
                                <a href="#">
                                    <span>Financial / Expenditure</span>
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-right pull-right"></i>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li class="last-menu fablessFund"><?php echo $this->Html->link('<span>Fund Received</span>', array("controller" => "Tbi", "action" => "DMTBIFund"), array("escape" => false)); ?></li>
                                    <li class="last-menu fablessExpense"><?php echo $this->Html->link('<span>Expenditure Details</span>', array("controller" => "Tbi", "action" => "DMTBIExpenseList"), array("escape" => false)); ?></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                <?php }
                if ($userType == 'Admin' || $userType == 'MUTBI') { ?>
                    <li class="treeview ">
                        <a href="#">
                            <i class="fa fa-anchor"></i>
                            <span>(MUTBI), Manipal, Udupi</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="last-menu MUTBIStartup"><?php echo $this->Html->link('<span>Technology Start-ups</span>', array("controller" => "MUTBI", "action" => "startup"), array("escape" => false)); ?></li>
                            <li class="last-menu TBIStartupsSelected<"><?php echo $this->Html->link('<span>Start-ups selected</span>', array("controller" => "MUTBI", "action" => "startupSelected"), array("escape" => false)); ?></li>
                            <li class="last-menu TBIStartupsIncubated"><?php echo $this->Html->link('<span>Start-ups Incubated</span>', array("controller" => "MUTBI", "action" => "startupIncubated"), array("escape" => false)); ?></li>
                            <li class="last-menu TBIInnovationsCommercialized"><?php echo $this->Html->link('<span>Innovations Commercialized</span>', array("controller" => "MUTBI", "action" => "innovationCommercialized"), array("escape" => false)); ?></li>
                            <li class="last-menu TBIStartupsIncubatedTBI"><?php echo $this->Html->link('<span>Start-ups Incubated off TBI</span>', array("controller" => "MUTBI", "action" => "startupIncubatedTbi"), array("escape" => false)); ?></li>
                            <li class="treeview ">
                                <a href="#">
                                    <span>Financial / Expenditure</span>
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-right pull-right"></i>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li class="last-menu fablessFund"><?php echo $this->Html->link('<span>Fund Received</span>', array("controller" => "Tbi", "action" => "MUTBIFund"), array("escape" => false)); ?></li>
                                    <li class="last-menu fablessExpense"><?php echo $this->Html->link('<span>Expenditure Details</span>', array("controller" => "Tbi", "action" => "MUTBIExpenseList"), array("escape" => false)); ?></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                <?php }
                if ($userType == 'Admin' || $userType == 'RMTBI') { ?>
                    <li class="treeview ">
                        <a href="#">
                            <i class="fa fa-assistive-listening-systems"></i>
                            <span>Ramaiah University of<br> &ensp;&ensp;&ensp;&ensp;&ensp; Applied Sciences, Bengaluru</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="last-menu RMTBIStartup"><?php echo $this->Html->link('<span>Technology Start-ups</span>', array("controller" => "RMTBI", "action" => "startup"), array("escape" => false)); ?></li>
                            <li class="last-menu TBIStartupsSelected<"><?php echo $this->Html->link('<span>Start-ups selected</span>', array("controller" => "RMTBI", "action" => "startupSelected"), array("escape" => false)); ?></li>
                            <li class="last-menu TBIStartupsIncubated"><?php echo $this->Html->link('<span>Start-ups Incubated</span>', array("controller" => "RMTBI", "action" => "startupIncubated"), array("escape" => false)); ?></li>
                            <li class="last-menu TBIInnovationsCommercialized"><?php echo $this->Html->link('<span>Innovations Commercialized</span>', array("controller" => "RMTBI", "action" => "innovationCommercialized"), array("escape" => false)); ?></li>
                            <li class="last-menu TBIStartupsIncubatedTBI"><?php echo $this->Html->link('<span>Start-ups Incubated off TBI</span>', array("controller" => "RMTBI", "action" => "startupIncubatedTbi"), array("escape" => false)); ?></li>
                            <li class="treeview ">
                                <a href="#">
                                    <span>Financial / Expenditure</span>
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-right pull-right"></i>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li class="last-menu fablessFund"><?php echo $this->Html->link('<span>Fund Received</span>', array("controller" => "Tbi", "action" => "RMTBIFund"), array("escape" => false)); ?></li>
                                    <li class="last-menu fablessExpense"><?php echo $this->Html->link('<span>Expenditure Details</span>', array("controller" => "Tbi", "action" => "RMTBIExpenseList"), array("escape" => false)); ?></li>
                                </ul>
                            </li>
                        </ul>

                    </li>
                    <li class='target'>
                        <?php echo $this->Html->link('<i class="fa fa-balance-scale"></i> <span>Target</span>', array("controller" => "Tbi", "action" => "target"), array("escape" => false)); ?>
                    </li>
                <?php }
            } else  if ($ApplicationType == 'CIF') { ?>
                <?php if ($userType == 'Admin' || $userType == 'CIF') { ?>
                    <li class="treeview ">
                        <a href="#">
                            <i class="fa fa-star"></i><span>Events</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="last-menu cifRoundtables"><?php echo $this->Html->link('<span>Add Events</span>', array("controller" => "Cif", "action" => "roundtables"), array("escape" => false)); ?></li>
                            <li class="last-menu cifRoundtableParticipants"><?php echo $this->Html->link('<span>Event Participants</span>', array("controller" => "Cif", "action" => "roundtableParticipantsList"), array("escape" => false)); ?></li>
                            <!-- <li class="last-menu cifHackathon"><?php echo $this->Html->link('<span>Hackathons</span>', array("controller" => "Cif", "action" => "hackathons"), array("escape" => false)); ?></li>
                            <li class="last-menu cifHackathonParticipants"><?php echo $this->Html->link('<span>Hackathon Participants</span>', array("controller" => "Cif", "action" => "hackathonParticipantsList"), array("escape" => false)); ?></li> -->
                        </ul>
                    </li>
                    <li class="last-menu cifPublicityMentions"><?php echo $this->Html->link('<i class="fa fa-handshake-o"></i><span>Publicity Mentions</span>', array("controller" => "Cif", "action" => "publicityMention"), array("escape" => false)); ?></li>
                    <li class="treeview ">
                        <a href="#">
                            <i class="fa fa-laptop"></i><span>Start-ups </span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="last-menu cifStartupenrolled"><?php echo $this->Html->link('<span>New Startups Enrolled</span>', array("controller" => "Cif", "action" => "startupList"), array("escape" => false)); ?></li>
                            <li class="last-menu cifStartupRaisingFunding"><?php echo $this->Html->link('<span>Fund Raised by Startups</span>', array("controller" => "Cif", "action" => "startupRisedFunds"), array("escape" => false)); ?></li>
                            <!-- <li class="last-menu cifStartupRaisedFundList"><?php echo $this->Html->link('<span>Fund Raised by Startups</span>', array("controller" => "Cif", "action" => "startupsRisedFundsList"), array("escape" => false)); ?></li> -->
                        </ul>
                    </li>
                    <li class="treeview ">
                        <a href="#">
                            <i class="fa fa-female"></i><span>Gender Diversity </span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="last-menu cifGenderDiversity"><?php echo $this->Html->link('<span>Add Gender Diversity</span>', array("controller" => "Cif", "action" => "genderDiversity"), array("escape" => false)); ?></li>
                            <li class="last-menu cifGenderDiversityParticipants"><?php echo $this->Html->link('<span>Gender Diversity Participants</span>', array("controller" => "Cif", "action" => "genderDiversityParticipantList"), array("escape" => false)); ?></li>
                        </ul>
                    </li>
                    <li class="treeview ">
                        <a href="#">
                            <i class="fa fa-space-shuttle"></i><span>Participation in External Event</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="last-menu cifExternalEvent"><?php echo $this->Html->link('<span>Add External Events</span>', array("controller" => "Cif", "action" => "externalEvent"), array("escape" => false)); ?></li>
                            <li class="last-menu cifExternalEventParticipants"><?php echo $this->Html->link('<span>External Event Participants</span>', array("controller" => "Cif", "action" => "externalEventParticipantList"), array("escape" => false)); ?></li>
                        </ul>
                    </li>
                    <li class="last-menu cifConnects"><?php echo $this->Html->link('<i class="fa fa-hourglass-start"></i><span>Connects</span>', array("controller" => "Cif", "action" => "connect"), array("escape" => false)); ?></li>
                    <li class="last-menu cifCustomerSatisfaction"><?php echo $this->Html->link('<i class="fa fa-thumbs-up"></i><span>Customer Satisfaction</span>', array("controller" => "Cif", "action" => "customerSatisfaction"), array("escape" => false)); ?></li>
                    <li class="last-menu organization"><?php echo $this->Html->link('<i class="fa fa-book"></i><span>Organization</span>', array("controller" => "Cif", "action" => "organization"), array("escape" => false)); ?></li>
                    <li class="treeview ">
                        <a href="#">
                            <i class="fa fa-briefcase"></i><span>Financial / Expenditure</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="last-menu cifFund"><?php echo $this->Html->link('<span>Fund Received</span>', array("controller" => "Cif", "action" => "fund"), array("escape" => false)); ?></li>
                            <li class="last-menu cifFundExpense"><?php echo $this->Html->link('<span>Expenditure Details</span>', array("controller" => "Cif", "action" => "fundExpenditureList"), array("escape" => false)); ?></li>
                        </ul>
                    </li>
                <?php }
                if ($userType == 'Admin') { ?>
                    <li class='target'><?php echo $this->Html->link('<i class="fa fa-balance-scale"></i> <span>Target</span>', array("controller" => "Cif", "action" => "target"), array("escape" => false)); ?></li>
            <?php }
            } ?>
        </ul>
    </section>
</aside>
<!-- =============================================== -->